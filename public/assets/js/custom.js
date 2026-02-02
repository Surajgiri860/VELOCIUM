
var ColorE = "#FF723D";
var ColorN = "#dadada";
var DateFormat = "dd/mm/yy";
var opendivid = '';



function IsEmail(str) {
    if (str != '') {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(str);
    }
}
function SetAmountBox(id, decimal, defval) {
    if ($('#' + id).val() == "") {
        $('#' + id).val(defval);

    }

    $('#' + id).keypress(function () {
        var temp = $(this).val();
        if (temp == "") {
            $(this).val(defval);
        }
        else {
            extractNumber(this, decimal, false);
        }

    });
    $('#' + id).keyup(function () {
        var temp = $(this).val();
        if (temp == "") {
            $(this).val(defval);
        }
        else {
            extractNumber(this, decimal, false);
        }

    });


}
function SetNumberBox(id, defval) {
    if ($('#' + id).val() == "") {
        $('#' + id).val(defval);

    }

    $('#' + id).keypress(function () {
        var temp = $(this).val();
        if (temp == "") {
            $(this).val(defval);
        }
        else {
            extractNumber(this, 0, false);
        }

    });
    $('#' + id).keyup(function () {
        var temp = $(this).val();
        if (temp == "") {
            $(this).val(defval);
        }
        else {
            extractNumber(this, 0, false);
        }

    });


}
function extractNumber(obj, decimalPlaces, allowNegative) {
    var temp = obj.value;

    // avoid changing things if already formatted correctly
    var reg0Str = '[0-9]*';
    if (decimalPlaces > 0) {
        reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
    } else if (decimalPlaces < 0) {
        reg0Str += '\\.?[0-9]*';
    }
    reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
    reg0Str = reg0Str + '$';
    var reg0 = new RegExp(reg0Str);
    if (reg0.test(temp)) return true;

    // first replace all non numbers
    var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
    var reg1 = new RegExp(reg1Str, 'g');
    temp = temp.replace(reg1, '');

    if (allowNegative) {
        // replace extra negative
        var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
        var reg2 = /-/g;
        temp = temp.replace(reg2, '');
        if (hasNegative) temp = '-' + temp;
    }

    if (decimalPlaces != 0) {
        var reg3 = /\./g;
        var reg3Array = reg3.exec(temp);
        if (reg3Array != null) {
            // keep only first occurrence of .
            //  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
            var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
            reg3Right = reg3Right.replace(reg3, '');
            reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
            temp = temp.substring(0, reg3Array.index) + '.' + reg3Right;
        }
    }

    obj.value = temp;
}

function TS_blockNonNumbers(obj, e, allowDecimal, allowNegative, id) {
    if (e.keyCode == 13) {
        var hoursid = 'txtdesc' + id;

        $('#' + hoursid).focus();
        e.preventDefault();
    }

    var key;
    var isCtrl = false;
    var keychar;
    var reg;

    if (window.event) {
        key = e.keyCode;
        isCtrl = window.event.ctrlKey
    }
    else if (e.which) {
        key = e.which;
        isCtrl = e.ctrlKey;
    }

    if (isNaN(key)) return true;

    keychar = String.fromCharCode(key);

    // check for backspace or delete, or if Ctrl was pressed
    if (key == 8 || isCtrl) {
        return true;
    }

    reg = /\d/;
    var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
    var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;




    return isFirstN || isFirstD || reg.test(keychar);
}


