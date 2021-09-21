<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>

<script>

    var baseUrl = "<?php echo base_url()?>";

    const loadingWidget = {
        show: function () {
            $("#loader").addClass("loader");
        },
        hide: function () {
            $("#loader").removeClass("loader");
        },
    };

    var myTableArray = [];

    let rowCount = 0;

    function removeRecord(itemCode) {

        let parentId = 'item'+itemCode;

        let totalQty = $("#total_qty");
        let grossTotal = $("#gross_total");
        let item_discount = $("#item_discount");
        let discountTotal = $("#total_discount");
        let qtyTotal = $("#total_qty");
        let netTotal = $('#net_total');


        discountTotal.val(discountTotal.val() - (( $('#'+parentId+'> .selling_price').html() ) * ( $('#'+parentId+'> .qty').html() ) * ( $('#'+parentId+'> .discount_pct').html() )/100) )


        totalQty.val(totalQty.val() - $('#'+parentId+'> .qty').html());
        // discountTotal.val(discountTotal.val() - (( $('#'+parentId+'> .selling_price').html() ) * ( $('#'+parentId+'> .discount_pct').html() )/100) )
        grossTotal.val(grossTotal.val() - ( $('#'+parentId+'> .selling_price').html() * $('#'+parentId+'> .qty').html()));
        netTotal.val(netTotal.val() - ( $('#'+parentId+'> .total_value').html() ));

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
                $cusName: $("#cus_name"),
                $cusAddress: $("#cus_address"),
                $cusTel: $("#cus_tel"),

                $grossTotal: 0,
                $qtyTotal: 0,
                $discountTotal: 0,
                $netTotal: 0,
                $spinner: $("#loader"),

                init: function () {
                    this.handleEvents();
                },
                handleEvents: function () {
                    const context = this;
                    this.$btnAdd.on("click", function (e) {
                        e.preventDefault();
                        context.addNewTranRecord();
                    });
                    this.$btnSaveTans.on("click", function (e) {
                        e.preventDefault();

                        if ($('#example1 tbody tr').length > 0){
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
                    });

                },
                addNewTranRecord: function () {
                    this.getItemDetails();
                },
                getItemDetails: function () {
                    loadingWidget.show();
                    const context = this;
                    $.get(
                        baseUrl + "get_item_details?item_code=" + context.$item_code.val(),
                        function (res) {
                            context.addNewRecord($.parseJSON(res));
                        }
                    ).fail(function (error) {
                        console.log("error", error);
                        loadingWidget.hide();
                    });
                },
                addNewRecord: function (data) {
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
                        `<td>` + data.sku_name + `</td>` +
                        `<td class='selling_price'>` + data.selling_price + `</td>` +
                        `<td>` + data.unit_type + `</td>` +
                        `<td class='qty'>` + qty + `</td>` +
                        `<td class='discount_pct'>` + discountPct + `</td>` +
                        `<td class='total_value'>` + totalAfterDiscount + `</td>` +
                        `<td> <button type='button' class = 'btn btn-danger'  onClick='removeRecord("` + rowCount + `")'> <i class='fa fa-trash' aria-hidden='true'></i> </button>` + `</td>` +
                        +`<tr>`
                    )

                    // this.$txt_gross_total.val(this.$grossTotal);
                    this.$txt_gross_total.val( Number(this.$txt_gross_total.val()) + Number(total));
                    this.$txt_total_qty.val( Number(this.$txt_total_qty.val()) + Number(qty));
                    // this.$txt_total_qty.val(this.$qtyTotal);
                    // this.$txt_total_discount.val(this.$discountTotal);
                    this.$txt_total_discount.val(Number(this.$txt_total_discount.val()) + Number(discount));
                    this.$txt_net_total.val(Number(this.$txt_gross_total.val()) - Number(this.$txt_total_discount.val()));

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
                        myTableArray.push(arrayOfThisRow);
                    });

                    $.post(
                        baseUrl+"save_transaction",
                        {
                            invoice_number: this.$invNo.val(),
                            inv_date: this.$invDate.val(),
                            cus_name: this.$cusName.val(),
                            cus_address: this.$cusAddress.val(),
                            cus_tel: this.$cusTel.val(),
                            gross_total: this.$txt_gross_total.val(),
                            total_qty: this.$qtyTotal,
                            tax_amt: this.$txt_tax_amt.val(),
                            total_discount: this.$txt_total_discount.val(),
                            net_total: this.$txt_net_total.val(),
                            item_list: JSON.stringify(myTableArray)
                        },
                        function (result) {

                            var res = $.parseJSON(result);

                            if(res.status==1){
                                Swal.fire({
                                    title: 'Transaction added Successfully...',
                                    confirmButtonText: `OK`,
                                    icon:'success'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?php echo base_url()?>invoice?id="+res.trans_id;
                                    }
                                })
                            }
                        }
                    ).fail(function (error) {
                        console.log("error", error);
                        loadingWidget.hide();
                    });

                },
            };
            salesTransObj.init();

        });

    })(jQuery);


</script>