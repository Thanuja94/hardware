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
            $btn_save_sup_inv: $("#btn_save_sup_inv"),

            $sup_inv_id: $("#sup_inv_id"),
            $supplier_id: $("#supplier_id"),
            $inv_date: $("#inv_date"),

            $gross_total: $("#gross_total"),
            $discount: $("#discount"),
            $net_total: $("#net_total"),

            $stock_id: $("#stock_id"),
            $item_code: $("#item_code"),
            $item_qty: $("#item_qty"),

            $table: $("#example1"),


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
                this.$stock_id.on("change", function(e) {
                    e.preventDefault();
                    context.getItems();
                });
                this.$btn_save_sup_inv.on("click", function(e) {
                    e.preventDefault();

                    if(context.$gross_total.val() && context.$net_total.val()){

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
                                    context.saveSupInvoice();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'please add records before submit!',
                            })
                        }
                    } else{
                        Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please Fill all require data!',
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
                    baseUrl + "get_item_details_for_sup_inv?item_code=" + context.$item_code
                    .val() + "&stock_id=" + context.$stock_id.val(),
                    function(res) {
                        context.addNewRecord($.parseJSON(res));
                    }
                ).fail(function(error) {
                    console.log("error", error);
                    loadingWidget.hide();
                });
            },
            getItems: function() {
                var stock_id = document.getElementById("stock_id").value;
                loadingWidget.show();
                $('#item_code').children().remove();
                $.get(
                    baseUrl + "get_items_for_stocks?stock_id=" + stock_id,
                    function(res) {
                        res = $.parseJSON(res);
                        $.each(res, (key, value) => {
                            $('#item_code').append(
                                $('<option>', {
                                    value: value.item_code,
                                    text: value.item_code
                                })
                            )
                        })

                        loadingWidget.hide();
                    }
                ).fail(function(error) {
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

                if (this.$item_qty.val() > 0) {
                    total = data.purchased_price * this.$item_qty.val();
                } else {
                    total = data.purchased_price;
                }

                qty = this.$item_qty.val();


                this.$table.append(
                    `<tr class='data_row' id='item` + rowCount + `' >` +
                    `<td class='stock_id'>` + data.stock_id + `</td>` +
                    `<td class='item_code'>` + data.item_code + `</td>` +
                    `<td>` + data.item_name + `</td>` +
                    `<td>` + data.item_group + `</td>` +
                    `<td class='qty'>` + qty + `</td>` +
                    `<td class='unit_price'>` + data.purchased_price + `</td>` +
                    `<td class='total_value'>` + total + `</td>` +
                    `<td> <button type='button' class = 'btn btn-danger'  onClick='removeRecord("` +
                    rowCount + `")'> <i class='fa fa-trash' aria-hidden='true'></i> </button>` +
                    `</td>` +
                    +`<tr>`
                )



                loadingWidget.hide();

                this.$item_qty.val('');

            },
            saveSupInvoice: function() {

                $('#example1 tbody tr').each(function() {
                    var arrayOfThisRow = [];


                    arrayOfThisRow[0] = $(this).find(".item_code").html();
                    arrayOfThisRow[1] = $(this).find(".stock_id").html();
                    arrayOfThisRow[2] = $(this).find(".unit_price").html();
                    arrayOfThisRow[3] = $(this).find(".qty").html();
                    arrayOfThisRow[4] = $(this).find(".total_value").html();
                    

                    myTableArray.push(arrayOfThisRow);
                });

                $.post(
                    baseUrl + "save_sup_invoice", {

                        //stock_id: this.$stock_id.val(),
                        supplier_id: this.$supplier_id.val(),
                        sup_inv_id: this.$sup_inv_id.val(),
                        inv_date: this.$inv_date.val(),
                        gross_total: this.$gross_total.val(),
                        net_total: this.$net_total.val(),
                        discount: this.$discount.val(),
                        item_list: JSON.stringify(myTableArray)
                    },
                    function(result) {

                        var res = $.parseJSON(result);

                        if (res.status == 1) {
                            Swal.fire({
                                title: 'Supplier Invoice Saved Successfully',
                                confirmButtonText: `OK`,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "<?php echo base_url()?>supplier_invoice"

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