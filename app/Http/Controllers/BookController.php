<?php


namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
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
        $books = $query->paginate(Book::PER_PAGE);

        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * Book::PER_PAGE);
    }

    public function create()
    {
        $allAuthors = Author::all();
        return view('books.create', compact('allAuthors'));
    }

    public function store(BookRequest $request, BookService $bookService)
    {
        if (auth()->user()->role === \App\Models\User::ROLE_AUTHOR) {
            $routeName = 'author';
        } else {
            $routeName = 'books.index';
        }
        $bookService->createBook($request->name, $request->authors);

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

    public function update(BookRequest $request, Book $book, BookService $bookService, AuthorBooksService $authorBooksService)
    {
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
