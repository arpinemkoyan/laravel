<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('users.layout');
    }

    public function login()
    {
        return view('users.signin');
    }

    public function author()
    {
        $author_id = \auth()->user()->author_id;
        $author = Author::FindOrFail($author_id);
        return view('users.author', compact('author'));
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userRole = $user->role;
            if ($userRole == \App\Models\User::ROLE_AUTHOR) {
                /*Author*/
                return redirect()->route('author');
            } elseif ($userRole == \App\Models\User::ROLE_USER) {
                redirect('/');
                return view('home');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('users.signup');
    }

    public function userRegistration(UserRequest $request, AuthorService $authorService)
    {
        $data = $request->all();
        if ($request->role == 0) {
            /*Author*/
            $author = $authorService->createAuthor($request->name, $request->first_name, $request->last_name);
            $data['author_id'] = $author->id;
            $this->create($data);

        }
        if ($request->role == 1) {
            /*custom*/
            $data['author_id'] = null;
            $this->create($data);
        }
        return view('users.signin');

    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'author_id' => $data['author_id']
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function edit(string $idB)/*?????*/
    {
        $book = Book::findOrFail($idB);

        return view('users.edit', compact('book'));
    }

}
