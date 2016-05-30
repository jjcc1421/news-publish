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
        </article>
    </div>
@endsection
