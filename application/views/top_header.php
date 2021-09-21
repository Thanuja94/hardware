
<style type="text/css">
    .loader {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        background: url("<?php echo base_url()?>dist/img/loading-spinner.gif") no-repeat center center;
        z-index: 10000;
    }

</style>


<body class="sidebar-mini layout-fixed">
<div id="loader"></div>

<!-- Site wrapper -->
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light ">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="<?php echo base_url()?>dashboard" class="nav-link">Home</a>
			</li>
		</ul>

<!--		 SEARCH FORM-->
			<form class="form-inline ml-3">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!-- Notifications Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-bell"></i>
					<span class="badge badge-warning navbar-badge">0</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">0 Notifications</span>
					<div class="dropdown-divider"></div>

				</div>
			</li>

			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url()?>dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
					<span class="d-none d-md-inline"><?php echo $this->session->userdata('name'); ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- User image -->
					<li class="user-header bg-primary">
						<img src="<?php echo base_url()?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

						<p>
							<?php echo $this->session->userdata('name'); ?>
							<small><?php echo $this->session->userdata('email'); ?></small>
						</p>
					</li>
					<!-- Menu Body -->

					<!-- Menu Footer-->
					<li class="user-footer" style="text-align: center">
						<a href="<?php echo base_url('welcome/logout'); ?>" class="btn btn-danger" ><i class="fa fa-power-off"></i>&nbsp;&nbsp; Sign out</a>
					</li>
				</ul>
			</li>

		</ul>
	</nav>
