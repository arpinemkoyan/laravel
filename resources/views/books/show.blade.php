@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <table>
            <thead>
            <tr>
                <th>BOOK NAME</th>
                <th>AUTHORS NAME</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$book->name}}</td>
                <td>
                    <ul>
                        @foreach($books->authors as $author)
                            <li>{{$author->name}} </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
