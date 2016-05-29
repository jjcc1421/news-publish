@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new article</h1>
        {!! Form::open(array('url' => route('path_to_post_news'))) !!}
        <div class="form-group">
            <label for="title">Tittle:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Tittle">
        </div>
        <div class="form-group">
            <label for="text">Article Content:</label>
            <textarea class="form-control" id="text" placeholder="Enter text" rows="8"></textarea>
        </div>
        <div class="form-group">
            <label for="fileToUpload">Select image to upload::</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
        {!! Form::close() !!}
    </div>
@endsection
