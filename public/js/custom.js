$(document).ready(function(){    

    $(".dropdown-menu").each(function(){ $(this).css({right: -($(this).width()/2+20)+"px"}); });

    $("#profile-edit-section form").submit(function(e){
    	e.preventDefault();
    	$.ajax({
    		method:'post',
    		url: $(this).attr('action'),
    		data: $(this).serialize(),
    		dataType: 'json',
    		success:function(response){
    			$("span.invalid-feedback").hide();
    			$("span.invalid-feedback").find("strong").empty();
    			if(response.success == false ){
    				$.each(response.result, function(key, value){    					
    					if(typeof value == 'object'){
    						$.each(value, function(a, b){    							
    							$("span.invalid-feedback."+key).find("strong").append(b+"<br>");
    						});    						
    					}else{
    						$("span.invalid-feedback."+key).find("strong").text(value);
    					}    					
    					$("span.invalid-feedback."+key).show();
    				});
    			}else{
    				window.location.href = "/profile";
    			}
    		}
    	});
    	return false;
    });

    if($.fn.imageuploadify){
    	$('input[type="file"]').imageuploadify();
    }    

    $(".custom-dropdown >div.select").click(function(){	    	
    	$(this).parent().find(">ul").toggle();
    });

    $("#to_be_definded").on("click", function(){
    	$(".custom-dropdown .custom-select2").toggle();
    });

    $(".custom-dropdown .custom-dropdown-menu button").click(function(){
    	var select_box = $(this).parent().parent();
    	select_box.toggle();
    	var show_box = $(this).closest('.custom-dropdown').find('>.select');
    	var region = select_box.find("input[name='region[]']").val();
    	
    	var regionIdx = [];
    	var region = [];
    	$("input[name='region[]'").each(function(i){
    		if($(this).attr('type') == 'checkbox'){
    			if($(this).is(":checked")){
    				regionIdx.push($(this).val());		
    				region.push($(this).attr('region'));	
    			}
    		}
    		else if($(this).attr('type') == 'hidden'){
    			if($(this).val()){
    				regionIdx.push($(this).val());	
    				region.push($(this).parent().find(".select").text());		
    			}
    		}
    		
    	});
        if(select_box.find(".custom-select2 select").val() && $("#to_be_definded").is(":checked") ){
            regionIdx.push(select_box.find(".custom-select2 select").val());    
            region.push(select_box.find(".custom-select2 select").find("option:checked").text());
        }        
    	
    	show_box.find("span").html(region.join(','));
    	$("input[name='offercountry']").val(regionIdx.join(','));
    });

    $(".data-offer .step button.btn-next").click(function(e){
    	var cur_step = $(this).closest("div.step");
    	cur_step.find('.error_notice').hide();

		cur_step.find("input, textarea").each(function(key, elem){    			
			cur_step.find('.error_notice').removeClass('active');
			if( $(elem).val() == "" ){
				var elem_name = $(elem).attr("name").replace('[]','');
				cur_step.find('.error_notice.'+elem_name).show();    				
			}			
		});
	
    	var allow_next = true;
    	cur_step.find('.error_notice').each(function(key, elem){    		
    		if( $(elem).css('display') == "block"){
    			allow_next = false;
    		}
    	});

    	if( allow_next == true ){
    		var next = cur_step.next();

	    	cur_step.removeClass("current");
	    	next.addClass('current');	
    	}

    });
    $(".data-offer .step a.back-icon").click(function(e){
    	var cur_step = $(this).closest("div.step");
    	var prev = cur_step.prev();

    	cur_step.removeClass("current");
    	prev.addClass('current');

    });

    /*$("#data-offer").submit(function(e){
    	e.preventDefault();    
    	console.log($(this).serialize());
    });*/

    $("#community").change(function(){        
        var community = $(this).val();
        window.location.href = '/'+ community.toLowerCase().replace(" ", "_");
    });

    $("#theme").change(function(){        
        var theme = $(this).val();
        window.location.href = '/data/region/'+ theme;
    });

});

/*Dropdown Menu*/
$('.dropdown-container .dropdown').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menu').slideToggle(300);    
});
$('.dropdown-container .dropdown').focusout(function () {
    $(this).removeClass('active');
    $('.dropdown-container .dropdown-menu').slideUp(300);
});
$('.dropdown-container .dropdown .dropdown-menu li').click(function () {
    $(this).parents('.dropdown-container .dropdown').find('span').text($(this).text());
    $(this).parents('.dropdown-container .dropdown').find('input').attr('value', $(this).attr('value')).change();
});
/*End Dropdown Menu*/




