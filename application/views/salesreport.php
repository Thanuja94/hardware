<div class="wrapper">
 
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                
                    <div class="col-sm-8">
                        <h3 class="m-0 text-dark" style="text-align:right;">Kithmi Holding Hardware Stores</h3>
                        <h5 class="m-0 text-dark" style="text-align:right;">Building No, Street Name, City, Street,Zip</h5>
                        <h5 class="m-0 text-dark" style="text-align:right;">Contact No: 011 255 6666 / 077 5677 722</h5>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sales Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
 
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3>Sales Report</h3>
                    <div class="col-sm-12">
                    <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body">
              <table id="salereporttable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-aligh:left;">Item Code</th>
                  <th style="text-aligh:left;">Item Name</th>
                  <th style="text-aligh:left;">Item Group</th>
                  <th style="text-aligh:left;">Unit Price (Rs.)</th>
                  <th style="text-aligh:left;">Type</th>
                  <th style="text-aligh:left;">Sales Qty</th>
                  <th style="text-aligh:left;">Total Price (Rs.)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sales_data->result() as $sales) { ?>
                    <tr>
                        <td><?php echo $sales->item_code?></td>
                        <td><?php echo $sales->item_name?></td>
                        <td><?php echo $sales->sku_name?></td>
                        <td><?php echo number_format($sales->unit_price,2,'.',',')?></td>
                        <td><?php echo $sales->unit_type?></td>
                        <td><?php echo $sales->qty?></td>
                        <td><?php echo number_format($sales->total_price,2,'.',',')?></td>
                    </tr>
                <?php } ?>
                
              </table>
            </div>
         </div>
            </div>
            </div>
 
            </div>
        </section>
    </div>
 
 

