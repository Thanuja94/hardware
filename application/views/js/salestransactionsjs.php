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
var myStockTableArray = [];

let rowCount = 0;

function removeRecord(itemCode) {

    let parentId = 'item' + itemCode;

    let totalQty = $("#total_qty");
    let grossTotal = $("#gross_total");
    let item_discount = $("#item_discount");
    let discountTotal = $("#total_discount");
    let qtyTotal = $("#total_qty");
    let netTotal = $('#net_total');


    discountTotal.val(discountTotal.val() - (($('#' + parentId + '> .selling_price').html()) * ($('#' + parentId +
        '> .qty').html()) * ($('#' + parentId + '> .discount_pct').html()) / 100))


    totalQty.val(totalQty.val() - $('#' + parentId + '> .qty').html());
    // discountTotal.val(discountTotal.val() - (( $('#'+parentId+'> .selling_price').html() ) * ( $('#'+parentId+'> .discount_pct').html() )/100) )
    grossTotal.val(grossTotal.val() - ($('#' + parentId + '> .selling_price').html() * $('#' + parentId + '> .qty')
        .html()));
    netTotal.val(netTotal.val() - ($('#' + parentId + '> .total_value').html()));

    $('#item' + itemCode).remove();

}


(function($) {
    "use strict";
    $(function() {

        const salesTransObj = {
            $btnAdd: $("#btn_add"),
            $btnRemove: $("#btn_add"),
            $btnSaveTans: $("#btn_save_tans"),
            $txt_gross_total: $("#gross_total"),
            $txt_total_qty: $("#total_qty"),
            $txt_tax_amt: $("#tax_amt"),
            $txt_total_discount: $("#total_discount"),
            $txt_net_total: $("#net_total"),
            $item_code: $("#item_code"),
            $item_qty: $("#item_qty"),
            $item_discount: $("#item_discount"),
            $table: $("#example1"),

            $invNo: $("#inv_no"),
            $invDate: $("#inv_date"),
            $cusName: $("#customer_name"),
            $cusAddress1: $("#address_line_1"),
            $cusAddress2: $("#address_line_2"),
            $cusAddress3: $("#address_line_3"),
            $cusTel: $("#cus_tel"),
            $stockId: $("#stock_id"),

            $grossTotal: 0,
            $qtyTotal: 0,
            $discountTotal: 0,
            $netTotal: 0,
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
                this.$item_code.on("change", function(e) {
                    e.preventDefault();
                    context.getStockDetails();
                });
                this.$btnSaveTans.on("click", function(e) {
                    e.preventDefault();

                    if (context.$cusName.val() && context.$cusTel.val() && context.$cusAddress1.val() && context.$cusAddress2.val() && context.$cusAddress3.val()) {

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
                                    context.saveTranRecords();
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
                    baseUrl + "get_item_details?item_code=" + context.$item_code.val() +
                    "&stock_id=" + context.$stockId.val(),
                    function(res) {
                        context.addNewRecord($.parseJSON(res));
                    }
                ).fail(function(error) {
                    console.log("error", error);
                    loadingWidget.hide();
                });
            },
            getStockDetails: function() {
                var item_code = document.getElementById("item_code").value;
                loadingWidget.show();
                $('#stock_id').children().remove();
                $.get(
                    baseUrl + "get_stocks_for_item?item_code=" + item_code,
                    function(res) {
                        res = $.parseJSON(res);
                        $.each(res, (key, value) => {
                            $('#stock_id').append(
                                $('<option>', {
                                    value: value.stock_id,
                                    text: value.stock_id
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
                    total = data.selling_price * this.$item_qty.val();
                } else {
                    total = data.selling_price;
                }
                this.$grossTotal += Number(total);

                if (this.$item_discount.val() > 0) {
                    discount = (total * this.$item_discount.val() / 100);
                    discountPct = this.$item_discount.val();
                }
                totalAfterDiscount = total - discount;
                this.$discountTotal += Number(discount);

                if (this.$item_qty.val() > 0)
                    qty = this.$item_qty.val();
                this.$qtyTotal += Number(qty);

                this.$table.append(
                    `<tr class='data_row' id='item` + rowCount + `' >` +
                    `<td class='item_code'>` + data.item_code + `</td>` +
                    `<td>` + data.item_name + `</td>` +
                    `<td>` + data.item_group + `</td>` +
                    `<td class='stock_id'>` + data.stock_id + `</td>` +
                    `<td class='selling_price'>` + data.selling_price + `</td>` +
                    `<td>` + data.unit_type + `</td>` +
                    `<td class='qty'>` + qty + `</td>` +
                    `<td class='discount_pct'>` + discountPct + `</td>` +
                    `<td class='total_value'>` + totalAfterDiscount + `</td>` +
                    `<td> <button type='button' class = 'btn btn-danger'  onClick='removeRecord("` +
                    rowCount + `")'> <i class='fa fa-trash' aria-hidden='true'></i> </button>` +
                    `</td>` +
                    +`<tr>`
                )

                // this.$txt_gross_total.val(this.$grossTotal);
                this.$txt_gross_total.val(Number(this.$txt_gross_total.val()) + Number(total));
                this.$txt_total_qty.val(Number(this.$txt_total_qty.val()) + Number(qty));
                // this.$txt_total_qty.val(this.$qtyTotal);
                // this.$txt_total_discount.val(this.$discountTotal);
                this.$txt_total_discount.val(Number(this.$txt_total_discount.val()) + Number(
                    discount));
                this.$txt_net_total.val(Number(this.$txt_gross_total.val()) - Number(this
                    .$txt_total_discount.val()));

                loadingWidget.hide();

                this.$item_qty.val('');
                this.$item_discount.val('');
            },
            saveTranRecords: function() {

                $('#example1 tbody tr').each(function() {
                    var arrayOfThisRow = [];


                    arrayOfThisRow[0] = $(this).find(".item_code").html();
                    arrayOfThisRow[1] = $(this).find(".selling_price").html();
                    arrayOfThisRow[2] = $(this).find(".discount_pct").html();
                    arrayOfThisRow[3] = $(this).find(".qty").html();
                    arrayOfThisRow[4] = $(this).find(".total_value").html();
                    arrayOfThisRow[5] = $(this).find(".stock_id").html();
                    myTableArray.push(arrayOfThisRow);


                });

                $.post(
                    baseUrl + "save_transaction", {
                        invoice_number: this.$invNo.val(),
                        inv_date: this.$invDate.val(),
                        customer_name: this.$cusName.val(),
                        address_line_1: this.$cusAddress1.val(),
                        address_line_2: this.$cusAddress2.val(),
                        address_line_3: this.$cusAddress3.val(),
                        cus_tel: this.$cusTel.val(),
                        gross_total: this.$txt_gross_total.val(),
                        total_qty: this.$qtyTotal,
                        tax_amt: this.$txt_tax_amt.val(),
                        total_discount: this.$txt_total_discount.val(),
                        net_total: this.$txt_net_total.val(),
                        stock_id: this.$stockId.val(),
                        item_list: JSON.stringify(myTableArray)
                    },
                    function(result) {

                        var res = $.parseJSON(result);

                        if (res.status == 1) {
                            Swal.fire({
                                title: 'Transaction added Successfully...',
                                confirmButtonText: `OK`,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "<?php echo base_url()?>invoice?id=" + res
                                        .trans_id;
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
        salesTransObj.init();

    });

})(jQuery);
</script>