jQuery(document).ready(function($) {
    $('.no-auto-button').click(function(e) {
        $('body').addClass('lock');
    });
    $('.no-secret-here').click(function(e) {
        $('body').addClass('lock');
    });
    $('.yith-wcqv-button').click(function(e) {
        $('body').addClass('lock');
    });

    $('.no-auto-button').bind("click", function (e) {
        e.preventDefault();
        $('#no_auto_modal').fadeIn();
    });

    $('.no-secret-here').bind("click", function (e) {
        e.preventDefault();
        $('#surprise_modal').fadeIn();
    });

    $(".modal-window").bind("click", function (e) {
        if ($(e.target).attr("class") == "modal-container") {
            $(".modal-window").fadeOut();
        }
    })

    $('.close-button').bind("click", function (e) {
        $('.modal-window').fadeOut();
        $('body').removeClass('lock');
    });


    var timeout;

    function addCartAddOns(){
        var checkboxValues = [];
        $("#cart_add_ons input").attr('disabled','disabled');
        $('#cart_add_ons').find('input[type=checkbox]:checked').each(function() {
            checkboxValues.push($(this).attr('id'));
        });
        console.log(checkboxValues);
        console.log(JSON.stringify(checkboxValues));
        $.ajax({
            url: addons.ajaxurl,
            type: 'POST',
            datatype: 'JSON',
            data: {
                action:'set_skrobak',
                add_ons: checkboxValues,
                nonce: addons.nonce
            },
            success: function(data){
                jQuery("[name=\"update_cart\"]").removeAttr('disabled');
                jQuery("[name=\"update_cart\"]").trigger("click");
            },
            error: function(){
                console.log('ERROR');
            }
        });
    }

    $('#cart_add_ons').on('change', function(){
        if (timeout != undefined) clearTimeout(timeout);
        timeout = setTimeout(addCartAddOns, 1000);
    })

    $( document.body ).on( 'updated_cart_totals', function(){
        $("#cart_add_ons input").removeAttr('disabled');
    });

    $('body').on('updated_checkout', function(){
        $("a.zoom, a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            social_tools: false,
            theme: 'pp_woocommerce',
            horizontal_padding: 20,
            opacity: 0.8,
            deeplinking: false
        });
    });


});
