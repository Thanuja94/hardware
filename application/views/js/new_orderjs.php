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

    // let totalQty = $("#total_qty");
    // let grossTotal = $("#gross_total");
    // let item_discount = $("#item_discount");
    // let discountTotal = $("#total_discount");
    // let qtyTotal = $("#total_qty");
    // let netTotal = $('#net_total');


    // discountTotal.val(discountTotal.val() - (($('#' + parentId + '> .selling_price').html()) * ($('#' + parentId +
    //     '> .qty').html()) * ($('#' + parentId + '> .discount_pct').html()) / 100))


    // totalQty.val(totalQty.val() - $('#' + parentId + '> .qty').html());
    // // discountTotal.val(discountTotal.val() - (( $('#'+parentId+'> .selling_price').html() ) * ( $('#'+parentId+'> .discount_pct').html() )/100) )
    // grossTotal.val(grossTotal.val() - ($('#' + parentId + '> .selling_price').html() * $('#' + parentId + '> .qty')
    //     .html()));
    // netTotal.val(netTotal.val() - ($('#' + parentId + '> .total_value').html()));

    $('#item' + itemCode).remove();

}



(function($) {
    "use strict";
    $(function() {

        const newOrderObj = {
            $btnAdd: $("#btn_add"),
            $btnRemove: $("#btn_add"),
            $btn_save_order: $("#btn_save_order"),



            $item_code: $("#item_code"),
            $item_qty: $("#item_qty"),

            $table: $("#example1"),

            $order_id: $("#order_id"),
            $supplier_id: $("#supplier_id"),
            $order_date: $("#order_date"),



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
                this.$btn_save_order.on("click", function(e) {
                    e.preventDefault();

                    if (context.$order_date.val()) {

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

                    } else {
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
                    baseUrl + "get_item_details_for_order?item_code=" + context.$item_code
                .val(),
                    function(res) {
                        context.addNewRecord($.parseJSON(res));
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

                // if (this.$item_qty.val() > 0) {
                //     total = data.selling_price * this.$item_qty.val();
                // } else {
                //     total = data.selling_price;
                // }
                // this.$grossTotal += Number(total);

                // if (this.$item_discount.val() > 0) {
                //     discount = (total * this.$item_discount.val() / 100);
                //     discountPct = this.$item_discount.val();
                // }
                // totalAfterDiscount = total - discount;
                // this.$discountTotal += Number(discount);

                // if (this.$item_qty.val() > 0)
                qty = this.$item_qty.val();
                // this.$qtyTotal += Number(qty);

                this.$table.append(
                    `<tr class='data_row' id='item` + rowCount + `' >` +
                    `<td class='item_code'>` + data.item_code + `</td>` +
                    `<td>` + data.item_name + `</td>` +
                    `<td>` + data.item_group + `</td>` +
                    `<td class='qty'>` + qty + `</td>` +
                    `<td> <button type='button' class = 'btn btn-danger'  onClick='removeRecord("` +
                    rowCount + `")'> <i class='fa fa-trash' aria-hidden='true'></i> </button>` +
                    `</td>` +
                    +`<tr>`
                )

                // this.$txt_gross_total.val(this.$grossTotal);
                // this.$txt_gross_total.val(Number(this.$txt_gross_total.val()) + Number(total));
                // this.$txt_total_qty.val(Number(this.$txt_total_qty.val()) + Number(qty));
                // this.$txt_total_qty.val(this.$qtyTotal);
                // this.$txt_total_discount.val(this.$discountTotal);
                // this.$txt_total_discount.val(Number(this.$txt_total_discount.val()) + Number(
                // discount));
                // this.$txt_net_total.val(Number(this.$txt_gross_total.val()) - Number(this
                // .$txt_total_discount.val()));

                loadingWidget.hide();

                this.$item_qty.val('');
                // this.$item_discount.val('');
            },
            saveOrderRecords: function() {

                $('#example1 tbody tr').each(function() {
                    var arrayOfThisRow = [];

                    arrayOfThisRow[0] = $(this).find(".item_code").html();
                    arrayOfThisRow[1] = $(this).find(".qty").html();
                    // arrayOfThisRow[1] = $(this).find(".selling_price").html();
                    // arrayOfThisRow[2] = $(this).find(".discount_pct").html();

                    // arrayOfThisRow[4] = $(this).find(".total_value").html();
                    myTableArray.push(arrayOfThisRow);
                });

                $.post(
                    baseUrl + "save_order", {
                        order_id: this.$order_id.val(),
                        order_date: this.$order_date.val(),
                        supplier_id: this.$supplier_id.val(),
                        // address_line_1: this.$cusAddress1.val(),
                        // address_line_2: this.$cusAddress2.val(),
                        // address_line_3: this.$cusAddress3.val(),
                        // cus_tel: this.$cusTel.val(),
                        // gross_total: this.$txt_gross_total.val(),
                        // total_qty: this.$qtyTotal,
                        // tax_amt: this.$txt_tax_amt.val(),
                        // total_discount: this.$txt_total_discount.val(),
                        // net_total: this.$txt_net_total.val(),
                        item_list: JSON.stringify(myTableArray)
                    },
                    function(result) {

                        var res = $.parseJSON(result);

                        if (res.status == 1) {
                            Swal.fire({
                                title: 'Order Saved Successfully',
                                confirmButtonText: `OK`,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "<?php echo base_url()?>order_list"

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