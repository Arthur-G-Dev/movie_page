@extends('layouts.master')

@section('title')
    All Movies
@endsection

@section('content')
    <h1>Here Will Be List Of All Movies</h1>
    @foreach($movies as $movie)
        <div class="col-md-4 movies">
            <h3>{{ ucwords($movie->movie_name) }}</h3>
            <div class="img_wrapper">
                <img src="{{ URL::to('storage/posters/'.$movie->poster) }}" alt="">
            </div>
            <a  href='{{'movieInfo/'.$movie->id }}'>Full Description</a>
        </div>
    @endforeach
@endsection


