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
        $query = Books::sortable();
        if (!empty($request->filter)) {
            $query->where('books.name', 'like', '%' . $request->filter . '%');
        }
        $query->paginate(5);

        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request, AuthorService $authorService, BookService $bookService, AuthorBooksService $authorBookService)
    {
        $request->validate([
            'name' => 'required|'
        ]);

        if (empty($request->first_name) || empty($request->last_name)) {
//                $author=$authorService->getAuthorData($request->authors);
            $newBook = $bookService->createBook($request->name);

            $idA = $request->authors;
        } else {
            $newAuthor = $authorService->createAuthor($request->first_name, $request->last_name);

            $newBook = $bookService->createBook($request->name);

            $idA = $newAuthor->id;
        }
        $idB = $newBook->id;

        $authorBookService->createAuthorBook($idB, $idA);

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

    public function update(Request $request, Book $book, AuthorService $authorService, BookService $bookService, AuthorBooksService $authorBookService)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if (!empty($request->authors)) {
            $author = $authorService->getAuthorData($request->authors);
            $idA = $request->authors;

        } else {
            $author = $request->authors_input;
            $authorFullNameArr = explode(" ", $author);
            $authorDb = $authorService->selectAuthor($authorFullNameArr[0], $authorFullNameArr[1]);
            if (!$authorDb->exists()) {
                $newAuthor = $authorService->createAuthor($authorFullNameArr[0], $authorFullNameArr[1]);
                $idA = $newAuthor->id;
            } else {
                $idA = $authorDb->get()[0]->id;
            }
        }

        $authorBookService->updateAuthorBook($book->id, $idA);
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
