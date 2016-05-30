@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Articles</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <a href="{{route('path_to_add_news')}}" class="btn btn-info">Add new</a>
                </div>
            </div>
            <div class="col-md-12">
                @include('news.partials.list_news',['news'=>$news])
            </div>
        </div>
@endsection
