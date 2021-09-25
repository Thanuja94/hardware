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
						<h1>Delivery Notes</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Delivert Note</li>
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
					<h3 class="card-title">Dilivery Note List
                    <button id="add_new_grn" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> &nbsp;&nbsp; New Delivery Note</button>
                    </h3>

					
				</div>
				<div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DN ID</th>
                                <th>Supplier ID</th>
                                <th>Order ID</th>
                                <th>issue Date</th>
                                <th>Delivery Date</th>
                                <th>Item Qty</th>
                                
                            </tr>
                        </thead>
                    </table>
				</div>
				
			</div>
			<!-- /.card -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

