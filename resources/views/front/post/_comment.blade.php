<div class="d-flex flex-row p-3" id="comment_{{ $comment->id }}"> <img src="/public/uploads/users/{{ Auth::user()->avatar != '' ? Auth::user()->avatar : 'default-avatar.jpg'  }}" width="40" height="40" class="rounded-circle mr-3">
    <div class="w-100">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center"> <span class="mr-2">{{ Auth::user()->name.' '.Auth::user()->surname . '( '. Auth::user()->login. ')'}}</span>  </div> <small>{{$comment->created_at->diffForHumans()}}</small>
        </div>
        <p class="text-justify comment-text mb-0">{!! $comment->content !!}</p>
        <div class="d-flex flex-row user-feed">
     <span class="wish" style="cursor:pointer; color:blue" id="edit_comment" data-id="{{ $comment->id }}"><i class="fa fa-pencil"></i></span> <span class="ml-3 mr-3" id="delete_comment" data-id="{{ $comment->id }}" style="cursor:pointer;color:#D95767"><i class="fa fa-trash"></i></span> </div>
    </div>
</div>
