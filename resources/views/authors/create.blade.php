@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Author</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('authors.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Full name">
                    <strong>Fist name:</strong>
                    <input type="text" name="first_name" class="form-control" placeholder="Full name">
                    <strong>Last nmae:</strong>
                    <input type="text" name="last_name" class="form-control" placeholder="Full name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

@endsection
