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

    $("#edit_product").submit(function(e){
        e.preventDefault();
        var _this = this;
        
        $(_this).find('.error_notice').hide();

        $(_this).find("input, textarea, select").each(function(key, elem){                           
            $(_this).find('.error_notice').removeClass('active');
            if( $(elem).val() == "" ){
                var elem_name = $(elem).attr("name").replace('[]','');
                var period_radio = $(this).parent().parent().parent().find('input[type="radio"]');

                if( period_radio.length >0 ){
                    if( period_radio.is(':checked') ){
                        $(_this).find('.error_notice.'+elem_name).show();                    
                    }                    
                }else{
                    $(_this).find('.error_notice.'+elem_name).show();
                }                
            }            
        });

        var submit_flag = true;
        $(_this).find('.error_notice').each(function(key, elem){            
            if( $(elem).css('display') == "block"){
                submit_flag = false;
            }
        });

        if( submit_flag ){
            $.ajax({
                method:'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success:function(response){                    
                    if(response.success == true ){
                        console.log(response);
                        // window.location.href = "/data/offers/"+ $('input[name="offerIdx"]').val();
                        window.location.href = response.redirect;
                    }
                }
            });
        }

        return false;
    });

    $('input[type=checkbox]').on('change', function(evt) {
        var container = $(this).closest('.limited-check-group');
        var limit = container.attr('max-check') || 5;
        if($(container).find('input[type=checkbox]:checked').length > limit) {
            this.checked = false;
        }
    });
});
