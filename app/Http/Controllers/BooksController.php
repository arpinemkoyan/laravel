<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Authors;
use App\Models\AuthorsBooks;

class BooksController extends Controller
{
    public function index(Request $request)
    {

        if (!empty($request->filter)) {
            $books = Books::sortable()
                ->where('books.name', 'like', '%' . $request->filter . '%')
                ->paginate(2);
            return view('books.index', compact('books'));

        }
        else{
            $books = Books::sortable()
                ->paginate(2);
            return view('books.index', compact('books'));
        }
    }

    public function create()
    {
        $authors=Authors::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        dump($request->all());
        $authorName=Authors::find($request->authors);
        dump($authorName->first_name.' '.$authorName->last_name);
        $books=Books::create(  [
            'name' => $request->name,
            'authors' => $authorName->first_name.' '.$authorName->last_name
            ]);
        $idB=$books->id;
       dump($idB);
        AuthorsBooks::create([
            'books_id' => $idB,
            'authors_id' =>$request->authors
        ]);


        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Books $book)
    {
        $books = Books::all();
        $books = $books->find($book->id);
        $booksData = $books->author;

        return view('books.show', compact('booksData', 'book'));
    }

    public function edit(Books $book)
    {
        $authors=Authors::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Books $book)
    {
        $request->validate([
            'name' => 'required',
        ]);

        dump($request->all);

//        $book->update($request->all());

//        return redirect()->route('books.index')
//            ->with('success', 'Book updated successfully');
    }

    public function destroy(Books $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

}
