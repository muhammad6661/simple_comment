
                                        @foreach ($comments as $item)

                                        <div class="d-flex flex-row p-3 w-100 " id="comment_{{ $item->id }}"> <img src="/public/uploads/users/{{ $item->avatar != '' ? $item->avatar : 'default-avatar.jpg'  }}" width="40" height="40" class="rounded-circle mr-3">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-row align-items-center"> <span class="mr-2">{{ $item->user->name. ' ' . $item->user->surname . '( '. $item->user->login. ')'}}</span>  </div> <small>{{ $item->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="text-justify comment-text mb-0">{!! $item->content !!}</p>
                                            <div class="d-flex flex-row user-feed">
                                                @if (Auth::user() && Auth::user()->id == $item->user_id)
                                         <span class="wish" style="cursor:pointer; color:blue" id="edit_comment" data-id="{{ $item->id }}" data-postid="{{ 1 }}"><i class="fa fa-pencil"></i></span> <span class="ml-3 mr-3" id="delete_comment" data-id="{{ $item->id }}" style="cursor:pointer;color:#D95767"><i class="fa fa-trash"></i></span>
                                                @endif
                                         </div>
                                        </div>
                                    </div>
                                    @endforeach