function blockNonNumbers(obj, e, allowDecimal, allowNegative) {
    var key;
    var isCtrl = false;
    var keychar;
    var reg;

    if (window.event) {
        key = e.keyCode;
        isCtrl = window.event.ctrlKey
    }
    else if (e.which) {
        key = e.which;
        isCtrl = e.ctrlKey;
    }

    if (isNaN(key)) return true;

    keychar = String.fromCharCode(key);

    // check for backspace or delete, or if Ctrl was pressed
    if (key == 8 || isCtrl) {
        return true;
    }

    reg = /\d/;
    var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
    var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;

    return isFirstN || isFirstD || reg.test(keychar);
}
function showbuttonloader(id, type) {
    if (id != "") {
        if (type == 'd') {
            $('#' + id).hide();
            $('#' + id).parent().find('*').attr('disabled', true);
            $('#' + id).after('<div class="divbtnloader" id="imgloadingbtn_' + id + '"><img src="/images/small_loader.gif"> Please wait..</div>');


        }
        else {
            $("#imgloadingbtn_" + id).remove();
            $('#' + id).parent().find('*').attr('disabled', false);
            $('#' + id).show();
        }
    }
}
function ShowLoader() {
    $('#divloader').show();
}
function HideLoader() {
    $('#divloader').hide();
}


function opendiv(id) {
    opendivid = id;
    setposition(id);
    $('#otherdiv').fadeIn("slow");
    $('#' + id).fadeIn("slow");
    $('#' + id).draggable({ cursor: "move", handle: '.modal-header' });

}
function closediv() {
    if (document.getElementById(opendivid) != null) {
        $('#' + opendivid).hide();
        $('#otherdiv').hide();

    }
}
function setposition(id) {

    $(function () {
        $.getScript("js/jquery-ui.js", function () {

            $('#' + id).draggable({ cursor: "move", handle: '.modal-header' });
        });
    });

    //$('#' + id).css({
    //    'left': ($(window).width() / 2) - ($('#' + id).width() / 2),
    //    'top': ($(window).width() / 2) - ($('#' + id).height() / 2)
    //})


    $('#' + id).css("top", Math.max(0, (($(window).height() - $('#' + id).outerHeight()) / 2) +
        $(window).scrollTop()) + "px");

    if ($(window).width() < 481) {
        $('#' + id).css("left", "1px");
    }
    else {
        $('#' + id).css("left", Math.max(0, (($(window).width() - $('#' + id).outerWidth()) / 2) +
            $(window).scrollLeft()) + "px");
    }

}


function FunFillState(FKCountryID, DropState, DropCity, DropTahsil) {


    $("#" + DropCity).empty();  
    $("#" + DropCity).append("<option value='0'>Select City</option>");
   

    var str = "<option value='0'>Select State</option>";

    ShowLoader();
    var args = { FKCountryID: FKCountryID };

    $.ajax({

        type: "POST",
        url: "/API/API.aspx" + "/GetAllState",
        data: JSON.stringify(args),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {

            if (data.d != "failure" && data.d != "") {
                var jsonarr = $.parseJSON(data.d);

                if (jsonarr.length > 0) {

                    $.each(jsonarr, function (i, item) {

                        str = str + '<option value="' + item.PKStateID + '">' + item.StateName + '</option>';
                    });

                }
                $("#" + DropState).change(function () {
                    FunFillCity(DropState, DropCity, DropTahsil);
                });


            }
            $("#" + DropState).append(str);
            HideLoader();

        },
        error: function (x, e) {
            alert("The call to the server side failed. " + x.responseText);
            HideLoader();
            return;
        }

    });
}
function FunFillCity(DropState, DropCity, DropTahsil) {

    $("#" + DropCity).empty();
  
    var str = "<option value='0'>Select City</option>";


    ShowLoader();
    var args = { FKStateID: $("#" + DropState).val() };

    if ($("#" + DropState).val() != "0") {
        $.ajax({

            type: "POST",
            url: "/API/API.aspx" + "/GetAllCity",
            data: JSON.stringify(args),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {

                if (data.d != "failure" && data.d != "") {
                    var jsonarr = $.parseJSON(data.d);

                    if (jsonarr.length > 0) {

                        $.each(jsonarr, function (i, item) {

                            str = str + '<option value="' + item.PKCityID + '">' + item.CityName + '</option>';
                        });


                    }


                }
                $("#" + DropCity).append(str);
                HideLoader();
               
            },
            error: function (x, e) {
                alert("The call to the server side failed. " + x.responseText);
                HideLoader();
                return;
            }

        });
    }
    else {
        $("#" + DropCity).append(str);
        HideLoader();
    }
}
function OpenAlert(msg) {
    $('#alerttext').html(msg);
    //  setposition("divalert");
    $('#divalert').show();
    $('#divalertback').show();
}
function closealert() {
    $('#divalert').hide();
    $('#divalertback').hide();
}
function DatePicker(id) {

    $('#' + id).datepicker({
        dateFormat: DateFormat,
        startDate: '-3d'
    });

    $('#' + id).change(function () {
        ValidateDate($(this).val(), id);
    });
}
function ValidateDate(val, id) {

    if (val != "" && val != "__/__/____") {
        if (!isDate(val)) {
            alert('Invalid date format, date must be in mm/dd/yyyy format');

            document.getElementById(id).value = "";
            $("#" + id).focus();

        }

    }


}

