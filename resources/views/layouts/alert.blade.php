
@if(Session::has('success_message'))
<div class="col-12 mb-30">
                    <div class="alert alert-primary">
                    <button class="close" data-dismiss="alert">&times;</button>
                        <i class="zmdi zmdi-alert-polygon"></i>   {{session('success_message')}}</a>
                    </div>
                </div>


@endif

@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{session('error_message')}}
    </div>
@endif

