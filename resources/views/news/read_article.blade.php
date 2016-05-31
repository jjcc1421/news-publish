@extends('layouts.app')
@section('content')
    <div class="container">
        <article>
            <img src="{{$news->photo_url}}" alt="{{$news->tittle}}" height="320">
            <h1>{{$news->tittle}}</h1>
            <small>By: {{$user->name}} {{$news->created_at}}</small>
            <div>
                {!! $news->text !!}
            </div>
            <div class="row">
                <div class="col-md-12 well">
                    <a href="{{route('path_to_pdf_article',[$news->id])}}" class="btn btn-info" target="_blank">Get PDF</a>
                </div>
            </div>
        </article>
    </div>
@endsection
