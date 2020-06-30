
;(function ($) {
    $(document).ready(function () {
        $('#jwp-ab-enquiry-form form').submit(function (e) { 
            e.preventDefault();
    
            var data = $(this).serialize();
    
            $.post(jwp_ab.ajaxurl, data, function (response) {
                if ( response.success ) {
                    console.log( response.data );
                } else {
                    alert( response.data.message );
                }
            }, "json")
            .fail(function () {
                alert(jwp_ab.error);
            }); 
        });
    });
})(jQuery);