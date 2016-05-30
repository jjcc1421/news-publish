@foreach ($news as $oneNews)
    <div class="well">
        @if(Auth::User()->id==$oneNews->user_id)
            <a href="{{route('path_to_remove_article',[$oneNews->id])}}" class="text-danger">Remove</a>
        @endif
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object"
                     src="{{($oneNews->photo_url)?$oneNews->photo_url:'http://placekitten.com/150/150'}}"
                     height="100">
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
