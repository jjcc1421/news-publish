<div class="row">
    @foreach ($news as $oneNews)
        <div class="well col-md-6">
            @if(Auth::User()->id==$oneNews->user_id)
                <a href="{{route('path_to_remove_article',[$oneNews->id])}}" class="text-danger">Remove</a>
            @endif
            <p class="text-right">Created {{ $oneNews->created_at }}</p>
            <p class="text-right">
                <small>By: {{ $oneNews->user->name }}</small>
            </p>
            <div class="media">
                <a class="pull-left" href="{{route('path_to_read_article',[$oneNews->id])}}">
                    <img class="media-object"
                         src="{{($oneNews->photo_url)?$oneNews->photo_url:'http://placekitten.com/150/150'}}"
                         height="100">
                    <!--TODO change image-->
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$oneNews->tittle}}</h4>

                </div>
            </div>
        </div>
    @endforeach
</div>
{!! $news->links() !!}
