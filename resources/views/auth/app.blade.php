<!DOCTYPE html>
<html>
<head>
	<title>Login | {{env('APP_NAME')}}</title>
 	<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/yui-moodlesimple-min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page-login-index">
    @yield('content')
    <script type="text/javascript" src="{{asset('assets/login/js/polyfill.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/login/js/polyfill.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/login/js/yui-moodlesimple-min.js')}}"></script>
  	<script src="<?= asset('assets/js/toastr.js') ?>"></script>
	<script>
		@if (session('message'))
        <?php switch (session('info')) {
            case "success":
                ?>
                toastr.success('<?= session('message') ?>');
            <?php break;
            case "info":
                ?>
                toastr.info('<?= session('message') ?>');
            <?php break;
            case "error": ?>
                toastr.error('<?= session('message') ?>');
            <?php break;
            default: ?>
                toastr.warning('<?= session('message') ?>');
        <?php }; ?>
    	@endif
	</script>
</body>
</html>

    