@extends('dashboard')

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
            <a class="btn btn-success" href="{{ route('books.create', $author) }}"> Create New Book</a>
        </div>
        <ol class="list-group list-group-numbered">
            @foreach($author->books as $book)
                <li class="list-group-item">{{$book->name}}</li>

            @endforeach
        </ol>

    </div>
@endsection
