@extends('layouts.master')

@section('title')
    All Movies
@endsection

@section('content')

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
                        <img src="{{  URL::to('storage/posters/default_poster.jpg')  }}" alt="">
                    @endif
                </div>
                <a href='{{'movieInfo/'.$movie->id }}'>Full Description</a>
            </div>
        @endforeach
    </div>
    <div class="col-md-12 text-center pagination_container">
        {{-- getting nex and previous link numbers --}}
        <?
        $arr = explode('=', $movies->nextPageUrl());
        $next_link = end($arr);

        $arr1 = explode('=', $movies->previousPageUrl());
        $prev_link = end($arr1);
        ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if(url()->full() == 'http://moviepagel.loc/?page=1' ||  url()->full() == 'http://moviepagel.loc')
                @else
                    <li><a href="{{ $movies->previousPageUrl() }}">{{ $prev_link }}</a></li>
                @endif
                @if(!$movies->hasMorePages())
                    <li><a href="{{$movies->nextPageUrl() }}">{{ $movies->currentPage() }}</a></li>
                @else
                    <li><a href="{{ url()->full() }}">{{ $movies->currentPage() }}</a></li>
                    <li><a href="{{ $movies->nextPageUrl() }}">{{ $next_link }}</a></li>
                @endif

            </ul>
        </nav>
    </div>
@endsection



