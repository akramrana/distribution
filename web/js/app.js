/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class App{
    
    static status(url,trigger,id)
    {
        $(".global-loader").show();
        var status=0;
        if($('#'+trigger.id).is(":checked")){
            status=1;
        }
        $.ajax({
            type: "GET",
            url: baseUrl+url,
            data:{
                "id":id
            },
            success: function(res){
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
}
