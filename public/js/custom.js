$(document).ready(function(){    

    $(".dropdown-menu").each(function(){ $(this).css({right: -($(this).width()/2+20)+"px"}); });

    if($.fn.imageuploadify){
    	$('input[type="file"]').imageuploadify();
    }    

    $(".custom-dropdown div.select").click(function(){	    	
    	$(this).parent().find("ul").toggle();
    });

    $(".custom-dropdown .custom-dropdown-menu button").click(function(){
    	var select_box = $(this).parent().parent();
    	select_box.toggle();
    	var show_box = $(this).closest('.custom-dropdown').find('.select');
    	var region = select_box.find("input[name='region[]']").val();
    	
    	var region = []
    	$("input[name='region[]'").each(function(i){
    		if($(this).attr('type') == 'checkbox'){
    			if($(this).is(":checked")){
    				region.push($(this).val());		
    			}
    		}
    		else if($(this).attr('type') == 'text'){
    			if($(this).val()){
    				region.push($(this).val());		
    			}
    		}
    		
    	});
    	
    	show_box.find("span").html(region.join(','));
    	$("input[name='region_']").val(region.join(','));
    });


    $(".data-offer .step button.btn-next").click(function(e){
    	var cur_step = $(this).closest("div.step");
    	var next = cur_step.next();

    	cur_step.removeClass("current");
    	next.addClass('current');

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




