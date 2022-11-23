@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Authors</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('authors.create') }}"> Create New Authors</a>
            </div>
        </div>
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>First NAME</th>
                <th>Last NAME</th>
            </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
                <tr>
                    <td>{{$author->id}}</td>
                    <td>{{$author->first_name}}</td>
                    <td>{{$author->last_name}}</td>
                    <td>
                        <form action="{{ route('authors.destroy',$author->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('authors.show',$author->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('authors.edit',$author->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>
    </div>

@endsection
