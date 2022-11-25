<?php


namespace App\Http\Controllers;

use App\Services\AuthorBooksService;
use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Support\Facades\DB;
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
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request, BookService $bookService, AuthorBooksService $authorBookService)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required'
        ]);

        $bookService->createBook($request->name, $request->author);

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
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book, BookService $bookService, AuthorBooksService $authorBookService)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if(!empty($request->authors)){
            echo 'sd';
            die;
            $author = Author::find($request->authors);
            $SelAuthorName = $author->first_name . ' ' . $author->last_name;
            if ($request->authors_input != $SelAuthorName) {
                $idA = $request->authors;
                $authorBookService->updateAuthorBook($book->id, $idA);
            }
        }

        $bookService->updateBook($book->id, $request->name);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

    public function autocomplete(Request $request)
    {
        $data = [];

        if ($request->filled('q')) {
            $data = Author::select("first_name", "last_name", "id")
                ->where('first_name', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json($data);
    }

}
