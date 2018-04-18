@extends('layouts.master')

@section('content')
    @include('includes.filter');
    <h1 class="text-center">Filtered Movie List</h1>

    @if(count($filteredMovies) > 0)
        @foreach($filteredMovies as $movie)

            <div class="col-md-4 movies">
                <h3>{{ ucwords($movie->movie_name) }}</h3>
                <div class="img_wrapper">
                    @if(!empty($movie->poster))
                        <img src="{{  URL::to('storage/posters/'.$movie->poster)  }}" alt="">
                    @else
                        <img src="{{  URL::to('storage/posters/default_poster.jpg')  }}" alt="">
                    @endif
                </div>
                <a  href='{{'movieInfo/'.$movie->id }}'>Full Description</a>
            </div>
        @endforeach
        @else
        <h1 class="text-center">No Result Matched To Your Choice</h1>
    @endif
@endsection