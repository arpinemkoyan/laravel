<?php


namespace App\Http\Controllers;
use App\Models\Authors;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthorsController
{

    public function index()
    {
        $authors=DB::table('authors')->get();

        return view('authors.index', compact('authors'));

    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday'=>'required'
        ]);

        Authors::create($request->all());

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    public function show(Authors $author)
    {
        $authors=Authors::all();
        $authors = $authors->find($author->id);
        $authorsData=$authors->book;

        return view('authors.show', compact('authorsData', 'author'));
    }

    public function edit(Authors $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Authors $author)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully');
    }

    public function destroy(Authors $author)
    {
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully');
    }

}
