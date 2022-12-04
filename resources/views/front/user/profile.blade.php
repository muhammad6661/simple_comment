@extends('layouts.app')
@section('title', 'Profile')
@section('styles')
    <link rel="stylesheet" href="/public/front/css/notyf/notyf.min.css">
    <link rel="stylesheet" href="/public/front/css/croppie.css">
@endsection
@section('content')
    <content id="edit-profile">
        <div class="py-4 container-fluid col-md-8 justify-content-center">
            <div class="edit-profile-tab " style="overflow-y: hidden;">
                <nav class="wow animate__animated animate__slideInDown" data-wow-duration=".5s">
                    <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
                        <a class="nav-link active w-50" id="nav-pers-info-tab" data-toggle="tab" href="#nav-pers-info"
                            role="tab" aria-controls="nav-pers-info" aria-selected="true">Personal informnation</a>
                        <a class="nav-link w-50" id="nav-change-password-tab" data-toggle="tab" href="#nav-change-password"
                            role="tab" aria-controls="nav-change-password" aria-selected="false">Change password</a>
                    </div>
                </nav>
                <div class="tab-content " id="nav-tabContent">
                    <div class="tab-pane fade show active animate__animated animate__fadeIn wow" data-wow-duration="1s"
                        id="nav-pers-info" role="tabpanel" aria-labelledby="nav-pers-info-tab">
                        <div class="pers-info mt-4">
                            <div class="zag-wrap">
                                <h2> Account settings</h2>
                                @include('layouts.errors')
                                @include('layouts.alert')
                            </div>
                            <div class="container-fluid">
                                <form method="post" action="/update/profile" class="row"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12 d-flex justify-content-center justify-content-md-start mt-4">
                                        <label for="parent-avatar" class="avatar-wrapper">
                                            <img id="avatar"
                                                src='/public/uploads/users/{{ Auth::user()->avatar != '' ? Auth::user()->avatar : 'default-avatar.jpg' }}'
                                                alt="">
                                            <span class="img-edit-ic" title="edit avatar" id="edit-avatar">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.9165 1.74985C10.0697 1.59664 10.2516 1.47511 10.4518 1.39219C10.652 1.30928 10.8665 1.2666 11.0832 1.2666C11.2998 1.2666 11.5144 1.30928 11.7146 1.39219C11.9147 1.47511 12.0966 1.59664 12.2498 1.74985C12.403 1.90306 12.5246 2.08494 12.6075 2.28512C12.6904 2.4853 12.7331 2.69985 12.7331 2.91652C12.7331 3.13319 12.6904 3.34774 12.6075 3.54791C12.5246 3.74809 12.403 3.92998 12.2498 4.08318L4.37484 11.9582L1.1665 12.8332L2.0415 9.62485L9.9165 1.74985Z"
                                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </label>
                                        <input type="file" id="parent-avatar" name="image" style="width: 0px"
                                            accept="image/*">
                                    </div>


                                    <div class="col-md-6 col-12 mt-4">
                                        <div>
                                            <label for="profile-edit-name"><span>*</span> Name:</label>
                                            <input type="text" name="name" id="profile-edit-name" required=""
                                                class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-4">
                                        <div>
                                            <label for="profile-edit-surname"><span>*</span> Surname:</label>
                                            <input type="text" name="surname" id="profile-edit-surname" class="form-control"
                                                value="{{ Auth::user()->surname }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mt-4">
                                        <div>
                                            <label for="profile-login"><span>*</span> Login or UserName:</label>
                                            <input type="text" name="login" id="profile-login" class="form-control"
                                                value="{{ Auth::user()->login }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mt-4">
                                        <div>
                                            <label for="profile-address"> Address:</label>
                                            <input type="text" name="address" id="profile-address" class="form-control"
                                                value="{{ Auth::user()->address }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 mb-5">
                                        <div class="changes">
                                            <label for=""><span>*</span> - are required</label>
                                            <div class="d-flex">
                                                <button class="btn b" type="submite">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade animate__animated animate__fadeIn wow"
                        id="nav-change-password" role="tabpanel" aria-labelledby="nav-change-password-tab">
                        <div class="pers-info mt-4">
                            <div class="zag-wrap">
                                <h2>Change password</h2>
                                <div id="errors"></div>
                            </div>
                            <div class="container-fluid">

                                <form action="javascript:void(0)" class="row" id="change_password">
                                    <div class="col-12 mt-4">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <label for="current-password"><span>*</span> Current password:</label>

                                            </div>

                                            <input type="password" name="current-password" id="current-password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div>
                                            <label for="new-password"><span>*</span> New password:</label>
                                            <input type="password" name="new-password" id="new-password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div>
                                            <label for="verify-password"><span>*</span> Verify password:</label>
                                            <input type="password" name="verify-password" id="verify-password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 mb-5">
                                        <div class="changes">
                                            <div class="d-flex">
                                                <button class="btn b" id="submit_password">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </content>

    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Upload avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  d-flex justify-content-center">
                    <div id="upload-demo" class="center-block"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input class="d-none" type="file" id="newUpload">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="new-upload">New upload</button>
                    <button type="button" class="btn btn-success" id="cropUserAvatar">Save</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
        }
    </style>
@endsection
@section('scripts')
    <script src="/public/front/js/croppie.js"></script>
    <script src="/public/front/js/notyf/notyf.min.js"></script>
    <script src="/public/front/js/custom.js"></script>
    <script>
          //Setting Crop image
  $uploadCrop = $('#upload-demo').croppie({
      viewport: {
          width: 150,
          height: 150,
          type: 'circle'
      },
      enforceBoundary: false,
      enableExif: true
  });
    </script>
    <script src="/public/front/js/customCropp.js"></script>
@endsection
