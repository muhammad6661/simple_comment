@extends('layouts.app')
@section('title', $post->title)
@section('styles')
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/public/front/css/slick.css">
    <link rel="stylesheet" href="/public/front/css/slick-theme.css">
    <style>
        .card {
            background-color: #fff;
            border: none
        }

        .form-color {
            background-color: #fafafa
        }

        .form-control {
            height: 48px;
            border-radius: 25px
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #35b69f;
            outline: 0;
            box-shadow: none;
            text-indent: 10px
        }

        .c-badge {
            background-color: #35b69f;
            color: white;
            height: 20px;
            font-size: 11px;
            width: 92px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2px
        }

        .comment-text {
            font-size: 13px
        }

        .wish {
            color: #35b69f
        }

        .user-feed {
            font-size: 14px;
            margin-top: 12px
        }

        textarea {
            min-height: 60px !important;
        }

        textarea {
            overflow: hidden !important;
        }

        .btn.b {
            background: #00B08B;
            color: white;
            margin-left: 20px;
            transition: all .2s linear;
        }

        .btn.d {
            background: #D95767;
            color: white;
            margin-left: 20px;
            transition: all .2s linear;
        }

        button[disabled=disabled] {
            pointer-events: none;
            opacity: 0.4;
        }

        .btnMore {
            background-color: #00B08B;
            padding: 12px 50px;
            background: #00B08B;
            color: white;
            margin-left: 20px;
            transition: all .2s linear;
            border: none;
        }

        input:focus {
            outline: none;
        }

        #content_search li {
            list-style: none;
            margin-bottom: 10px;
            cursor: pointer;
        }

        #content_search a li {
            font-weight: 450;
            font-size: 16px;
            line-height: 20px;
            color: #2666BA;
            border-bottom: 1px solid transparent;

        }

        #content_search ul li:hover {
            background: #d8d7d7;
        }

        #command_search:hover {
            color: #2666BA;
        }

    </style>
