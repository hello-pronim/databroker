$(document).ready(function(){  
    document.querySelectorAll('.nav-item a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    var path = window.location.pathname;
    $.each( $("#topnav .nav-link"), function(key, elem){
        if( $(elem).attr("href") == window.location.href ){
            $(elem).addClass('active');
        }
    });

    $.each($("#community option"), function(key, elem){        
        var option_text = window.location.pathname.slice(1);
        if($(elem).attr("community-name")){
            if( $(elem).attr("community-name").toLowerCase()  == option_text.replace("_", " ") ){
                $(elem).prop('selected', true);
            }            
        }        
    });

    var community = $("#community").val();
    $.each( $("#theme option"), function(key, elem){                        
        if( community != 'all' && $(elem).attr('value') != 'all' && community  != $(elem).attr("community-id") ){
            $(elem).remove();
        }            
    });
    $('#theme').val('all');

    $('[data-toggle="tooltip"]').tooltip();

    $(".blog-content .tab-content .tab-pane:first-child").addClass("active");

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

    $("#region.custom-dropdown .custom-dropdown-menu select").change(function(){        
        var select_box = $(this).parent().parent();
        select_box.toggle();
        
        var region = $(this).val();
        var regionName = $(this).find("option:selected").text();

        var show_box = $(this).closest('.custom-dropdown').find('>.select');
        show_box.find("span").html(regionName);

        $("input[name='region']").val(region);
    });

    $("#region.custom-dropdown .custom-dropdown-menu span.region").click(function(){        
       var select_box = $(this).parent();
       select_box.toggle();

       $("input[name='region']").val( $(this).attr("region-id") );
       var show_box = $(this).closest('.custom-dropdown').find('>.select');
       var regionName = $(this).text();
       show_box.find("span").html(regionName);
       
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

	    	cur_step.removeClass("current back");
	    	next.addClass('current');	
            window.scrollTo(0, 0); 
    	}

    });
    $(".data-offer .step a.back-icon").click(function(e){
    	var cur_step = $(this).closest("div.step");
    	var prev = cur_step.prev();

    	cur_step.removeClass("current back");
    	prev.addClass('current back');
        window.scrollTo(0, 0); 
    });
    $("#add_product").submit(function(e){
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
    /*$("#data-offer").submit(function(e){
    	e.preventDefault();    
    	console.log($(this).serialize());
    });*/

    var theme_select_obj = $("#theme option");
    
    $("#community").change(function(){                
        //window.location.href = '/'+ community.toLowerCase().replace(" ", "_");
        filter_dataoffer();
        $("#theme").html(theme_select_obj);

        var community = $("#community").val();
        $.each( $("#theme option"), function(key, elem){                        
            if( community != 'all' && $(elem).attr('value') != 'all' && community  != $(elem).attr("community-id") ){
                $(elem).remove();
            }            
        });  
        $('#theme').val('all');      
        var community_name = $("#community").find("option:selected").attr("community-name");
        if( community_name ){
            window.location.href = window.location.origin + "/" + community_name.toLowerCase().replace(' ','_');
        }
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

    function filter_dataoffer(loadmore=false){
        var crsf = $("input[name='_token']").val();        
        var community = $("#community").val();
        var theme = $("#theme").val();
        var region1 = $("#region select").val();
        var region2 = $("#region span.region.active").attr("region-id");
       
        region = region1==""?region2:region1;
        if(region == "all") region = "";
        var data = {_token: crsf, community: community, theme:theme, region:region, loadmore:loadmore }
        
        $.ajax({
            type: "post",
            url : '/offer/filter',
            data : data,
            dataType: 'json',
            success: function(res){                
                var list= "";
                $.each(res, function(key, elem){                                       
                   
                    list += 
                        '<div class="col-md-4 mb-20">' +
                            '<div class="card card-profile card-plain mb-0">' +
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

                //list = '<div class="row">' + list + '</div>';
                var offercount = $("#offer-count span");
                if(loadmore == false){
                    $("#offer-list .row").html(list);   
                    offercount.html( res.length );
                }else{
                    $("#offer-list .row").append(list);    
                    offercount.html( parseInt(offercount.text()) + res.length );
                }   
                var totalcount = $("input[name='totalcount']").val();
                if( parseInt(offercount.text()) >= totalcount ){
                    $("#offer_loadmore").parent().remove();
                }
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

    $(".text-wrapper textarea").keyup(function(){
        var text = $(this).val();
        
        $(this).parent().find('.char-counter span').eq(0).text(text.length);
        var text_length = $(this).attr('maxlength');
        $(this).parent().find('.char-counter span').eq(1).text(parseInt( text_length ) - text.length);
    });

    $("#community_box").change(function(){
        $("#community_title i").attr("data-original-title", $(this).find("option:selected").attr("tooltip-text"));
    });

    function product_period(){
        $('.period .period_select').hide();
        $("input[name='period']:checked").parent().parent().find('.period_select').show();
    }

    $("input[name='period']").change(function(){
        product_period();
    });

    product_period();
    $(".data_publish").click(function(e){
        e.preventDefault();

        var data_type = $(this).attr('data-type')
        var data_id = $(this).attr('data-id')
        if(data_type && data_id){
            $.ajax({
                type: "post",
                url : '/data/update-status',
                data : {update:'publish', dataType: data_type, dataId: data_id},
                dataType: 'json',
                success: function(res){
                    if(res.success == true){
                        window.location.reload();    
                    }
                }
            });
        }        
    });

    $(".data_unpublish").click(function(){
        $("#unpublishModal").find("input[name='data_type']").val($(this).attr('data-type'));
        $("#unpublishModal").find("input[name='data_id']").val($(this).attr('data-id'));
    });
    $("#unpublishModal button.unpublish").click(function(e){
        e.preventDefault();
        var data_type = $(this).closest('.modal').find("input[name='data_type']").val();
        var data_id = $(this).closest('.modal').find("input[name='data_id']").val();
        if(data_type && data_id){
            $.ajax({
                type: "post",
                url : '/data/update-status',
                data : {update: 'unpublish', dataType: data_type, dataId: data_id},
                dataType: 'json',
                success: function(res){
                    if(res.success == true){
                        window.location.reload();    
                    }
                }
            });
        }        
    });
    $("#offer_loadmore").click(function(){
        console.log($("#offer-list .card").length);
        filter_dataoffer($("#offer-list .card").length);
    });

    $('#inviteModal .more_email').click(function(){

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

$(".nav-tabs .nav-link").click(function(){
    $(".nav-tabs .nav-link").removeClass('active');
    $(this).addClass('active');
});
/*End Dropdown Menu*/