function isDate(date) {
    var objDate,  // date object initialized from the ExpiryDate string 
        mSeconds, // ExpiryDate in milliseconds 
        day,      // day 
        month,    // month 
        year;     // year 
    // date length should be 10 characters (no more no less) 
    if (date.length !== 10) {
        return false;
    }
    // third and sixth character should be '/' 
    var DSplitChar = '/';
    if (DateFormat.indexOf('-') > -1) {
        DSplitChar = '-';
    }
    if (date.substring(2, 3) !== DSplitChar || date.substring(5, 6) !== DSplitChar) {
        return false;
    }
    // extract month, day and year from the ExpiryDate (expected format is mm/dd/yyyy) 
    // subtraction will cast variables to integer implicitly (needed 
    // for !== comparing) 

    if (DateFormat.charAt(0) == 'm') {
        month = date.substring(0, 2) - 1; // because months in JS start from 0 
        day = date.substring(3, 5) - 0;
    }
    else {
        day = date.substring(0, 2) - 0; // because months in JS start from 0 
        month = date.substring(3, 5) - 1;
    }


    year = date.substring(6, 10) - 0;

    // test year range 
    if (year < 1000 || year > 3000) {
        return false;
    }
    // convert ExpiryDate to milliseconds 
    mSeconds = (new Date(year, month, day)).getTime();
    // initialize Date() object from calculated milliseconds 
    objDate = new Date();
    objDate.setTime(mSeconds);
    // compare input date and parts from Date() object 
    // if difference exists then date isn't valid 
    if (objDate.getFullYear() !== year ||
        objDate.getMonth() !== month ||
        objDate.getDate() !== day) {
        return false;
    }
    // otherwise return true 
    return true;
}
$.fn.ValZero = function () {
    var val = 0;
    try {

        if (this.val() && this.val() != "") {
            val = this.val();
        }

    }
    catch (e) {
        console.log(e);
    }

    return val;
}


