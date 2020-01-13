$(document).ready(function() {
    $('.adv-combo-wrapper select').select2({
    	placeholder: 'Please Select',
    	width: '100%',
    });
    
    $country_list = $('.country_list .adv-combo-wrapper select');
    console.log($country_list, $country_list.attr('placeholder'));
    $country_list.select2({
    	placeholder: $country_list.attr('placeholder') || 'Please Select',
    	width: '100%',
    });
});
