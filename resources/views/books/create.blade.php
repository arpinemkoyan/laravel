@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Book</h2>
            </div>
            @if(auth()->user()->role !== \App\Models\User::ROLE_AUTHOR)
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    @if(auth()->user()->role !== \App\Models\User::ROLE_AUTHOR)
                        <strong>Author\s:</strong>
                        <select class="form-control" id="select2-dropdown" name="author">
                            <option value="">Select Option</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id}}">{{ $author->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