function FunBlank() {


    $('#dropPrefix').val('Mr.');
    $('#txtName').val('');
    
    $('#txtEmail').val('');
    $('#txtMobileNo').val('');
    $('#txtAddress1').val('');
    $('#txtAddress2').val('');
    $('#txtZIP').val('');



}
function validateform() {
   
    var status = 1;

    if ($('#txtSponsorID').val() == '') {
        $('#txtSponsorID').css('border-color', 'red');
        status = 0;
    }
    else {
        $('#txtSponsorID').css('border-color', '#dadada');
    }

    if ($('#txtName').val() == '') {
        $('#txtName').css('border-color', 'red');
        status = 0;
    }
    else {
        $('#txtName').css('border-color', '#dadada');
    }
   

    


    if ($('#txtPWD').val() == '') {
        $('#txtPWD').css('border-color', 'red');
        status = 0;
    }
    else {
        $('#txtPWD').css('border-color', '#dadada');
    }
    if ($('#txtCPWD').val() == '') {
        $('#txtCPWD').css('border-color', 'red');
        status = 0;
    }
    else {
        $('#txtCPWD').css('border-color', '#dadada');
    }
    if ($('#txtCPWD').val() != '' && $('#txtPWD').val() != '') {


        if ($('#txtCPWD').val() != $('#txtPWD').val()) {
            $('#txtCPWD').css('border-color', 'red');
            $('#txtPWD').css('border-color', 'red');
            status = 0;
        }
        else {
            $('#txtPWD').css('border-color', '#dadada');
            $('#txtCPWD').css('border-color', '#dadada');
        }

    }
    if ($('#txtEmail').val() == '') {
        $('#txtEmail').css('border-color', 'red');
        status = 0;
    }
    else {
        if (!IsEmail($('#txtEmail').val())) {
            $('#txtEmail').css('border-color', 'red');
            status = 0;
        }
        else {
            $('#txtEmail').css('border-color', '#dadada');
        }
    }
    if ($('#txtMobileNo').val() == '') {
        $('#txtMobileNo').css('border-color', 'red');
        status = 0;
    }
    else {
        if ($('#txtMobileNo').val().length != 10) {
            $('#txtMobileNo').css('border-color', 'red');
            status = 0;
        }
        else {
            $('#txtMobileNo').css('border-color', '#dadada');
        }
    }
   
   
    //if ($('#txtAddress1').val() == '') {
    //    $('#txtAddress1').css('border-color', 'red');
    //    status = 0;
    //}
    //else {
    //    $('#txtAddress1').css('border-color', '#dadada');
    //}

    //if ($('#dropState').ValZero() == '0') {
    //    $('#dropState').css('border-color', 'red');
    //    status = 0;
    //}
    //else {
    //    $('#dropState').css('border-color', '#dadada');
    //}
    //if ($('#dropCity').ValZero() == '0') {
    //    $('#dropCity').css('border-color', 'red');
    //    status = 0;
    //}
    //else {
    //    $('#dropCity').css('border-color', '#dadada');
    //}
    



    if (status == 0) {
        OpenAlert('Please fill required fields!');
        return false;
    }
    else {

        return true;

    }
}
function FunValidateOTP() {

    var status = 1;


    if ($('#txtOTP').val() == '') {
        $('#txtOTP').css('border-color', 'red');
        status = 0;
    }
    else {
        $('#txtOTP').css('border-color', '#dadada');
    }
    if (status == 0) {
        OpenAlert('Please fill OTP!');
        return false;
    }
    else {

        return true;

    }
}
function FunRegistration() {
   


    if (validateform()) {

       

        var args = {
            OTP: $("#txtOTP").val(), SponsorID: $("#txtSponsorID").val(), PWD: $("#txtPWD").val(), Prefix: $("#dropPrefix").val(),
            Name: $("#txtName").val(),
            Gender: '', DOB: '', Mobile: $("#txtMobileNo").val(), Email: $("#txtEmail").val(),
            Address1: $("#txtAddress1").val(), Address2: $("#txtAddress2").val(), FKStateID: $("#dropState").ValZero(),
            FKCityID: $("#dropCity").ValZero(), FKTahsilID: 0, TownName: $("#txtTahsil").val(), ZIP: $("#txtZIP").val(),
            BankName: $("#txtBankName").val(), BankBranch: $("#txtBankBranch").ValZero(), BankAcNo: $("#txtBankAcNo").val(), IFSCCode: $("#txtIFSCCode").val(),
            ImageURL: ''
          

        };
       
        showbuttonloader('btnSubmit', 'd');

        $.ajax({

            type: "POST",
            url: "/API/API.aspx"  + "/Registration",
            data: JSON.stringify(args),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            cache: false,
            success: function (data) {

                if (data.d != "failure" && data.d != "Invalid Login") {
                    var jsonarr = $.parseJSON(data.d);

                    showbuttonloader('btnSubmit', 'e');
                    if (jsonarr.length > 0 && jsonarr[0].Result == 1) {

                       

                        var str = 'Dear ' + jsonarr[0].Name + ',<br>You have registerd successfully.<br><br>Your Login ID is: ' + jsonarr[0].MemberID + '<br>Password: ' + $("#txtPWD").val();
                        OpenAlert(str);

                    }
                    else {
                        OpenAlert(jsonarr[0].Msg);
                    }


                }
                else {
                    alert(data.d);
                }

            },
            error: function (x, e) {
                alert("The call to the server side failed. " + x.responseText);
                showbuttonloader('btnSubmit', 'e');
                return;
            }

        });
    }

}

