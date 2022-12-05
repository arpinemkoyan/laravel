@extends('layout')

@section('content')

    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('authors.index') }}">Authors</a>
        <a class="btn btn-success" href="{{ route('books.index') }}">Books</a>
    </div>
@endsection
