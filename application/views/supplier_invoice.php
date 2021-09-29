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
						<h1>Supplier Invoice</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Supplier Invoice</li>
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
					<h3 class="card-title">Supplier Invoice List &nbsp; &nbsp;
                    <a href="<?php echo base_url()?>add_new_sup_invoice"> 
                    <button id="add_new_sup_inv" class="btn btn-primary"  >
                       
                       <i class="fa fa-plus"></i> &nbsp;&nbsp; New Supplier Invoice</button>
                    </a>

                    
                    </h3>

				
				</div>
				<div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice ID</th>
                                <th>Supplier ID</th>
                                <th>Invoice Date</th>
                                <th>Net Total</th>
                                <th>Discount</th>
                                <th>Gross Total</th>
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