function FunSendOTP() {
    if (validateform()) {



        var args = {
            Email: $('#txtEmail').val()
        };

        showbuttonloader('btnSubmit', 'd');

        $.ajax({

            type: "POST",
            url: "/API/API.aspx" + "/SendEmailOTP",
            data: JSON.stringify(args),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            cache: false,
            success: function (data) {
                showbuttonloader('btnSubmit', 'e');
                if (data.d != "failure" && data.d != "") {
                    var jsonarr = $.parseJSON(data.d);
                    if (jsonarr.length > 0 && jsonarr[0].Result == 1) {

                        opendiv('divOtp');
                    }
                    else {
                        alert(jsonarr[0].Msg);
                    }


                }
                else {
                    alert(data.d);
                }

            },
            error: function (x, e) {
                alert("The call to the server side failed. " + x.responseText);
                showbuttonloader('btnSubmit', 'e');
                return;
            }

        });
    }
   
}
function FunComparePassword() {
    if ($('#txtCPWD').val() != '' && $('#txtPWD').val() != '') {

        if ($('#txtCPWD').val() != $('#txtPWD').val()) {
            $('#txtPWD').css('border-color', 'red');
            $('#txtCPWD').css('border-color', 'red');
            OpenAlert('Password and Confrim Password does not match')
        }
        else {
            $('#txtPWD').css('border-color', '#dadada');
            $('#txtCPWD').css('border-color', '#dadada');
        }

    }
}



function FunGetSponsorDetails() {
    $("#txtSponsorName").val('');
    $("#txtSponsorID").addClass('textboxloader');
    var args = {
        MemberID: $("#txtSponsorID").val()
    };

    $.ajax({
        type: "POST",
        url: "/API/API.aspx" + "/GetMemberByID",
        data: JSON.stringify(args),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        cache: false,
        success: function (data) {


            if (data.d != "failure" && data.d != "Invalid Request") {
                $("#txtSponsorID").removeClass('textboxloader');
                var jsonarr = $.parseJSON(data.d);

                if (jsonarr.data.Table.length > 0) {
                    $("#txtSponsorName").val(jsonarr.data.Table[0].Name);
                }
                else {
                    OpenAlert('Invalid Sponsor ID');
                    $("#txtSponsorID").val('');
                }

            }
            else {
                OpenAlert('Invalid Sponsor ID');
            }
        },
        error: function (x, e) {
            alert("The call to the server side failed. " + x.responseText);

            return;
        }

    });
}



$(document).ready(function () {
    
    FunFillState(1, 'dropState', 'dropCity', '');
    

    $("#btnSubmit").click(function () {
        FunRegistration();
    });
    $("#btnValidateOTP").click(function () {
        FunRegistration();
    });
    
    
    $("#txtSponsorID").change(function () {
        $("#txtSponsorName").val('');
        if ($("#txtSponsorID").val() != '') {
            FunGetSponsorDetails();
        }

    });

    if ($('#HidPosition').val() != '') {
        $('#dropPosition').val($('#HidPosition').val());
    }
    

});