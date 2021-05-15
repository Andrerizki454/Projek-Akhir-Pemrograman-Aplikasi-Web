<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<!-- <a href="../index.html" class="logo">
					<img src="{{asset('assets/img/logo.svg')}}" alt="navbar brand" class="navbar-brand">
				</a> -->
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="{{route('home')}}">
								<i class="fas fa-home"></i>
								<p>Beranda</p>
							</a>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#buku" class="collapsed" aria-expanded="false">
								<i class="fa fa-book"></i>
								<p>Data Buku</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="buku">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('tambah_buku_view')}}">
											<span class="sub-item">Tambah Buku</span>
										</a>
									</li>
									<li>
										<a href="{{route('list_buku')}}">
											<span class="sub-item">Daftar Buku</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#borrowing" class="collapsed" aria-expanded="false">
								<i class="fa fa-clock"></i>
								<p>Pinjam/Kembali</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="borrowing">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('tambah_peminjaman_view')}}">
											<span class="sub-item">Peminjaman</span>
										</a>
									</li>
									<li>
										<a href="{{route('form_pengembalian')}}">
											<span class="sub-item">Pengembalian</span>
										</a>
									</li>
									<li>
										<a href="{{route('daftar_tertunda')}}">
											<span class="sub-item">Peminjaman Tertunda</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#user" class="collapsed" aria-expanded="false">
								<i class="fa fa-user"></i>
								<p>Peserta Perpustakaan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="user">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('tambah_peminjam_view')}}">
											<span class="sub-item">Tambah Peminjam</span>
										</a>
									</li>
									<li>
										<a href="{{route('daftar_peminjam')}}">
											<span class="sub-item">Daftar User</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Log Out</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">