$(document).ready(function(){    

    $(".dropdown-menu").each(function(){ $(this).css({right: -($(this).width()/2+20)+"px"}); console.log($(this).width()) });

    if($.fn.imageuploadify){
    	$('input[type="file"]').imageuploadify();
    }    

    $(".custom-dropdown div.select").click(function(){	    	
    	$(this).parent().find("ul").toggle();
    })

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




