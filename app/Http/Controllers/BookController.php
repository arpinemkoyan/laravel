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
        ]);

        if (auth()->user()->role === \App\Models\User::ROLE_AUTHOR) {
            $bookService->createBook($request->name, auth()->user()->author_id);

            return redirect()->route('author')
                ->with('success', 'Book created successfully.');
        }
        dump($request->all());
        $bookService->createBook($request->name, $request->authors);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $books = Book::findOrFail($book->id);

        return view('books.show', compact('books', 'book'));
    }

    public function edit(Book $book)
    {
        $books = Book::all();
        $books = $books->find($book->id);
        $authors = $books->authors;
        $allAuthors = Author::all();
        return view('books.edit', compact('book', 'authors', 'allAuthors'));
    }

    public function update(Request $request, Book $book, BookService $bookService, AuthorBooksService $authorBooksService)
    {
        $request->validate([
            'name' => 'required',
            'authors' => 'required'
        ]);

        dump($request->all());

        foreach ($request->authors as $authorId) {
            $authors[] = Author::find($authorId);
        }
        $authorBooksService->updateAuthorBook($book->id, $authors);

        $bookService->updateBook($book->id, $request->name);

        if (auth()->user()->role !== \App\Models\User::ROLE_AUTHOR) {
            return redirect()->route('books.index')
                ->with('success', 'Book updated successfully');
        }

        return redirect()->route('author')
            ->with('success', 'Book updated successfully');

    }

    public
    function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

}
