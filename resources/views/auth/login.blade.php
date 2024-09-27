@extends('auth.app')

@section('content')
<div id="page-wrapper">
	<div id="page" class="container-fluid mt-0">
        <div id="page-content" class="row">
            <div id="region-main-box" class="col-12">
                <section id="region-main" class="col-12" aria-label="Content">
                    <span class="notifications" id="user-notifications"></span>
                    <div role="main" id="yui_3_17_2_1_1718309477679_21"><span id="maincontent"></span><div class="my-1 my-sm-5"></div>
					<div class="row justify-content-center" id="yui_3_17_2_1_1718309477679_20">
					<div class="col-xl-6 col-sm-8 " id="yui_3_17_2_1_1718309477679_29">
					<div class="card" id="yui_3_17_2_1_1718309477679_28">
   					<div class="card-block" id="yui_3_17_2_1_1718309477679_27">
            		<h2 class="card-header text-center"><img src="{{asset('assets/login/img/header.png')}}" class="img-fluid" title="E-learning UIN Sumatera Utara" alt="E-learning UIN Sumatera Utara"></h2>
        			<div class="card-body" id="yui_3_17_2_1_1718309477679_26">
                	<div class="sr-only">
                	    <a href="https://elearning.uinsu.ac.id/login/signup.php">Skip to create new account</a>
                	</div>
            <div class="row justify-content-md-center" id="yui_3_17_2_1_1718309477679_25">
                <div class="col-md-8">
                    <form class="mt-3" action="{{route('custom.login')}}" method="post" id="login">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="sr-only">
                                    Email
                            </label>
                            <input type="text" name="email" id="username" class="form-control" value="" placeholder="Email Pengguna" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-control" placeholder="Password" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3" id="loginbtn">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


		<div class="row justify-content-center mt-3">
			<div class="col-xl-6 col-sm-8">
				<div class="card">
		    		<div class="card-body">
		        		<div class="card-title">
		            		<h2>Belum memiliki akun?</h2>
		        		</div>
		        		<div>
		        			<p>Jika anda belum pernah mendaftarkan diri sebelumnya, silahkan membuat akun terlebih dahulu disini dengan mengklik tombol&nbsp;<strong>Buat Akun Baru</strong>&nbsp;<br></p>
		            		<form class="mt-3" action="{{route('register')}}" method="get" id="signup">
		            		    <button type="submit" class="btn btn-secondary">Buat Akun Baru</button>
		            		</form>
		        		</div>
		    		</div>
				</div>
			</div>
		</div>
	</div>
    </section>
            </div>
        </div>
    </div>
</div>
@endsection