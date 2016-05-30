<img src="./{{$news->photo_url}}" alt="{{$news->tittle}}" height="320">
<br>
<h1>{{$news->tittle}}</h1>
<small>{{$news->created_at}}</small>
<br>
<small>By: {{$user->name}} </small>
<div>
    {!! $news->text !!}
</div>
