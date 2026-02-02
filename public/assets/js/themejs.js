function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    return null;
}



$(document).ready(function() {




    $('#linkLogout').on('click', function() {
        closePopups();
        location.href = "Logout.aspx";

    });

    var cookie_flavor = readCookie("sel_theme");

    if (cookie_flavor != null && cookie_flavor != "") {
        $("body").addClass(cookie_flavor);
    }
    //else {
    //    $("body").addClass('style3');
    //}
    $(".slide-toggle-btn").click(function() {
        $(".box").animate({
            width: "toggle",
        });
    });
    $(".slide-toggle-btn").click(function() {
        $(".main-panel").animate({
            width: "97%",
        });
    });
    $("#linkmenu").click(function() {
        $('.divPageTitle').find('.btnRight').toggle();
    });
    $(".color-btn").click(function() {
        $("#divchoosecolor").slideToggle();
        $(".theame-change").toggleClass("add-btn");
    });
    $("#divchoosecolor button").click(function(e) {
        var styleName = "";
        $("body").removeClass();
        if ($(this).hasClass("red")) {
            $("body").addClass("style1");
            styleName = "style1";
        } else if ($(this).hasClass("yellow")) {
            $("body").addClass("style2");
            styleName = "style2";
        } else if ($(this).hasClass("blue")) {
            $("body").addClass("style3");
            styleName = "style3";
        } else if ($(this).hasClass("green")) {
            $("body").addClass("style4");
            styleName = "style4";
        }
        document.cookie = 'sel_theme=' + styleName + ';';
        e.preventDefault();
    });

    $(".menuicon .nc-align-left-2").click(function() {
        $(".main-panel").toggleClass("openleft");
        $(".sidebar").toggleClass("openleft");
        $("html").toggleClass('nav-open');
        $("#bodyClick").remove();
        $('.navbar-toggle').removeClass("toggled");
    });


    $(".openbtn, .nc-simple-remove").click(function() {
        $(".hot-link").toggleClass("open-hot-link");

    });


    DateFormat = $("#HidDateFormat").val();
    DateFormat = DateFormat.toLowerCase();
    DateFormat = DateFormat.substr(0, 8);
    if (DateFormat.indexOf('-') > 0) {
        MaskDateFormat = MaskDateFormat.replace('/', '-');
        MaskDateFormat = MaskDateFormat.replace('/', '-');
        MaskDatePlaceHolder = MaskDatePlaceHolder.replace('/', '-');
        MaskDatePlaceHolder = MaskDatePlaceHolder.replace('/', '-');
    }
    //CurrencyName = $("#HidCurrencyName").val();
    //FKCurrencyID = $("#hidCurrencyID").val();
});