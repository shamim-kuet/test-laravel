function showModal(subject, filetypes) {
    $("#exampleModalLong").modal();
    $("#exampleModalLongTitle").append(subject);
    $("#filetypes").val(filetypes);
}

function sampleDownload(filetypes) {
    var url = "common/samplefiledownload?file_names=" + filetypes;
    window.location.href = url
}


$(document).ready(function () {
    $('#responsive-datatable').DataTable();
});



checked = false;

function checkedAll() {
    if (checked == false) {
        checked = true
    } else {
        checked = false
    }
    for (var i = 0; i < document.getElementById('form_check').elements.length; i++) {
        document.getElementById('form_check').elements[i].checked = checked;
    }
}

function checkedAllRole(id) {
    if (checked == false) {
        checked = true
    } else {
        checked = false
    }
    for (var i = 0; i < document.getElementById('form_check' + id).elements.length; i++) {
        document.getElementById('form_check' + id).elements[i].checked = checked;
    }
}


function permissions(tables, status) {
    var summeCode = document.getElementsByName("summe_code[]");
    var j = 0;
    var data = new Array();

    for (var i = 0; i < summeCode.length; i++) {
        if (summeCode[i].checked) {
            data[j] = summeCode[i].value;
            j++;
        }
    }

    if (data == "") {
        alert("Please select one or more!");
        return false;
    } else {
        var hrefdata = "common/permissions?approve_val=" + data + "&&tablename=" + tables + "&&status=" + status;
        window.location.href = hrefdata;
    }
}


function statusChanges(path) {
    let type = $("#changestatus").val();

    var summeCode = document.getElementsByName("deliveryid[]");
    var j = 0;
    var pids = new Array();


    for (var i = 0; i < summeCode.length; i++) {
        if (summeCode[i].checked) {
            pids[j] = summeCode[i].value;
            j++;

        }

    }

    // alert(pids);
    if (pids == "") {
        alert("Please check one or more");
        return false;
    } else {
        //alert(pids);
        //var surl = 'common/changestatus';
        var surl = path;
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'orderid': pids,
                'actions': type
            },

            cache: false,
            beforeSend: function () {

            },
            complete: function () {

            },
            success: function (response) {
                // alert(response);
                $('.modal-dialog').html(response);
                $('#empModal').modal('show');
            },
            error: function (xhr, status) {

                alert('Unknown error ' + status);
            }
        });
    }

}


function hubAssign(path) {
    var summeCode = document.getElementsByName("summe_code[]");
    var j = 0;
    var pids = new Array();


    for (var i = 0; i < summeCode.length; i++) {
        if (summeCode[i].checked) {
            pids[j] = summeCode[i].value;
            j++;

        }

    }

    //alert(pids);
    if (pids == "") {
        alert("Please check one or more!");
        return false;
    } else {
        var surl = path;
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'merchantid': pids
            },

            cache: false,
            beforeSend: function () {

            },
            complete: function () {

            },
            success: function (response) {
                //alert(response);
                $('.modal-dialog').html(response);
                $('#empModal').modal('show');
            },
            error: function (xhr, status) {

                alert('Unknown error ' + status);
            }
        });
    }

}




function invoiceGenerate() {
    var summeCode = document.getElementsByName("summe_code[]");
    // alert(summeCode.length);
    var j = 0;
    var pids = new Array();

    for (var i = 0; i < summeCode.length; i++) {
        if (summeCode[i].checked) {
            pids[j] = summeCode[i].value;
            j++;

        }

    }

    //alert(pids);
    if (pids == "") {
        alert("Please check one or more!");
        return false;
    } else {
        var surl = 'invoicegenerate/store';
        var tReceived = $("#total_received" + pids).val();
        var tDCharge = $("#total_deliverycharge" + pids).val();
        var tRCharge = $("#total_returncharge" + pids).val();
        var tCCharge = $("#total_codcharge" + pids).val();
        var twCharge = $("#total_weight_charge" + pids).val();
        var ttCharge = $("#total_charge" + pids).val();
        var tOrder = $("#total_order" + pids).val();

        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'merchant_id': pids,
                'tReceived': tReceived,
                'tDCharge': tDCharge,
                'tRCharge': tRCharge,
                'tCCharge': tCCharge,
                'twCharge': twCharge,
                'ttCharge': ttCharge,
                'tOrder': tOrder
            },

            cache: false,
            beforeSend: function () {

            },
            complete: function () {

            },
            success: function (response) {
                let html = response.data;
                // console.dir(html);

                for (i in html[0]) {
                    $("#tablerow" + html[0][i]).fadeOut('slow');
                }
            },
            error: function (xhr, status) {

                alert('Unknown error ' + status);
            }
        });
    }
}


function getAjaxData(table, id, value) {
    var surl = '/common/ajax';
    $.ajax({
        type: "GET",
        url: surl,
        data: {
            'table': table,
            'id': id,
            'value': value
        },
        cache: false,
        success: function (response) {
            //console.log(response);
            $("#responsedata").html(response);
        },
        error: function (xhr, status) {
            alert('Unknown error ' + status);
        }
    });
}


function getUserData(table) {
    if (table != "") {
        var surl = '/common/ajaxuser';
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'table': table
            },
            cache: false,
            success: function (response) {
                console.log(response.tablename);
                $("#userdatas").html(response.tablename);
                $("#responsedata").html(response.data);
            },
            error: function (xhr, status) {
                alert('Unknown error ' + status);
            }
        });
    }

}


