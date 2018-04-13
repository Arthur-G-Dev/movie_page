@extends('layouts.master')

@section('title')
    Add Movie
@endsection

@section('content')
    @if(count($errors) > 0)
        <div class="row">
            <div class="col-md-4 col-md-offset-4 error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if(Session::has('message'))
        <div class="col-md-6  col-md-offset-4 success">
            {{Session::get('message')}}
        </div>
    @endif
<form method="post" action="{{route('add_new_movie')}}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="row add_movie_form">
        <div class="form-group col-md-4">
            <p>Movie Name:</p><input type="text" class="form-control" name="movie_name"/><br/>
            <p>Country:</p><input type="text" class="form-control" name="country"/><br/>
            <p>Genre:</p><input type="text" class="form-control" name="genre"/><br/>
            <p>Year:</p><input type="number" class="form-control" min="1900" max="2050" name="year" onkeydown="javascript: return event.keyCode == 69 ? false : true"/><br/>
        </div>
        <div class="form-group col-md-4">
            <p>Director:</p><input type="text" class="form-control" name="director"/><br/>
            <p>Composer:</p><input type="text" class="form-control" name="composer"/><br/>
            <p>Art Director:</p><input type="text" class="form-control" name="art_director"/><br/>
            <p>Operator:</p><input type="text" class="form-control" name="operator"/><br/>
        </div>
        <div class="col-md-4 form-group">
            <p>Producer:</p><input type="text" class="form-control" name="producer"/><br/>
            <p>Scenarist:</p><input type="text" class="form-control" name="scenarist"/><br/>
            <p>Editor:</p><input type="text" class="form-control" name="editor"/><br/>
        </div>
        <div class="col-md-4 form-group">
            <p>Duration:</p><input type="number" class="form-control" min="0" max="300" name="duration" onkeydown="javascript: return event.keyCode == 69 ? false : true"/><br/>
            <p>Budget:</p><input type="number" class="form-control" min="0" max="1000000000" name="budget" onkeydown="javascript: return event.keyCode == 69 ? false : true"/><br/>
            <p>Poster:</p><input type="file" id="file" name="img"  onchange="pressed()"/>
            <label id="fileLabel">Choose a file</label>
        </div>
    </div>
    <br/>
    <input type="submit" value="Post Message"/>
</form>
@endsection