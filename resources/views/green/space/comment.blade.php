@foreach($comments as $comment)
<div class="media-review" id="div_dynamic_comments_{{$comment['id']}}">
  <div class="media subMessage">
    <div class="media-body">
      <div class="row">
        <p>
          <img src="{{$url}}/{{$comment['user']['photoUrl']}}" class="imgXsmall media-object">
        </p>
        <div class="col-sm-12">
          <p><a href=""><span class="name text-primary ellipsis">{{$comment['user']['name']}}：</span></a>
            {{$comment['c']}}({{$comment['timeStr']}})
          </p>
        </div>
        <ul class="feedbacks pull-right list-inline">
          @if($comment['isOwner'])
            <li><a href="javascript:doDelComment('{{$comment['id']}}');">删除</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
@endforeach