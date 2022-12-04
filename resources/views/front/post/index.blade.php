    @extends('layouts.app')
    @section('title','Posts')
    <style>
        .btn.d {
                background: #D95767;
            }

            .btn.e {
                background: #3759d3;
                }
    </style>
    @section('content')

                    <content id="articles-wrapper">
                        <div class="py-4 container-fluid col-md-9">
                            <div class="zag-wrap border-bottom-0 bg-static animate__animated animate__fadeIn d-flex justify-content-between" data-wow-duration="1s">
                                <h2>Active posts</h2>

                            </div>
                            <div class="row ml-0">
                                @if (count($posts) > 0)
                            @foreach($posts as $item)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 mt-3 px-2">
                                    <div class="articles-item wow animate__animated animate__zoomIn">
                                        <div class="image-wrapper">
                                            <img src="/public/uploads/posts/{{$item->image}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="text-wrapper">
                                            <small>{{$item->created_at}}</small>
                                            <h4>{{$item->title}}</h4>
                                            <p>{{ substr($item->content, 0 , 50).(strlen($item->content) > 50 ? '...' : '')}}</p>
                                        </div>
                                        <div class="d-flex">
                                        <a href="/post/{{$item->id}}" class="btn-child b">Read </a>
                                        @if (Auth::user() && Auth::user()-> id == $item->user_id)
                                        <a href="/edit/post/{{$item->id}}" class="btn btn-child e">Edit</a>
                                        <a href="/delete/post/{{$item->id}}" class="btn btn-child d">Delete</a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <h4 class="ml-5 mt-2"> Empty</h4>
                            @endif
                            </div>
                        {{$posts->links('layouts.pagination')}}
                        </div>
                    </content>
    @endsection