@endsection
@section('active_menu', 'active')
@section('content')
    <content id="articles-detiled" class="col-md-12">
        <div class=" row justify-content-center py-4 container-fluid animate__animated animate__fadeIn wow"
            data-wow-duration="2s">

            <div class="articles-info-wrapper mt-4 col-md-8">
                <div class="articles-info  ">
                    <div>
                        <h3>
                    {{ $post->title}}
                        </h3>
                        <small>{{ \Carbon\Carbon::parse('2022-04-04')->isoFormat('MMMM D, Y') }}</small>
                        <div class="image-wrapper">
                            <img src="/public/uploads/posts/{{ $post->image }}"
                                class="h-100" alt="">
                        </div>
                        <div class="text-wrapper mt-4">
                            {!! $post->content !!}
                        </div>
                        <div class="appraisal my-5">
                            <div class="d-flex justify-content-center col-md-8 ">
                                <hr class="mb-0" style="border-width: 2px;background-color: #83848b">
                            </div>
                        </div>
                        @if (count($comments_sliter) > 2)
                        <div class="">
                            <h2>What people say about us</h2>
                            <hr class="mb-3" style="border-width: 2px;background-color: #EAEBEF">

                            <div class="responsive">
                                @foreach ($comments_sliter as $item)
                                    <div class="rewievs-item ml-2">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img width="45px"
                                                    src='/public/uploads/users/{{ $item->user->avatar != '' ? $item->user->avatar : 'default-avatar.jpg' }}'
                                                    class="img-fluid" alt="" style="border-radius:50%;">
                                            </div>
                                            <h6 class="ml-3">{{ $item->user->name . ' ' . $item->user->surname }}
                                            </h6>
                                        </div>
                                        <p class="ml-5 pl-3">{{ $item->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>


            </div>

            <div class="mt-3 row height d-flex justify-content-center align-items-center col-md-7">
                <div class="col-md-12">
                    <div class="card">
                        <div class="p-3 d-flex justify-content-between">
                            <h6 class="mt-3 col-md-3"><span>{{ $qnt }}</span> Comments </h6>
                            <div class="search-wrapper d-none my-lg-0 my-3 col-md-5" id="searchForm">
                                <div class="search-group d-flex align-items-center form-control">
                                    <label for="search-site" class="mb-1 mx-2" style="cursor: pointer"
                                        id="command_search">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </label>
                                    <input type="search" id="inputText" class="  border-0 py-0" name="search"
                                        id="search-site" placeholder="Search here" style="padding: 1.475rem 0.75rem;"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div id="content_search" class="d-none form-control col-lg-3"
                                style="position: absolute;top:10%;left: 33%;height: 200px; width: 89%;  font-weight: 600;font-size: 16px;line-height: 20px; color: #000000; background: ##ffffff;margin-left: 38px; min-height: 50px;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);border-top-left-radius: 0px;border-top-right-radius: 0px;padding-top:10px;padding-bottom:5px;z-index: 99999;">
                                <ul class="text_wrapper">

                                </ul>
                            </div>
                            <div class="col-md-3 align-item-right">

                                <select name="filterBy" id="FilterBy" class="form-control w-100">
                                    <option value="desc" class="form-control">
                                        Sort By (Desc)
                                    </option>
                                    <option value="asc" class="form-control">
                                        Sort By (ASC) <i class="fa fa-arrow-up"></i>
                                    </option>
                                    <option value="login" class="form-control">
                                        Sort By login
                                    </option>
                                </select>
                            </div>
                        </div>
                        @if (Auth::check())
                            <div class="mt-3 d-flex flex-row  p-3 form-color">
                                <div>
                                    <img src="/public/uploads/users/{{ Auth::user()->avatar != '' ? Auth::user()->avatar : 'default-avatar.jpg' }}"
                                        width="50" class="rounded-circle mr-2">
                                </div>
                                <div class="col-md-11">
                                    <textarea type="text" id="content_comment" class="form-control" placeholder="Enter your comment..."
                                        rows="auto"></textarea>
                                    <div class="mt-2 row justify-content-end mr-1">
                                        <button type="button" class="btn d" id="reset_text">Reset</button>
                                        <button type="button" class="btn b" id="send_comment"
                                            data-postid="{{ $post->id }}">Send</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mt-2">
                        </div>
                        <div id="formComments">

                            @foreach ($comments as $item)
                                <div class="d-flex flex-row p-3 w-100 " id="comment_{{ $item->id }}"> <img
                                        src="/public/uploads/users/{{ $item->avatar != '' ? $item->avatar : 'default-avatar.jpg' }}"
                                        width="40" height="40" class="rounded-circle mr-3">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row align-items-center"> <span
                                                    class="mr-2">{{ $item->user->name . ' ' . $item->user->surname . '( ' . $item->user->login . ')' }}</span>
                                            </div> <small>{{ $item->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="text-justify comment-text mb-0">{!! $item->content !!}</p>
                                        <div class="d-flex flex-row user-feed">
                                            @if (Auth::check() && Auth::user()->id == $item->user_id)
                                                <span class="wish" style="cursor:pointer; color:blue"
                                                    id="edit_comment" data-id="{{ $item->id }}"
                                                    data-postid="{{ $post->id }}"><i class="fa fa-pencil"></i></span>
                                                <span class="ml-3 mr-3" id="delete_comment"
                                                    data-id="{{ $item->id }}" style="cursor:pointer;color:#D95767"><i
                                                        class="fa fa-trash"></i></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="d-flex justify-content-center mb-5" id="fomrButton">
                            @if ($qnt > 3)
                            <button class="btnMore" id="ShowMore" data-offset="2">More</button>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </content>
    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  custm-modal">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <div class="classes my-moda-p">
                        <h1>Delete comment</h1>
                        <p> Delete your comment permanently?</p>
                    </div>
                    <div class="btn-wrapper flex-sm-row flex-column d-flex justify-content-center mt-5">
                        <button type="button" class="btn s" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn d" id="deleteClasstTogglerModal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="/public/front/js/custom.js"></script>


    <script src="/public/front/js/slick.js"></script>
    <!-- connect screipts -->
    <script>
        const path = window.location.pathname;
        // console.log(path);
        const str = path.split('/');
        if (str.length == 2) {
            document.getElementById('breadcrumb').remove();
        }
        window.onload = () => {
            $('.responsive').slick({
                slidesToShow: 2,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 2000,
            });

        }
    </script>
@endsection
@section('scripts')
