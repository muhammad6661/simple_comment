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
</style>
@endsection
@section('content')
<content id="create-goal">
    <div class="py-4 container-fluid">
        <form action="javascript:void(0)" id="form_goal" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12 px-2">
                    <div class="profile-wrapper animate__animated animate__zoomIn wow" data-wow-duration=".7s">
                       <h3>Create post</h3>
                        <div class="form info px-4 mt-4 pt-4 container-fluid ">
                            <p style="text-align: center;">Complete these data for create post</p>
                            <div id="errors"></div>
                            <div class="mt-3">
                                <label for="title-goal">Title</label>
                                <input  name="title" type="text" class="form-control" id="title-post" value="{{old('title')}}">
                            </div>
                            <div class="mt-3">
                                <label for="description-goal">Description</label>
                                <textarea name="description" id="description-post" class="form-control rounded" cols="30" rows="5"> {{old('description')}}</textarea>
                            </div>
                            <div class="mt-3">
                                <label for="min-goal">Image for post (1250x500)px:</label>
                                <input id="image-post" type="file"  class="form-control" accept="image/*">
                            </div>
                            <div class="create-a-goal mt-4 d-flex justify-content-center" style="margin-top: 20px;">
                                <button id="store_post" class="btn">Create post</button>
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
