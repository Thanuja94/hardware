<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>

<script>
var baseUrl = "<?php echo base_url()?>";

const loadingWidget = {
    show: function() {
        $("#loader").addClass("loader");
    },
    hide: function() {
        $("#loader").removeClass("loader");
    },
};

var myTableArray = [];

let rowCount = 0;

function removeRecord(itemCode) {

    let parentId = 'item' + itemCode;

   

    $('#item' + itemCode).remove();

}



(function($) {
    "use strict";
    $(function() {

        const newOrderObj = {
            $btnAdd: $("#btn_add"),
            $btnRemove: $("#btn_add"),
            $btn_save_grn: $("#btn_save_grn"),


            $stock_id: $("#stock_id"),
            $item_code: $("#item_code"),
            $item_qty: $("#item_qty"),

            $table: $("#example1"),

            $grn_id: $("#grn_id"),
            $supplier_id: $("#supplier_id"),
            $delivered_date: $("#delivered_date"),
            $comments: $("#comments"),



            $spinner: $("#loader"),

            init: function() {
                this.handleEvents();
            },
            handleEvents: function() {
                const context = this;
                this.$btnAdd.on("click", function(e) {
                    e.preventDefault();
                    context.addNewTranRecord();
                });
                this.$stock_id.on("change", function (e) {
                        e.preventDefault();
                        context.getItems();
                    });
                this.$btn_save_order.on("click", function(e) {
                    e.preventDefault();

                    if ($('#example1 tbody tr').length > 0) {
                        Swal.fire({
                            title: 'Are you sure?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Save it!'
                        }).then((result) => {
                            if (result.value) {
                                context.saveOrderRecords();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'please add records before submit!',
                        })
                    }
                });

            },
            addNewTranRecord: function() {
                this.getItemDetails();
            },
            getItemDetails: function() {
                loadingWidget.show();
                const context = this;
                $.get(
                    baseUrl + "get_item_details_for_grn?item_code=" + context.$item_code.val() + "&stock_id=" +context.$stock_id.val(),
                    function(res) {
                        context.addNewRecord($.parseJSON(res));
                    }
                ).fail(function(error) {
                    console.log("error", error);
                    loadingWidget.hide();
                });
            },
            getItems: function () {
                    var stock_id = document.getElementById("stock_id").value;
                    loadingWidget.show();
                    $('#item_code').children().remove();
                    $.get(
                        baseUrl + "get_items_for_stocks?stock_id=" + stock_id,
                        function (res) {
                            res = $.parseJSON(res);
                            $.each(res, ( key, value ) => {
                                $('#item_code').append(
                                    $('<option>',{value: value.item_code,text: value.item_code})
                                )
                            })

                            loadingWidget.hide();
                        }
                    ).fail(function (error) {
                        console.log("error", error);
                        loadingWidget.hide();
                    });
                },
            addNewRecord: function(data) {
                var total = 0;
                var qty = 1;
                var discount = 0;
                var discountPct = 0;
                var totalAfterDiscount = 0;

                ++rowCount;

                
                    qty = this.$item_qty.val();
               

                this.$table.append(
                    `<tr class='data_row' id='item` + rowCount + `' >` +
                    `<td>` + data.stock_id + `</td>` +
                    `<td class='item_code'>` + data.item_code + `</td>` +
                    `<td>` + data.item_name + `</td>` +
                    `<td>` + data.item_group + `</td>` +
                    `<td class='qty'>` + qty + `</td>` +
                    `<td> <button type='button' class = 'btn btn-danger'  onClick='removeRecord("` +
                    rowCount + `")'> <i class='fa fa-trash' aria-hidden='true'></i> </button>` +
                    `</td>` +
                    +`<tr>`
                )

               

                loadingWidget.hide();

                this.$item_qty.val('');
               
            },
            saveOrderRecords: function() {

                $('#example1 tbody tr').each(function() {
                    var arrayOfThisRow = [];

                    arrayOfThisRow[0] = $(this).find(".item_code").html();
                    arrayOfThisRow[1] = $(this).find(".qty").html();
                   
                   
                    myTableArray.push(arrayOfThisRow);
                });

                $.post(
                    baseUrl + "save_grn", {
                       
                        supplier_id: this.$supplier_id.val(),
                      
                        item_list: JSON.stringify(myTableArray)
                    },
                    function(result) {

                        var res = $.parseJSON(result);

                        if (res.status == 1) {
                            Swal.fire({
                                title: 'GRN Saved Successfully',
                                confirmButtonText: `OK`,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "<?php echo base_url()?>view_GRN" 
                                        
                                }
                            })
                        }
                    }
                ).fail(function(error) {
                    console.log("error", error);
                    loadingWidget.hide();
                });

            },
        };
        newOrderObj.init();

    });

})(jQuery);
</script>