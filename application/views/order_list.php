<!-- Site wrapper -->
<div class="wrapper">
	<!-- Navbar -->

	<!-- /.navbar -->


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Orders</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Orders</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Order List &nbsp; &nbsp;
                    <a href="<?php echo base_url()?>add_new_order"> 
                        <button id="add_new_order" class="btn btn-primary">
                            <i class="fa fa-plus"></i> &nbsp;&nbsp; New Order</button>
                    </a>
                    </h3>

					
				</div>
				<div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Supplier ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
				</div>
				<!-- /.card-body -->
				
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

