$(document).ready(function() {
    if ($('.adv-combo-wrapper select').length > 0 && $.fn.select2) {
        $('.adv-combo-wrapper select').select2({
        	placeholder: 'Please Select',
        	width: '100%',
        });
        
        $country_list = $('.country_list .adv-combo-wrapper select');
        
        $country_list.select2({
        	placeholder: $country_list.attr('placeholder') || 'Please Select',
        	width: '100%',
        });

        $('select.no-search').select2({
        	 minimumResultsForSearch: -1
        });

        $("#region select").select2({
            dropdownCssClass : 'region_dropdown'
        });
    }

    if ($('.faq-entry .dropdown-arrow').length > 0) {
        $('.faq-entry').last().addClass('expanded');
        $('.faq-entry .dropdown-arrow').parent().click( function() {
            $(this).closest('.faq-entry').toggleClass('expanded');
        });
    }
});
