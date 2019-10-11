<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<title>Lógica Fácil | Login</title>
	{{-- <meta name="description" content="Login page example"> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

	<!--end::Fonts -->

	<!--begin::Page Custom Styles(used by this page) -->
	<link href="assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />

	<!--end::Page Custom Styles -->

	<!--begin::Global Theme Styles(used by all pages) -->

	<!--begin:: Vendor Plugins -->
	<link href="assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet"
		type="text/css" />
	<link href="assets/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"
		type="text/css" />

	<!--end:: Vendor Plugins -->
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

	<!--begin::Layout Skins(used by all pages) -->
	<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="imagens/logo-icon.png" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
	class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
				style="background-image: url(assets/media/bg/bg-3.jpg);">
				<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
					<div class="kt-login__container">
						<div class="kt-login__logo" style="margin-top: -10%;
						margin-bottom: 20%;">
							<a href="#">
								<img src="imagens/logo-var.png" width="50%">
							</a>
						</div>
						<div class="kt-login__signin">
							<div class="kt-login__head" style="margin-top: -8%;">
								<h3 class="kt-login__title">Fazer Login</h3>
							</div>

							@error('email')
							<div class="alert alert-danger invalid-feedback" role="alert">
								<div class="alert-text">O email ou a senha estão incorretos. Tente novamente.</div>
							</div>
							@enderror

							<form method="POST" id="save_form" class="kt-form" action="{{ route('login') }}">
								@csrf
								<div class="col-lg-12">
									<input type="email" id="email" name="email" placeholder="Email" class="form-control" autofocus>
								</div>
								<div class="col-lg-12">
									<input type="password" id="password" name="password" placeholder="Senha" class="form-control" autofocus>
								</div>
								<div class="row kt-login__extra">
									<div class="col">
										<label class="kt-checkbox">
											<input type="checkbox" name="remember"> Lembrar
											<span></span>
										</label>
									</div>
									{{-- <div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
										</div> --}}
								</div>
								<div class="kt-login__actions">
									<button id="kt_login_signin_submit" type="submit"
										class="btn btn-brand btn-elevate kt-login__btn-primary">Fazer Login</button>
								</div>
							</form>
						</div>
						<div class="kt-login__signup" style="margin-top: -14%;">
							@include('auth.user-form')
							{{-- @include('auth.body.header-top-bar') --}}
						</div>
						<div class="kt-login__forgot">
							<div class="kt-login__head">
								<h3 class="kt-login__title">Forgotten Password ?</h3>
								<div class="kt-login__desc">Enter your email to reset your password:</div>
							</div>
							<form class="kt-form" action="">
								<div class="input-group">
									<input class="form-control" type="text" placeholder="Email" name="email"
										id="kt_email" autocomplete="off">
								</div>
								<div class="kt-login__actions">
									<button id="kt_login_forgot_submit"
										class="btn btn-brand btn-elevate kt-login__btn-primary">Request</button>&nbsp;&nbsp;
									<button id="kt_login_forgot_cancel"
										class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</button>
								</div>
							</form>
						</div>
						<div class="kt-login__account">
							<span class="kt-login__account-msg">
								Não tem uma conta ainda?
							</span>
							&nbsp;&nbsp;
							<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Crie sua
								conta!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Page -->

	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
	</script>

	<script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
	<script src="assets/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
	<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

	<!--begin::Page Scripts(used by this page) -->
	<script src="assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>
	<script src="js/auth/login.js" type="text/javascript"></script>
	<script src="js/auth/user-form.js" type="text/javascript"></script>
	<script src="assets/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>

	<!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>