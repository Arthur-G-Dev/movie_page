@extends('layouts.master')

@section('title')
    All Movies
@endsection

@section('content')
    <h1>Here Will Be List Of All Movies</h1>
    @foreach($movies as $movie)
        <pre>{{ print_r($movie) }}</pre>
       {{--<h3>{{ $movie->movie_name }}</h3>--}}
       {{--<h3>{{ $movie->genre }}</h3>--}}
    @endforeach
@endsection


