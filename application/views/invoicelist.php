<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Invoice List</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Invoice</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->


		<section class="content">
			<div class="container-fluid">
				<div class="row">

                <div class="row mb-2" style="flex:auto;">
        <div id="block1" class="form-group col-sm-0.5" style="flex:auto;">
				
                </div>
                <div id="block1" class="form-group col-sm-1.5">
				Date Range
                </div>
                
        <div class="col-sm-4">
        <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                  </div>

        <!-- <input type="text" id="txtfromdate" size="30" class="form-control"> -->
                        <!-- <div class="input-group date" id="reservationfromdate" data-target-input="nearest">
                            <input type="text" id="txtfromdate" class="form-control datetimepicker-input" data-target="#reservationfromdate"/>
                            <div class="input-group-append" data-target="#reservationfromdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> -->
        </div>

        <div class="form-group col-sm-1">
                    
                    </div>

                    <div id="block3" class="form-group col-sm-1.5">
                    Search By
                    </div>
                   
                    <div class="form-group col-sm-2">
                        <select id="searchById" class="form-control select2bs4">
                            <option disabled="disabled" selected="selected">Select an Option</option>
                            <option>Invoice No</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-0.5">
                    
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group col-sm-2">
                        <select id="idListId" class="form-control select2bs4">
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-1" style="flex:auto;">
                        <button id="btnSearch" type="button" class="btn btn-primary bg-gradient-primary">Search</button>
                    </div>
                    <div class="form-group" style="flex:auto;">
                        
                    </div>
                    </div>

                    <div class="card-body" style="background-color:#fff;">
                    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Invoice Number</th>
                    <th>No. of Items </th>
                    <th>Discounted Value Rs.</th>
                    <th>Order Total Rs.</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                </tbody>
                </table>

              </div>
                </div>
                

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- <p>One fine body&hellip;</p> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


			</div>
		</section>
	</div>
	<!-- /.content-wrapper -->



