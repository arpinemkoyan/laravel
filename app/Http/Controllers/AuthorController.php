<?php


namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthorController
{

    public function index()
    {
        $authors = Author::paginate(5);

        return view('authors.index', compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request, AuthorService $authorService)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $authorService->createAuthor($request->first_name, $request->last_name);

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        $authors = Author::findOrFail($author->id);

        return view('authors.show', compact('authors', 'author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully');
    }

}
