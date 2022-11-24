@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Books</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
            </div>
        </div>
    </div>
    <div>
        <form action="{{ route('books.index') }}" method="get">{{--post-ov chi linum--}}
            <input type="text" name="filter">
            <input type="submit" value="Search">
        </form>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('name','NAME')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$book->name}}</td>
                    <td>
                        <form action="{{ route('books.destroy',$book->id) }}" method="POST">

                            <a class="btn btn-info" href="{{route('books.show', $book->id)}}">Show</a>

                            <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>
        <div class="col-md-12">
            {!! $books->appends(\Request::except('page'))->render() !!}
        </div>
    </div>





@endsection
