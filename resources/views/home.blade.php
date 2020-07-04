{{-- Contains the main layout (and other files that will be included in the layout) --}}
@extends('layouts.app')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name', 'LARAVELAPP')}}</title>
    </head>
    <body>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
        CKEDITOR.replace( 'summary-ckeditor' );
        </script>
        @section('content')
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                Dashboard
                            </div>
                            <div class="panel-body">
                                <a href="/posts/create" class="btn btn-primary">Create Post</a>
                                <h3>Your Blog Posts</h3>
                                @if(count($posts) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($posts as $post)
                                    <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                        <td>    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}

                                            {{-- Hidden method to allow us use Delete function --}}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close() !!}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                @else
                                <p>You have no posts</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                        <th>{{$post->title}}</th>
                        <th><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></th>
                            <th></th>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <p>You have no posts</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
