const jQuery = require('jquery');

const Bootstrap = require('bootstrap');
window.$ = window.jQuery = jQuery;

const select2 = require("select2");
const selectpicker = require("bootstrap-select");
const confirm = require("jquery-confirm");
// const persiandate = require("persian-date");
// const persiandatepicker = require("../../../../node_modules/persian-datepicker/dist/js/persian-datepicker");
// const moment = require("moment");
const moment = require("jalali-moment");
moment().locale('fa').format('YYYY/M/D');
window.moment = moment;
const loadingOverlay = require("gasparesganga-jquery-loading-overlay");

$.noConflict();

jQuery(function ($) {

    "use strict";

    /*==================================================*/
    /* 01 -Popover Setting                               */
    /*==================================================*/

    jQuery('[data-toggle="popover"]').popover();
    jQuery('body').on('click', function (e) {
        jQuery('[data-toggle=popover]').each(function () {
            // hide any open popovers when the anywhere else in the body is clicked
            if (!jQuery(this).is(e.target) && jQuery(this).has(e.target).length === 0 && jQuery('.popover').has(e.target).length === 0) {
                jQuery(this).popover('hide');
            }
        });
    });

    /*==================================================*/
    /* 02 - Sidebar Menus                               */
    /*==================================================*/

    // var sidebar_menu = 'main';
    // var url_location = window.location.toString();
    // if (url_location.indexOf("users") != -1) {
    //     sidebar_menu = 'users';
    // }
    // else if (url_location.indexOf("centers") != -1) {
    //     sidebar_menu = 'centers';
    // }
    // else if (url_location.indexOf("online-visits") != -1) {
    //     sidebar_menu = 'online-visits';
    // }
    // else if (url_location.indexOf("ucase") != -1) {
    //     sidebar_menu = 'patient-case';
    // }
    // else if (url_location.indexOf("cp/roles") != -1) {
    //     sidebar_menu = 'roles';
    // }
    // else if (url_location.indexOf("/cn/") != -1) {
    //     sidebar_menu = 'sections';
    // }
    // $('#menu-' + sidebar_menu).addClass('show');
    // $('#menu-' + sidebar_menu).first('a').attr('aria-expanded', 'true');
    // $('#menu-' + sidebar_menu).find('ul').addClass('show');



    $("#toggle").click(function () {
        var elem = $("#toggle").text();
        if (elem == "بیشتـــر...") {
            //Stuff to do when btn is in the read more state
            $("#toggle").text("بستن");
            $("#text").slideDown();
        } else {
            //Stuff to do when btn is in the read less state
            $("#toggle").text("بیشتـــر...");
            $("#text").slideUp();
        }
    });

    // $('#date3-1').MdPersianDateTimePicker({
    //     targetTextSelector: '#inputDate3-1',
    //     monthsToShow: [1, 1],
    //     rangeSelector: true
    // });

    /*==================================================*/
    /* 01 - Select 2 scripts                            */
    /*==================================================*/
    $('.js-select2').select2({
        dir: "rtl",
        theme: 'bootstrap',
        width: "90px"
    });

    $('.js-select2-custom-width').each(function () {
        var $this = $(this);

        var width = '100%';
        if ($this.attr('data-width'))
        {
            width = $this.attr('data-width');
        }

        $this.select2({
            dir: "rtl",
            theme: 'bootstrap',
            width: width
        });
    });

    $('.js-select2-w-100').select2({
        dir: "rtl",
        theme: 'bootstrap',
        width: "100%"
    });

    $(".js-select2-hide-search").select2({
        dir: "rtl",
        minimumResultsForSearch: Infinity,
        theme: 'bootstrap',
        width: "100%"
    });

    $(".js-select2-new").each(function () {
        var $this = $(this);
        var item_count = ($this.attr('data-max-item-count') ? $this.attr('data-max-item-count') : 1);

        var tagable = true;
        if ($this.attr('data-tagable') == '0')
            tagable = false;

        $this.select2({
            dir: "rtl",
            tags: tagable,
            maximumSelectionLength: item_count,
            theme: 'bootstrap',
            width: "100%",
            language: {
                noResults: function (params) {
                    return "نتیجه ای یافت نشد. ";
                },
                maximumSelected: function (params) {
                    return "تنها " + params.maximum + " مورد می توانید انتخاب کنید.";
                }
            }
        });
    });

    $(".js-select2-live-search").each(function () {
        var $this = $(this);

        $this.select2({
            dir: "rtl",
            tags: false,
            width: "100%",
            ajax: {
                url: $this.attr('data-url'),
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    // return {
                    //     q: params.term, // search term
                    //     page: params.page
                    // };
                    $.ajaxSetup({
                        contentType: false,
                        processData: false
                    });
                    var formData = new FormData();
                    formData.append('q', params.term);
                    formData.append('page', params.page);

                    return formData;
                },
                processResults: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.name
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            language: {
                inputTooShort: function () {
                    return 'حداقل 1 کاراکتر یا بیشتر را تایپ کنید';
                },
                searching: function () {
                    return "در حال جستجو...";
                },
                noResults: function (params) {
                    return "نتیجه ای یافت نشد. ";
                }
            }
        });
    });

    $(".js-select2-tags").each(function () {
        var $this = $(this);

        var tagable = true;
        if ($this.attr('data-tagable') == '0')
            tagable = false;

        $this.select2({
            dir: "rtl",
            tags: tagable,
            ajax: {
                url: $this.attr('data-url'),
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    // return {
                    //     q: params.term, // search term
                    //     page: params.page
                    // };
                    $.ajaxSetup({
                        contentType: false,
                        processData: false
                    });
                    var formData = new FormData();
                    formData.append('q', params.term);
                    formData.append('page', params.page);

                    return formData;
                },
                processResults: function (data) {
                    var myResults = [];
                    /*for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            myResults.push({
                                'id': k,
                                'text': data[k]
                            });
                        }
                    }*/
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.name
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            language: {
                inputTooShort: function () {
                    return 'حداقل 1 کاراکتر یا بیشتر را تایپ کنید';
                },
                searching: function () {
                    return "در حال جستجو...";
                },
                noResults: function (params) {
                    return "نتیجه ای یافت نشد. ";
                }
            }
        });
    });

    $('.date-remover').on('click', function () {
        $(this).closest('.input-group').find('input').val('');
    });

    /*==================================================*/
    /* 02 - Bootstrap-select & Lang options             */
    /*==================================================*/

    jQuery('.selectpicker').selectpicker;

    ! function (a, b) { "function" == typeof define && define.amd ? define(["jquery"], function (a) { return b(a) }) : "object" == typeof module && module.exports ? module.exports = b(require("jquery")) : b(a.jQuery) }(this, function (a) { ! function (a) { a.fn.selectpicker.defaults = { noneSelectedText: "چیزی انتخاب نشده است", noneResultsText: "هیج مشابهی برای {0} پیدا نشد", countSelectedText: "{0} از {1} مورد انتخاب شده", maxOptionsText: ["بیشتر ممکن نیست {حداکثر {n} عدد}", "بیشتر ممکن نیست {حداکثر {n} عدد}"], selectAllText: "انتخاب همه", deselectAllText: "انتخاب هیچ کدام", multipleSeparator: ", " } }(a) });


    /*==================================================*/
    /* 00 -                                             */
    /*==================================================*/

    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
        new SelectFx(el);
    });

     /*==================================================*/
    /* 00 - Menu Trigger                                */
    /*==================================================*/

    $('#menuToggle').on('click', function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $('body').removeClass('open');
            if (windowWidth < 760) {
                $('#left-panel').slideToggle();
            } else {
                $('#left-panel').toggleClass('open-menu');
            }
        } else {
            $('body').toggleClass('open');
            $('#left-panel').removeClass('open-menu');
        }
    });

    $(".menu-item-has-children.dropdown").each(function () {
        $(this).on('click', function () {
            var $temp_text = $(this).children('.dropdown-toggle').html();
            $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
        });
    });


    // Load Resize
    $(window).on("load resize", function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $('body').addClass('small-device');
        } else {
            $('body').removeClass('small-device');
        }

    });


    // $('input.form-control').keypress(function (e) {
    $(document).on('keypress', 'input.form-control', function (e) {
        var key = e.which;
        if (key == 13)
        {
            $('#btn_register').trigger('click');
            return false;
        }
    });

    // $('#btn_cancel').click(function () {
    // $(document).on('click', '#btn_cancel', function () {
    //     var $this = $(this);
    //     $('#btn_register').prop('disabled', true);
    //     $this.prop('disabled', true);
    //     $this.html("<i class='fas fa-spinner fa-pulse'></i>&nbsp;" + window._form_cancel_button_title);
    //     setTimeout(function(){
    //         window.location = window._form_location_back_url;
    //     }, 500)
    // });

    // $('#btn_register').click(function () {
    $(document).on('click', '#btn_register', function () {
        $.LoadingOverlay("show");

        $.ajaxSetup({
            contentType: false,
            processData: false
        });

        var $this = $(this);
        $this.prop('disabled', true);
        $this.find('i').attr('class', "fas fa-spinner fa-pulse");

        if (window.tinyMCE)
        {
            tinyMCE.triggerSave();
        }

        // var data = $('#form1').serialize();

        var formData = new FormData(document.getElementById(window._form_id));

        if(typeof window._form__method !== "undefined")
        {
            formData.append('_method', window._form__method);
        }

        $.post(window._form_button_url, formData, function (result) {
            if (result.status)
            {
                makeAlert('پاسخ', result.message, 'green', function () {
                    window.location = window._form_location_url;
                });
            }
            else
            {
                makeAlert('اخطار!', result.message, 'orange');
            }
            $.LoadingOverlay("hide");
        }, 'json').fail(function (jqXhr)
        {
            makeAlert('خطا!', getErrors(jqXhr), 'red');
            showErrors(jqXhr);
            $.LoadingOverlay("hide");
        }).always(function ()
        {
            setTimeout(function(){
                $this.prop('disabled', false);
                $this.find('i').attr('class', "fas fa-check-circle");
            }, 750);
        });
    });

    $(document).on('click', '.remove-thumb-icon', function(){
        var $this = $(this);
        $this.closest('div').parent().append('<input type="hidden" value="1" name="'+$this.attr("data-input-name")+'">');
        $this.closest('div').remove();
    });
});

