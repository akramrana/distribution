/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class App {

    static status(url, trigger, id)
    {
        $(".global-loader").show();
        var status = 0;
        if ($('#' + trigger.id).is(":checked")) {
            status = 1;
        }
        $.ajax({
            type: "GET",
            url: baseUrl + url,
            data: {
                "id": id
            },
            success: function (res) {
                $(".global-loader").hide();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".global-loader").hide();
                alert(jqXHR.responseText);
            }
        });
    }

    static addMoreStock(pid)
    {
        var stock = $("#stkPop_" + pid).val();
        if ($.trim(pid) != "")
        {
            if ($.trim(stock) == "")
            {
                $("#error_" + pid).html("The field is required").css({
                    'color': "red"
                });
                setTimeout(function () {
                    $("#error_" + pid).html("&nbsp;");
                }, 3000)
            } else if (isNaN(stock))
            {
                $("#error_" + pid).html("Stock must be a number.").css({
                    'color': "red"
                });
                setTimeout(function () {
                    $("#error_" + pid).html("&nbsp;");
                }, 3000)
            } else {
                $(".global-loader").show();
                $.ajax({
                    type: "GET",
                    url: baseUrl + 'product/add-product-stock',
                    data: {
                        'id': pid,
                        'stock': stock,
                    },
                    success: function (response)
                    {
                        $(".global-loader").hide();
                        if (response == '1') {
                            $("#stkPop_" + pid).val("");
                            $("#error_" + pid).html("Stock successfully added.").css({
                                'color': "green"
                            });
                            location.reload();
                        } else {
                            alert(response);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $(".global-loader").hide();
                        alert(jqXHR.responseText);
                    }
                })
            }
        }
    }

    static loadManagerShopSalesPerson(id)
    {
        $("#orders-manager_id").html('<option value="">Please Select</option>');
        $("#orders-shop_id").html('<option value="">Please Select</option>');
        $("#orders-sales_person_id").html('<option value="">Please Select</option>');

        if ($.trim(id) && id != "")
        {
            $(".global-loader").show();

            $.ajax({
                type: "GET",
                url: baseUrl + 'order/get-manager-shop-salesperson',
                data: {
                    'id': id
                },
                success: function (res)
                {
                    $(".global-loader").hide();
                    var obj = $.parseJSON(res);

                    $.each(obj.manager, function (i, v) {
                        $("#orders-manager_id").append('<option value="' + v.manager_id + '">' + v.name + '</option>')
                    })
                    $.each(obj.shop, function (i, v) {
                        $("#orders-shop_id").append('<option value="' + v.shop_id + '">' + v.name + '</option>')
                    })
                    $.each(obj.sales_person, function (i, v) {
                        $("#orders-sales_person_id").append('<option value="' + v.sales_person_id + '">' + v.name + '</option>')
                    })
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $(".global-loader").hide();
                    alert(jqXHR.responseText);
                }
            })
        }
    }

    static getItemSalesItem(id)
    {
        if ($.trim(id) != "")
        {
            var found = 0;
            $("#js-item tr").each(function () {
                var existingId = $(this).data("id");
                if (existingId == id)
                {
                    found = 1;
                }
            })
            if (found == 0) {
                $(".global-loader").show();
                $.ajax({
                    type: "GET",
                    url: baseUrl + 'order/get-item-info',
                    data: {
                        'item': id,
                    },
                    success: function (response)
                    {
                        $(".global-loader").hide();
                        var v = $.parseJSON(response);
                        var n = $("#js-item tr").length;
                        var rowId = v.id + '-' + n;
                        var itmTotal = parseFloat(v.price) * parseFloat(1);
                        var itmPrice = parseFloat(v.price).toFixed(2);
                        var tr = '<tr data-id="' + v.id + '" data-price="' + v.price + '" id="sl-' + rowId + '">\n\
<td>' + v.name + ' <input type="hidden" name="product_id[]" value="' + v.id + '"/></td>\n\
<td><textarea style="width:100%;height:50px;" name="comment[]" class="form-control itm-comment"></textarea></td>\n\
<td>' + itmPrice + '</td>\n\
<td><div class="input-group"><span onclick="App.qtyModifier(\'' + rowId + '\',\'minus\')" class="input-group-addon">-</span><input style="width:41px;" type="text" onchange="App.checkQty(this.value,\'' + rowId + '\')" id="qty-' + rowId + '" type="text" value="1" name="qty[]" class="form-control text-center"><span onclick="App.qtyModifier(\'' + rowId + '\',\'plus\')" class="input-group-addon">+</span></div></td>\n\
<td><span id="sp-' + rowId + '">' + itmTotal.toFixed(2) + '</span></td>\n\
<td class="text-right"><a href="javascript:;" onclick="App.removeSaleItem(\'' + rowId + '\')"><i class="glyphicon glyphicon-trash"></i></a></td>\n\
</tr>';
                        $("#js-item").append(tr);
                        App.calculateItemTotal();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $(".global-loader").hide();
                        alert(jqXHR.responseText);
                    }
                })
            } else {
                alert("Item already added");
            }
        }
    }
    
    static qtyModifier(id, modifier) {
        var qty = parseInt($("#qty-" + id).val());

        if (modifier == 'plus') {
            qty++;
            $("#qty-" + id).val(qty);
        }
        else if (modifier == 'minus') {
            qty--;
            if (qty >= 1) {
                $("#qty-" + id).val(qty);
            }
        }
        App.calculateItemTotal();
    }
    
    static checkQty(val, id)
    {
        if (!isNaN(val))
        {
            if(val == 0) {
                $("#qty-" + id).val(1);
                val = 1;
            }

            var price = $("sl-" + id).data("price");
            var qty = $("#qty-" + id).val();
            var itemTotal = parseFloat(price) * parseFloat(qty);
            $("#sp-" + id).html(itemTotal);
            App.calculateItemTotal();
        }
    }
    
    static removeSaleItem(id, order_item_id)
    {
        //alert(id);
        swal({
                title: "Are you sure you want to remove this item?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No"
        },
        function (isConfirm) {
            if (isConfirm) {
                if (order_item_id == null) {
                    $("tr[id=sl-" + id + "]").remove();
                    App.calculateItemTotal();
                }
                else {
                    $(".global-loader").show();
                    $.ajax({
                        type: "GET",
                        url: baseUrl + 'order/remove-order-item',
                        data: {
                            'order_item_id': order_item_id,
                        },
                        success: function (response)
                        {
                            $(".global-loader").hide();
                            if (response == '1') {
                                toastr.success("Item removed successfully.");
                                $("tr[id=sl-" + id + "]").remove();
                                App.calculateItemTotal();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            $(".global-loader").hide();
                            alert(jqXHR.responseText);
                        }
                    })
                }
            }
        });
    }
    
    static calculateItemTotal()
    {
        var total = 0;
        var subtotal = 0;
        var qtyTotal = 0;
        $("#js-item tr").each(function () {
            //var id = $(this).data("id");
            var trIdString = $(this).attr("id");
            var id = trIdString.substring(3);
            //console.log(id);
            var price = $(this).data("price");
            var qty = $("#qty-" + id).val();
            var itemTotal = parseFloat(price) * parseFloat(qty);
            $("#sp-" + id).html(itemTotal.toFixed(2));
            total = parseFloat(total) + itemTotal;
            qtyTotal = parseFloat(qty) + parseFloat(qtyTotal);
            //console.log(id);
        })
        var charge = parseFloat($("#orders-delivery_charge").val());

        if(isNaN(charge)) {
            charge = 0;
        }
        
        var finalTotal = total;
        
        console.log(finalTotal);
        
        $("#orders-item_total").val(finalTotal.toFixed(2));
    }
}
