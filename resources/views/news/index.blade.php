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
                @foreach ($news as $oneNews)
                    <div class="well">
                        <a href="#" class="text-danger">Remove</a>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placekitten.com/150/150" height="100">
                                <!--TODO change image-->
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$oneNews->tittle}}</h4>
                                <p class="text-right">Created {{ $oneNews->created_at }}</p>
                                <p>{{ substr($oneNews->text,0,2000) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $news->links() !!}
            </div>
        </div>
@endsection
