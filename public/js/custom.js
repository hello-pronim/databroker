$(document).ready(function(){    

    $(".dropdown-menu").each(function(){ $(this).css({right: -($(this).width()/2+20)+"px"}); });

    $("#register_nl_section form").submit(function(e){
        e.preventDefault();
        
        var community = [];
        $(this).find("input[name='community[]']").each(function(i){
            
            if($(this).is(":checked")){
                community.push($(this).val());
            }
            
        });    
        $(this).find(".error_notice").hide();
        if(community.length == 0 ){
            $(this).find(".error_notice").show();
        }

        return false;
    })

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

		cur_step.find("input, textarea, select").each(function(key, elem){    			
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
        //window.location.href = '/'+ community.toLowerCase().replace(" ", "_");
        filter_dataoffer();
    });

    $("#theme").change(function(){                
        filter_dataoffer();
    });

    $("#region select").change(function(){
        filter_dataoffer();
        $("#region span.region").removeClass('active');
    });

    $("#region span.region").click(function(){        
        $("#region select").val("");
        $("#region span.region").removeClass('active');
        $(this).addClass('active');
        filter_dataoffer();
    });

    function filter_dataoffer(){
        var crsf = $("input[name='_token']").val();        
        var community = $("#community").val();
        var theme = $("#theme").val();
        var region1 = $("#region select").val();
        var region2 = $("#region span.region.active").attr("region-id");
       
        region = region1==""?region2:region1;
        if(region == "all") region = "";
        var data = {_token: crsf, community: community, theme:theme, region:region}
        
        $.ajax({
            type: "post",
            url : '/offer/filter',
            data : data,
            dataType: 'json',
            success: function(res){
                console.log(res);
                var list= "";
                $.each(res, function(key, elem){                                       
                   
                    list += 
                        '<div class="col-md-4">' +
                            '<div class="card card-profile card-plain">' +
                                '<div class="card-header">' +
                                    '<a href="/data/'+elem.offerIdx+'">' +
                                        '<img class="img" src="/uploads/offer/'+elem.offerImage+'" />'+
                                    '</a>'+
                                '</div>'+
                                '<div class="card-body text-left">'+
                                    '<h4 class="offer-title card-title">'+elem.offerTitle+'</h4>'+
                                    '<h6 class="offer-location card-category">';
                                    if(typeof elem.region == 'object'){
                                        $.each(elem.region, function(a, b){
                                            list += '<span>'+b.regionName+'</span>';
                                        });
                                    }else{
                                        list += '<span>'+elem.regionName+'</span>';
                                    }    
                                    
                                    list+='</h6>'+
                                    '<a href="'+elem.provider.companyURL+'"><img class="img" src="uploads/company/'+elem.provider.companyLogo+'" /></a>'+
                                '</div>'+
                            '</div>'+
                        '</div>';                    
                });

                list = '<div class="row">' + list + '</div>';
                $("#offer-list").html(list);
            }
        });

    }

    $("#bids .bid a.nav-link").click(function(){
        $($("#bids .bid a.nav-link")).removeClass('active');
        $("#bids .bid").removeClass("open");
        $(this).parent().addClass("open");
    });

    $(".more_dropdown a").click(function(){
        $(this).find("i").toggle();
        $(this).parent().find("div").toggle();
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