window.inMobileView = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};

window.showErrors = function (jqXhr)
{
    if (jqXhr.status === 401)
    {
        $(location).prop('pathname', 'login');
    }
    else if (jqXhr.status === 422) {

        var $errors = jqXhr.responseJSON.errors;
        var errorsHtml = '';

        if(typeof $errors == "undefined")
        {
            $errors = jqXhr.responseJSON;
        }
        errorsHtml = '<div class="alert fade m-t-5 show alert-danger"><ul class="mb-0">';
        $.each($errors, function (key, value) {
            errorsHtml += '<li>' + value[0] + '</li>';
        });
        errorsHtml += '</ul></di>';

        $('#form-errors').removeClass('d-none').html(errorsHtml);
        return false;
    }
    else {
        errorsHtml = '<div class="alert fade m-t-5 show alert-danger">' + 'خطا: لطفا دوباره تلاش نمائید!' + '</div>';
        $('#form-errors').html(errorsHtml);
        return false;
    }
}

window.getMessage = function (data)
{
    var alerts = {
        success : 'عملیات با موفقیت انجام شد!',
        failed : 'لطفا دوباره تلاش نمائید!'
    };

    var html_msg = '';
    var msg_type = false;
    var msg = '';

    if (data.status)
    {
        if(data.message != undefined)
            msg = data.message;
        else
            msg = alerts.success;
        html_msg = '<div>' + msg + '</div>';
        msg_type = true;
    }
    else
    {
        if(data.message != undefined)
            msg = data.message;
        else
            msg = alerts.failed;
        html_msg = '<div class="text-danger number-fa">' + msg + '</div>';
    }

    return {
        status: msg_type,
        message: html_msg
    }
}

