@extends('authors.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('authors.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <table>
            <thead>
            <tr>
                <th>Author NAME</th>
                <th>Books NAME</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$author->first_name}} {{$author->last_name}}</td>
                <td>
                    <ul>
                        @foreach($authorsData as $book)
                            <li>{{$book->name}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
