@extends('layouts.master')

@section('title')
    Single Movie
@endsection

@section('content')
    <h1>Here Will Be One Movie</h1>
    @foreach($movie as $m)
        <div class='row solo'>
            <hr>
            <div class='movies  col-md-4'>
                <h3>{{ ucwords($m->movie_name)}}</h3>
                @if(!empty($m->poster))
                    <img src="{{  URL::to('storage/posters/'.$m->poster)  }}" alt="">
                @else
                    <img src="{{  URL::to('storage/posters/default_poster.jpg')  }}" alt="">
                @endif
            </div>
            <div class='col-md-offset-2 col-md-6'>
                <table class='table'>
                    <tbody>
                    <tr>
                        <td>Director</td>
                        <td>{{ $m->director }}</td>
                    </tr>
                    <tr>
                        <td>Producer</td>
                        <td>{{ $m->producer }}</td>
                    </tr>
                    <tr>
                        <td>Operator</td>
                        <td>{{ $m->operator }}</td>
                    </tr>
                    <tr>
                        <td>Composer</td>
                        <td>{{ $m->composer }}</td>
                    </tr>
                    <tr>
                        <td>Director of Photography</td>
                        <td>{{ $m->art_director }}</td>
                    </tr>
                    <tr>
                        <td>Scenarist</td>
                        <td>{{ $m->scenarist }}</td>
                    </tr>
                    <tr>
                        <td>Editor</td>
                        <td>{{ $m->editor }}</td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>{{ $m->genros }}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{ $m->year }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $m->country }}</td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td>{{ $m->duration }}min.</td>
                    </tr>
                    <tr>
                        <td>Budget</td>
                        <td>{{ $m->budget }}$</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-12 text-right'>
                <a class='backward_link' href='{{ url()->previous() }}'>Back to Movie list</a>
            </div>
        </div>
    @endforeach
    <h4 class="text-center post_msg"></h4>
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <h3>What do you have to say</h3>
            <form action="" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <textarea name="body" id="new-post" cols="5" rows="5" class="form-control"
                              placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </section>
<script>
    var movie_id = "{{ $m->id }}";
    var urlAddPost = "{{ Route('add_post') }}"
</script>
@include('includes.movie_posts')
@endsection