window.getErrors = function (jqXhr)
{
    var alerts = {
        failed : 'لطفا دوباره تلاش نمائید!'
    };

    var html_msg = '';

    if (jqXhr.status === 401)
    {
        $(location).prop('pathname', 'login');
    }
    else if (jqXhr.status === 422)
    {
        var $errors = jqXhr.responseJSON.errors;
        if(typeof $errors == "undefined")
        {
            $errors = jqXhr.responseJSON;
        }
        html_msg = '<div class="text-danger number-fa"><ul>';
        $.each($errors, function (key, value) {
            html_msg += '<li>' + value[0] + '</li>';
        });
        html_msg += '</ul></div>';
    }
    else if (jqXhr.status === 404)
    {
        html_msg = '<div class="text-danger number-fa">ماژول مورد نظر یافت نشد! (404)</div>';
    }
    else if (jqXhr.status === 403)
    {
        html_msg = '<div class="text-danger number-fa">دسترسی غیر مجاز! (403)</div>';
    }
    else
    {
        html_msg = '<div class="text-danger number-fa">' + alerts.failed + '</div>';
    }

    return html_msg;
}

window.makeAlert = function (title = '', content = '', color = 'dark', confirm_callback = function(){return;}, popup_type = 'alert', reject_callback = function(){return;})
{
    var icon = 'fas fa-info-circle fa-fw text-dark';


    if(color == 'red')
    {
        icon = 'fas fa-ban fa-fw text-danger';
    }
    else if(color == 'orange')
    {
        icon = 'fas fa-exclamation-triangle fa-fw text-warning';
    }
    else if(color == 'green')
    {
        icon = 'far fa-check-circle fa-fw text-success';
    }

    if(popup_type == 'alert')
    {
        $.alert({
            title: (title == 'پاسخ' ? '' : title),
            content: content,
            rtl: true,
            closeIcon: false,
            icon: icon,
            theme : 'material',
            type: color,
            animationSpeed: 300,
            animateFromElement: false,
            animation: 'scaleY',
            closeAnimation: 'scaleX',
            animationBounce: 1,
            typeAnimated: true,
            draggable: true,
            dragWindowBorder: true,
            smoothContent: true,
            buttons: {
                confirm: {
                    text: 'ادامه',
                    btnClass: 'btn-blue btn-dark',
                    action: function () {
                        confirm_callback();
                    }
                }
            }
        });
    }
    else if(popup_type == 'confirm')
    {
        $.alert({
            title: title,
            content: content,
            rtl: true,
            closeIcon: false,
            icon: 'fas fa-exclamation-triangle fa-fw text-warning',
            theme : 'material',
            type: color,
            animationSpeed: 300,
            animateFromElement: false,
            animation: 'scaleY',
            closeAnimation: 'scaleX',
            animationBounce: 1,
            typeAnimated: true,
            draggable: true,
            dragWindowBorder: true,
            smoothContent: true,
            buttons: {
                confirm: {
                    text: 'تایید',
                    btnClass: 'btn-success',
                    action: function () {
                        confirm_callback();
                    }
                },
                cancel: {
                    text: 'انصراف',
                    btnClass: 'btn-danger',
                    action: function () {
                        reject_callback();
                    }
                }
            }
        });
    }
}

window.togglePasswordField = function (clickedObj, fieldId)
{
    var x = document.getElementById(fieldId);
    clickedObj.classList.toggle("fa-eye-slash");

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

    x.focus();
}
