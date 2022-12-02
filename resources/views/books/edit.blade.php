@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Books</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update',$book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $book->name }}" class="form-control" placeholder="Name">
                    <input type="text" name="authors_input"
                           value="@foreach($authors as $author){{ $author->name}}@endforeach" class="form-control"
                           placeholder="Author" disabled>
                    <select class="form-control" name="authors[]" multiple="">
                        @if(auth()->user()->role === \App\Models\User::ROLE_AUTHOR)
                            @foreach($authors as $author)
                                <option value="{{$author->id}}" selected="selected">{{$author->name}}</option>
                            @endforeach
                        @endif
                        @if(auth()->user()->role !== \App\Models\User::ROLE_AUTHOR)
                            @foreach($allAuthors as $authorData)
                                <option value="{{$authorData->id}}">{{$authorData->name}}</option>
                            @endforeach
                        @endif
                    </select>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
