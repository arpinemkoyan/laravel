@extends('layout')

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
                    <strong>Author\s:</strong><br/>
                    <select class="js-example-basic-multiple" name="authors[]" multiple="multiple">
                        @if(auth()->user()->role === \App\Models\User::ROLE_AUTHOR)
                            <option value="{{auth()->user()->id}}" selected="selected">{{auth()->user()->name}}</option>
                        @endif
                        @if(auth()->user()->role !== \App\Models\User::ROLE_AUTHOR)
                            @foreach($allAuthors as $authorData)
                                <option value="{{$authorData->id}}">{{$authorData->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <script>$(document).ready(function () {
                            $('.js-example-basic-multiple').select2();
                        });
                    </script>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
