<?php


namespace App\Http\Controllers;

use App\Services\AuthorBooksService;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::sortable();
        if (!empty($request->filter)) {
            $query = $query->where('books.name', 'like', '%' . $request->filter . '%');
        }
        $books = $query->paginate(5);

        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $allAuthors = Author::all();
        return view('books.create', compact('allAuthors'));
    }

    public function store(Request $request, BookService $bookService)
    {
        $request->validate([
            'name' => 'required',
            'authors' => 'required'
        ]);

        if (auth()->user()->role === \App\Models\User::ROLE_AUTHOR) {
            $bookService->createBook($request->name, auth()->user()->author_id);
            $routeName = 'author';
        } else {
            $bookService->createBook($request->name, $request->authors);
            $routeName = 'books.index';
        }

        return redirect()->route($routeName)
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $books = Book::findOrFail($book->id);

        return view('books.show', compact('books', 'book'));
    }

    public function edit(Book $book)
    {
        $allAuthors = Author::all();
        return view('books.edit', compact('book', 'allAuthors'));
    }

    public function update(Request $request, Book $book, BookService $bookService, AuthorBooksService $authorBooksService)
    {
        $request->validate([
            'name' => 'required',
            'authors' => 'required'
        ]);

        $authorBooksService->updateAuthorBook($book->id, $request->authors);
        $bookService->updateBook($book->id, $request->name);
        if (auth()->user()->role !== \App\Models\User::ROLE_AUTHOR) {
            $routeName = 'books.index';
        } else {
            $routeName = 'author';
        }
        return redirect()->route($routeName)
            ->with('success', 'Book updated successfully');

    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

}
