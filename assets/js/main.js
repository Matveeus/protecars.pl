jQuery(document).ready(function($) {

    new WOW().init();
    function getQueryParams(qs) {
        qs = qs.split("+").join(" ");
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])]
                = decodeURIComponent(tokens[2]);
        }

        return params;
    }

    var $_GET = getQueryParams(document.location.search);

    $('body').fadeIn();

    var markaSelect = $('#marka_select');
    var modelSelect = $('#model_select');
    var genSelect = $('#gen_select');
    var typeSelect = $('#type_select');

    var markaValue = $_GET['marka'],
        modelValue = $_GET['model'],
        genValue = $_GET['generacja'],
        typeValue = $_GET['type'];

    var markaList = $('#marka_select .select__list');
    var modelList = $('#model_select .select__list');
    var genList = $('#gen_select .select__list');
    var typeList = $('#type_select .select__list');

    var filterSubmit = $("#submit_filter");

    var prevoiusRequest = ["default", "default"];

    function removeAllOptions(sel) {
        groups = sel.find('li');
        groups.each(function() {
            $(this).remove();
        });
        sel.siblings('.select__head').text('Wybrać');
        sel.siblings('.select__input').val('default');
    }

    function appendItems(relList, data){
        var newItems = JSON.parse(data);
        for (const [key, value] of Object.entries(newItems)) {
            var o = $('<li class="select__item" product-data="' + key + '"></li>');
            o.append( $(document.createTextNode( value ) ) );
            relList.append(o)
        }
    }


    markaSelect.on('click', '.select__item', function () {
        removeAllOptions(modelList);
        removeAllOptions(genList);
        removeAllOptions(typeList);
        $('#filterForm').change();
        modelSelect.addClass("disabled");
        genSelect.addClass("disabled");
        typeSelect.addClass("disabled");
        var input_val = $(this).parent().siblings('.select__input').val();
        markaValue = input_val;
        if (input_val != "default"){
            $.ajax({
                url: filter.ajaxurl,
                type: 'POST',
                data: {
                    action:'upload_next_select',
                    category: input_val,
                    nonce: filter.nonce
                },
                success: function(data){
                    appendItems(modelList, data);
                    genSelect.addClass("disabled");
                    modelSelect.removeClass("disabled");
                    if (window.location.href.includes('protecars.pl/katalog')){
                        var link = '?marka=' + markaValue;
                        history.replaceState({}, "katalog", link)
                    }
                },
                error: function(){
                    console.log('ERROR');
                }
            });
        } else {
            genSelect.addClass("disabled");
            modelSelect.addClass("disabled");
        }
    });

    modelSelect.on('click', '.select__item', function () {
        removeAllOptions(genList);
        removeAllOptions(typeList);
        $('#filterForm').change();
        genSelect.addClass("disabled");
        typeSelect.addClass("disabled");
        var input_val = $(this).parent().siblings('.select__input').val();
        modelValue = input_val;
        if (input_val != "default"){
            $.ajax({
                url: filter.ajaxurl,
                type: 'POST',
                data: {
                    action:'upload_next_select',
                    category: input_val,
                    nonce: filter.nonce
                },
                success: function(data){
                    appendItems(genList, data);
                    genSelect.removeClass("disabled");
                    if (window.location.href.includes('protecars.pl/katalog')){
                        var link = '?marka=' + markaValue + '&model=' + modelValue;
                        history.replaceState({}, "katalog", link)
                    }
                },
                error: function(){
                    console.log('ERROR');
                }
            });
        } else {
            genSelect.addClass("disabled");
        }
    });

    genSelect.on('click', '.select__item', function () {
        removeAllOptions(typeList);
        $('#filterForm').change();
        typeSelect.addClass("disabled");
        var input_val = $(this).parent().siblings('.select__input').val();
        genValue = input_val;
        if (this.value != "default"){
            $.ajax({
                url: filter.ajaxurl,
                type: 'POST',
                data: {
                    action:'upload_types',
                    category: input_val,
                    nonce: filter.nonce
                },
                success: function(data){
                    appendItems(typeList, data);
                    typeSelect.removeClass("disabled");
                    if (window.location.href.includes('protecars.pl/katalog')){
                        var link = '?marka=' + markaValue + '&model=' + modelValue + '&generacja=' + genValue;
                        history.replaceState({}, "katalog", link)
                    }
                },
                error: function(){
                    console.log('ERROR');
                }
            });
        } else {
            typeSelect.addClass("disabled");
        }
    });

    typeSelect.on('click', '.select__item', function () {
        var input_val = $(this).parent().siblings('.select__input').val();
        typeValue = input_val;
        if (window.location.href.includes('protecars.pl/katalog')){
            var link = '?marka=' + markaValue + '&model=' + modelValue + '&generacja=' + genValue + '&typ=' + typeValue;
            history.replaceState({}, "katalog", link)
        }
    });

    $('#filterForm').change(function() {
        if (markaSelect.find('.select__input').val() !== 'default' && modelSelect.find('.select__input').val() && genSelect.find('.select__input').val() !== 'default'){
            changeButton(filterSubmit, false)
        } else {
            changeButton(filterSubmit, true)
        }
        console.log('changed');
    });

    function changeButton(button, disable){
        if (disable === false){
            button.removeClass('disabled-button')
            button.removeAttr('disabled');
        } else {
            button.addClass('disabled-button')
            button.attr('disabled', 'disabled');
        }
    }

    $('.archive-product-form').on('submit', function(e){
        e.preventDefault();
        var completeCat = $.trim(genSelect.find('.select__input').val());
        var typeId = $.trim(typeSelect.find('.select__input').val());
        var productsContainer = $('ul.products');
        if (completeCat !== '' && completeCat !== 'default' && (completeCat !== prevoiusRequest[0] || typeId !== prevoiusRequest[1])){
            prevoiusRequest[0] = completeCat;
            prevoiusRequest[1] = typeId;
            $('.lds-dual-ring').fadeIn();
            productsContainer.fadeOut();
            $.ajax({
                url: filter.ajaxurl,
                type: 'POST',
                data: {
                    action:'load_products',
                    category: completeCat,
                    type: typeId,
                    nonce: filter.nonce
                },
                dataType : 'html',
                success: function(data){
                    removeAllOptions(productsContainer);
                    productsContainer.append(data);
                    $('.lds-dual-ring').fadeOut();
                    productsContainer.fadeIn();
                    anton();
                },
                error: function(){
                    console.log('ERROR');
                }
            });

        }

    });


});

    jQuery(document).ready(function() {
    var btn = $('#button-up');
    $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
    btn.addClass('show');
} else {
    btn.removeClass('show');
}
});
    btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});
});




