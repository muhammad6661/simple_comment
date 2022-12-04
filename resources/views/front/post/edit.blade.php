@extends('layouts.app')
@section('title','Create post')

@section('styles')
<link rel="stylesheet" href="/public/front/css/croppie.css">
<style>
     .create-a-goal .btn {
    padding: 15px 100px;
    background: #00B08B;
    color: white;
}
.links {
    padding: 10px;
    background: rgba(0, 0, 0, 0.35);
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;  
    transition: all .4s linear;
}
</style>
@endsection
@section('content')
<content id="create-goal">
    <div class="py-4 container-fluid">
        <form action="javascript:void(0)" id="form_goal" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12 px-2">
                    <div class="profile-wrapper animate__animated animate__zoomIn wow" data-wow-duration=".7s">
                       <h3>Edit post</h3>
                        <div class="form info px-4 mt-4 pt-4 container-fluid ">
                            <p style="text-align: center;">Complete these data for edit post</p>
                            <div id="errors"></div>
                            <div class="mt-3">
                                <label for="title-goal">Title</label>
                                <input  name="title" type="text" class="form-control" id="title-post" value="{{$post->title}}">
                            </div>
                            <div class="mt-3">
                                <label for="description-goal">Description</label>
                                <textarea name="description" id="description-post" class="form-control rounded" cols="30" rows="5"> {{$post->content}}</textarea>
                            </div>
                            <div class="d-flex justify-content-center" >
                                <div class=" mt-2 mb-2 books-item wow animate__animated animate__fadeIn" data-wow-duration="1s" data-wow-offset="50">
                                    <div class="image-wrapper" style="background: rgba(0, 0, 0, 0.1);">
                                        <img id ="AvatarGoalTag"  src="/public/uploads/posts/{{$post->image}}" alt=""  height="300px" width="500">
                                        <div class="links">
                                        </div>
                                    </div>
                                </div>
                                    </div>
                            <div class="mt-3" >
                                <label for="min-goal">Image for post (1250x500)px:</label>
                                <input id="image-post" type="file" width=""  class="form-control" accept="image/*">
                            </div>
                            <div class="create-a-goal mt-4 d-flex justify-content-center" style="margin-top: 20px;">
                                <button id="update_post" class="btn">Update post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


</content>


@endsection
@section('scripts')
<script src="/public/front/js/custom.js"></script>
@endsection
