@if(count($errors) > 0)
    <div class="alert alert-icon alert-danger alert-dismissible " role="alert">

        <button class="close" data-dismiss="alert">&times;</button>
        </button>
        <i class="fa fa-exclamation-triangle"></i>
        @foreach($errors->all() as $error)
            <p style="text-align: left">{{$error}}</p>
        @endforeach
    </div>
@endif