function getCommonData(id, columId, table, divId) {
    if (id == 0) {
        return false;
    } else {
        var surl = '/getCommonData';
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'table': table,
                'id': columId,
                'value': id
            },
            cache: false,
            success: function (response) {
                $('#' + divId).html(response);
                if (columId == 'merchant_id') {
                    getPlanPrice();
                }

            },
            error: function (xhr, status) {
                alert('Unknown error ' + status);
            }
        });
    }
}

function resetPasswordModal(table, id) {
    $("#resetPassword").modal();
    $("#table_name").val(table);
    $("#table_id").val(id);
}



function getPlanPrice() {
    let storedata = $("#store_id option:selected").attr('title');
    let districtid = $("#districtid option:selected").val();
    let area = $("#area option:selected").val();
    let merchant = $("#merchant_id option:selected").val();

    let codPercentage = $("#merchant_id option:selected").attr('title');
    let collectableAmount = $("#collectable_amount").val();
    let codVal = collectableAmount * codPercentage / 100;


    $("#codfee").text(codVal);
    $("#cod_cost").val(codVal);

    if (typeof merchant == 'undefined') {
        return false;
    } else {
        var surl = '/getPlanPrice';
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'storedata': storedata,
                'districtid': districtid,
                'area': area,
                'merchant_id': merchant
            },
            cache: false,
            success: function (response) {
                console.dir(response);
                if (response != '') {

                    //////////////////// Calculation for delivery ///////////////
                    $("#delivery_plan_id").val(response.deliveryPlan.plan_id)

                    let totalVal = parseFloat(response.deliveryPlan.plan.charge) + parseFloat(codVal);
                    $("#total_amount").text(totalVal.toFixed(2))
                    $("#total_cost").val(totalVal.toFixed(2))
                    $("#deliveryfee").text(response.deliveryPlan.plan.charge)
                    $("#delivery_cost").val(response.deliveryPlan.plan.charge)
                    let weight = $("#weight").val();
                    if(weight==''){
                        $("#weight").val(response.deliveryPlan.plan.weight)
                    }


                    //////////////////// Calculation for Return ///////////////
                    if (response.returnPlan != null) {
                        $("#return_plan_id").val(response.returnPlan.plan_id)
                        let totalReturnVal = parseFloat(response.returnPlan.plan.charge);
                        $("#total_return_amount").text(totalReturnVal)
                        //$("#total_return_cost").val(totalReturnVal)
                        $("#total_return_cost").val(response.returnPlan.plan.charge)
                        $("#returnfee").text(response.returnPlan.plan.charge)
                    }
                    else{
                        $("#return_plan_id").val('')
                        $("#total_return_amount").text(0)
                        $("#total_return_cost").val(0)
                        $("#returnfee").text(0)
                    }
                } else {
                    $("#total_amount").text(0)
                    $("#deliveryfee").text(0)
                    $("#delivery_cost").val(0)
                    $("#total_cost").val(0)

                    $("#total_return_amount").text(0)
                    $("#returnfee").text(0)
                    $("#total_return_cost").val(0)
                }

                getWeight();
            },
            error: function (xhr, status) {
                alert('Unknown error ' + status);
            }
        });
    }
}





function getWeight() {
    let weight = $("#weight").val();
    let time = $("#time option:selected").val();
    let districtid = $("#districtid option:selected").val();
    let deliverFee = $("#deliveryfee").text();
    let returnFee = $("#returnfee").text();
    let codFee = $("#codfee").text();

    if (weight == '') {
        return false;
    } else {
        var surl = '/getWeight';
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'weight': weight,
                'districtid': districtid,
                'time': time
            },
            cache: false,
            success: function (response) {
                console.dir(response);
                $("#weightPrice").text(response)
                $("#weight_cost").val(response)
                let totalAmount = parseFloat(deliverFee) + parseFloat(codFee) + parseFloat(response);
                $("#total_cost").val(totalAmount.toFixed(2))
                $("#total_amount").text(totalAmount.toFixed(2))

                let totalReturnAmount = parseFloat(returnFee) + parseFloat(response);
                $("#returnWeightPrice").text(response)
                $("#total_return_amount").text(totalReturnAmount.toFixed(2))
                //$("#total_return_cost").val(totalReturnAmount)
            },
            error: function (xhr, status) {
                alert('Unknown error ' + status);
            }
        });
    }
}

function checkValidation(id, field, msgid, msgname, tablename) {
    var idval = $("#" + id).val();
    if (idval != "" && idval.length > 1) {
        var surl = '/ajaxCheckValidation';
        $.ajax({
            type: "GET",
            url: surl,
            data: {
                'values': idval,
                'field': field,
                'tablename': tablename
            },
            cache: false,
            beforeSend: function () {
                $('#LoadingImageE').show();
            },
            complete: function () {
                $('#LoadingImageE').hide();
            },
            success: function (response) {
                console.log(response);

                if (response == 0) {
                    //$("#"+id).val('');
                    $("#" + id).css('border', '1px solid red');
                    $('#' + msgid).html('Invalid ' + msgname);
                    $('#' + msgid).css('color', 'red');
                } else {
                    $("#" + id).css('border', '1px solid green');
                    $('#' + msgid).html(response);
                    $('#' + msgid).html('Valid ' + msgname);
                    $('#' + msgid).css('color', 'green');
                }

                $('#LoadingImageE').hide();
            },
            error: function (xhr, status) {
                $('#LoadingImageE').hide();
                //alert('Unknown error ' + status);
            }
        });
    } else {
        $('#' + msgid).html("");
    }
}
