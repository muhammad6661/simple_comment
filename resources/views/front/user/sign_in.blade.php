<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In</title>
    <link rel="shortcut icon" type="image/x-icon" href="/public/favicon.ico">
	<!-- connect csss -->
    <link rel="stylesheet" href="/public/front/css/bootstrap.min.css">
	<link rel="stylesheet" href="/public/front/css/animate.css">
	<link rel="stylesheet" href="/public/front/css/style.css">
	<link rel="stylesheet" href="/public/front/css/media.css">


	<!-- connect csss -->
</head>
<body class="auth">
	<div class="wrapper">
		<div class="sing-up-pers">
			<div class="container ">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-5 col-md-8 col-sm-10 col-12">
						<form  method="post" action="/sign-in" class="sing-up-form animate__fadeIn animate__animated wow" data-wow-duration=".8s">
                        @csrf
                        <h2>Login</h2>
							<p class=" my-4">Enter your login and password to access your panel.</p>
									 @include('layouts.errors')

							<div class="input-wrapper mt-4">
								<label for="login">Login</label>
								<input type="text" class="form-control" name="login" id="login" placeholder="Enter login" value="{{ old('login') }}">
							</div>
							<div class="input-wrapper mt-4">
								<div class="">
									<label for="login-password">Password</label>
									{{-- <a href="/forgot-password" style="float: right;" class="d-block">Forgot password?</a> --}}
									<div style="clear: both;"></div>
								</div>

								<input type="password" class="form-control" name="password" id="login-password" placeholder="Enter passord" >
							</div>
							<button     type="submite" class="btn auth-btn my-5">Sign in</button>
							<h6 class=" animate__fadeIn animate__animated wow">Don't have an account? <a href="/sign-up">Sign up</a></h6>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- connect screipts -->
	<script src="/public/front/js/jquery3.2.1.min.js"></script>
	<script src="/public/front/js/popper.min.js"></script>
	<script src="/public/front/js/bootstrap.min.js"></script>
	<script src="/public/front/js/wow.min.js"></script>
	<script src="/public/front/js/main.js"></script>
	<!-- connect screipts -->

</body>
</html>
