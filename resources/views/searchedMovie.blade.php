@extends('layouts.master')

@section('content')
<h1>Searched movie page</h1>
@include('includes.filter')
<h1 class="text-center">All Movie List</h1>
<div class="row">
    @foreach($movies as $movie)
        <div class="col-md-4 movies">
            <h3>{{ ucwords($movie->movie_name) }}</h3>
            <div class="img_wrapper">
                @if(!empty($movie->poster))
                    <img src="{{  URL::to('storage/posters/'.$movie->poster)  }}" alt="">
                @else
                    <img src="{{  URL::to('storage/posters/default_poster.jpg')  }}" alt="Default poster">
                @endif
            </div>
            <a href='{{'movieInfo/'.$movie->id }}'>Full Description</a>
        </div>
    @endforeach
</div>

@endsection