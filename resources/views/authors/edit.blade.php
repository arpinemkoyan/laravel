@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Author</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('authors.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('authors.update',$author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $author->name }}" class="form-control"
                           placeholder="username">
                    <strong>Name:</strong>
                    <input type="text" name="first_name" value="{{ $author->first_name }}" class="form-control"
                           placeholder="First_name">  <strong>Name:</strong>
                    <input type="text" name="last_name" value="{{ $author->last_name }}" class="form-control"
                           placeholder="Last_name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
