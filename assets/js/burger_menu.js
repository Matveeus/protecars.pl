jQuery(document).ready(function() {
    jQuery('.header-burger').click(function(event) {
        jQuery('.header-burger,.navigation').toggleClass('active');
        jQuery('body').toggleClass('lock');
    })
});