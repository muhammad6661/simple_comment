@extends('layouts.front')

@section('title', 'Home')
@section('content')
<style>
    #ShowMore {
    position: static;
    bottom: 0px;
    left: 0px;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #fff;
    background: #00B08B;
    border: 2px solid #00B08B;
    border-radius: 5px;
    padding: 12px 30px;
    text-decoration: none;
    }
</style>
    <content id="home">
        <div class="py-4 container-fluid">
            <form action="javascript:void(0)"
                class="row d-flex justify-content-center pb-3 wow animate__animated animate__zoomIn" data-wow-duration=".5s"
                id="form-search">
                @csrf

                <div class="col-lg-12 col-12 px-1">
                    <div class="container-fluid">
                        <div class="row justify-content-center">

                            <div class="col-lg-2 col-sm-6 col-12 mt-3 px-2">

                                 <label for="">{{ __('main.from') }}</label>
                                <input type="date" class="form-control inp" name="date_from" id="date_from">
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12 mt-3 px-2">
                                <label for="">{{ __('main.to') }}</label>
                                <input type="date" class="form-control inp" name="date_to" id="date_toto">
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12 mt-3 px-2">
                                <label for="">{{ __("main.category") }}</label>
                                <select  name="category_id" id="category_select" class="form-control inp">
                                    <option value="">{{ __('main.all') }}</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-2 px-1 mt-3">
                                <label for="">&nbsp;</label>
                                <div class="d-flex align-items-center form-control inp">
                                    <label for="" class="mb-0 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </label>
                                    <input type="text" name="text" id="text" placeholder="{{ __('main.search_here') }}"
                                        class="form-control border-0">
                                </div>
                            </div>
                            <div class="col-lg-2 px-1 mt-3">
                                <label for=""> &nbsp;</label>
                                <button id="filterPost"  data-active ="off" class=" form-control inp btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <section class="articles mt-4 animate__animated animate__fadeIn wow" data-wow-offset="150">
                @include('includes.alert')
                @if (count($posts) > 0)
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ __('main.posts') }}</h2>
                            <a href="/create/post">{{ __('main.create_post') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="container-fluid">
                        <div class="row align-self-stretch">
                            @foreach ($posts as $item)
                                <div class="col-md-4 col-sm-6 col-12 mt-4 h-100">
                                    <div class="articles-item">
                                        <div>
                                            <img src="/public/uploads/posts/{{ $item->image }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <small>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM D, Y') }}</small>
                                        <div class="text-wrapper">
                                            <p>{{ $item->title }}</p>
                                        </div>
                                        <a href="/post/{{ $item->id }}" class="btn">{{ __('main.view') }}</a>
                                        @if (Auth::check())
                                        <a href="/edit/post/{{ $item->id }}" class="btn">{{ __('main.edit') }}</a>
                                        <a href="/delete/post/{{ $item->id }}" class="btn">{{ __('main.delete') }}</a>
                                          @endif

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    @endif
                </section>
                <div class="d-flex justify-content-center mb-5 mt-3" id="fomrButton">
                    @if (count($posts) > 1)
                    <button class="btnMore btn" id="ShowMore" data-offset="2">More</button>
                @endif

                </div>

        </div>
    </content>
@endsection
@section('scripts')

@endsection
