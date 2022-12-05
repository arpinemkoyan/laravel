@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Author</h2>
            </div>

        </div>
    </div>
    <div>
        <h3>{{$author->name}}</h3>
    </div>

    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
        </div>
        <table>
            <thead>
            <tr>
                <th>Books name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($author->books as $book)
                <tr>
                    <td>{{$book->name}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>
@endsection
