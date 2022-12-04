<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
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
						<form method="post" action="/sign-up" class="sing-up-form animate__fadeIn animate__animated wow" data-wow-duration=".8s">
                           @csrf

                            <h2>Sing Up</h2>
							<p class=" my-4">Enter your  address  to access  panel.</p>
                            @include('layouts.errors')

							<div class="input-wrapper mt-4">
								<label for="user-name">Name</label>
								<input type="text" class="form-control" name="name" id="user-name" placeholder="Enter name" value="{{ old('name') }}" required>
							</div>
                        	<div class="input-wrapper mt-4">
								<label for="user-surname">Surname</label>
								<input type="text" class="form-control" name="surname" id="user-surname" placeholder="Enter surname" value="{{ old('surname') }}">
							</div>
                            <div class="input-wrapper mt-4">
								<label for="user-login">Login</label>
								<input type="text" class="form-control" name="login" id="user-login" placeholder="Enter unique login" value={{ old('login') }}>
							</div>
                        	<div class="input-wrapper mt-4">
								<label for="user-password">Password</label>
								<input type="password" class="form-control" name="password" id="user-password" placeholder="Enter password min 6 characters">
							</div>
							<div class="input-wrapper mt-4">
								<label for="user-re-password">Confirm</label>
								<input type="password" class="form-control" name="confirm_password" id="user-re-password" placeholder="Confirm password">
							</div>

							<button   id="submit" type="submit" class="btn auth-btn my-5">Sign up</button>
							<h6 class=" animate__fadeIn animate__animated wow">Already have an account ? <a href="/sign-in">Log In</a></h6>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- connect screipts -->
	<script src="/public/front/js/jquery3.5.min.js"></script>
	<script src="/public/front/js/popper.min.js"></script>
	<script src="/public/front/js/bootstrap.min.js"></script>
	<script src="/public/front/js/wow.min.js"></script>
	<!-- <script src="/public/front/js/main.js"></script> -->
	<!-- connect screipts -->

</body>
</html>
