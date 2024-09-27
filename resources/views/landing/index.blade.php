@extends('landing.app')

@section('content')
<!-- ======= Hero Section ======= -->
<section class="p-0">
	<div class="container-fluid">
		<video autoplay="" muted="no" loop="" class="fullscreen-video col-lg-12">
			<source src="{{asset('landing/video/default.mp4')}}" type="video/mp4">
		</video>
	</div>
</section><!-- End Hero -->
<section id="edu-aboutus-section" class="ed-about-us layout-2 clearfix">
		<div class="section-seperator top-section-seperator svg-big-triangle-center-wrap">
			<svg class="svg-big-triangle" fill="#FF0000" width="100%" height="100%" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331">
			<path d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"></path>
			</svg>
		</div>
		<div class="section-wrap full-width">
			<div class="container">			
      			<div class="ed-header layout-2">
          			<h2 class="section-header">Kata Sambutan KAPRODI</h2>
              		<p class="section-tagline-text">Rakhmat Kurniawan R, S.T., M.Kom</p>        
      			</div>
    			<div class="edu-press-wrap">
					<div class="ed-about-content">					
						<div class="">
							<div class="d-flex">
								<div class="col-md-6">
									<figure class="text-center size-large is-resized">
										<img decoding="async" src="{{asset('landing/img/kaprodi.png')}}" alt="" style="width:327px;height:auto">
									</figure>
								</div>
								<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
									<details class="wp-block-details is-layout-flow wp-block-details-is-layout-flow" open=""><summary><i class="fas fa-circle-chevron-down"></i> Selamat Datang di Prodi Sistem Informasi</summary>
										<p class="text-muted">Sistem informasi memiliki visi Menjadi program studi yang memiliki keunggulan pada bidang software development dan digital enterprise dengan paradigma wahdatul ulum di Indonesia pada tahun 2030.
										<br>Program Studi Sistem Informasi ini menyelenggarakan pendidikan dan penelitian inovatif sesuai dengan perkembangan sistem informasi dan kebutuhan bisnis, mengabdikan diri kepada masyarakat untuk kemajuan, serta mengembangkan jejaring kerjasama dan meningkatkan daya saing lulusan melalui sistem penjaminan mutu pendidikan tinggi yang berkesinambungan, semuanya dengan paradigma wahdatul ulum.
										</p>
									</details>
									<details class="wp-block-details is-layout-flow wp-block-details-is-layout-flow"><summary><i class="fas fa-circle-chevron-down"></i> Tujuan Prodi Sistem Informasi</summary>
									<p>Program studi ini bertujuan menghasilkan lulusan berkarakter ulul albab dengan jiwa entrepreneur dan daya saing global di bidang sistem informasi bisnis, serta menghasilkan penelitian, publikasi, dan karya pengabdian masyarakat yang kompetitif dan berkontribusi pada kemajuan IPTEK dan kualitas kehidupan masyarakat. Selain itu, program ini menjalin kerjasama berkelanjutan dengan berbagai mitra untuk mendukung tridarma perguruan tinggi, dan menerapkan tata kelola yang responsif dengan pelayanan prima.</p>
									</details>
									<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
									<p>“<em>"Menjadi Pemimpin Berkarakter Ulul Albab dengan Jiwa Entrepreneur di Era Global"</em>“</p>
										<!--<cite><strong>~Simpulan chat GPT</strong></cite>-->
									</blockquote>
								</div>
							</div>
						</div>
						<div class="ed-about-list ui-accordion ui-widget ui-helper-reset" id="edu-accordion" role="tablist">
						</div>
					</div>
				</div>
			</div>
		</div> <!-- section wrap -->
		<div class="section-seperator bottom-section-seperator svg-big-triangle-center-wrap"><svg class="svg-big-triangle" fill="#FF0000" width="100%" height="100%" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331">
			<path d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"></path>
			</svg>
		</div>
	</section>
@endsection