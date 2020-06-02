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
        if( $('#activeCommunity').val() && $(elem).attr("href").indexOf($('#activeCommunity').val().toLowerCase())>=0){
            $(elem).addClass('active');
        }
    });

    $.each($("#community option"), function(key, elem){     
        var option_text = window.location.pathname.split("/")[1];
        if($(elem).attr("community-name")){
            if( $(elem).attr("community-name").toLowerCase()  == option_text.replace("_", " ") ){
                $(elem).prop('selected', true);
            }            
        }        
    });

    $.each($("#theme option"), function(key, elem){     
        var themeId = window.location.pathname.split("/")[3];
        var filterBy = window.location.pathname.split('/')[2];
        if(themeId && filterBy=="theme"){
            if($(elem).attr("value")){
                if( $(elem).attr("value") == themeId){
                    $(elem).prop('selected', true);
                }            
            }    
        }    
    });

    $.each($("#region option"), function(key, elem){     
        var regionIdx = window.location.pathname.split("/")[3];
        var filterBy = window.location.pathname.split('/')[2];
        if(regionIdx && filterBy=="region"){
            if($(elem).attr("value")){
                if( $(elem).html().toLowerCase().replace(" ", "-") == regionIdx){
                    $("#region input[name='region']").val(regionIdx);
                    $("#region .select span").html($(elem).html()); 
                    $("#region .select").addClass("chosen"); 
                    $(".region_text").html("/"+$(elem).html());
                }            
            }    
        }    
    });

    $.each($("#region .region-select span.region"), function(key, elem){     
        var regionName = window.location.pathname.split("/")[3];
        var filterBy = window.location.pathname.split('/')[2];
        if(regionName && filterBy=="region"){
            if($(elem).attr("region-id")){
                if( $(elem).html().toLowerCase().replace(" ", "-") == regionName){
                    $(elem).addClass('active');
                    $("#region input[name='region']").val($(elem).attr('region-id'));
                    $("#region .select span").html($(elem).html()); 
                    $("#region .select").addClass("chosen"); 
                    $(".region_text").html("/"+$(elem).html());
                }            
            }    
        }    
    });

    var community = $("#community").val();
    $.each( $("#theme option"), function(key, elem){
        if( community != 'all' && $(elem).attr('value') != 'all' && community  != $(elem).attr("community-id") ){
            $(elem).remove();
        }
    });
    
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
                $('.is-invalid').removeClass('is-invalid');
    			$("span.invalid-feedback").find("strong").empty();
    			if(response.success == false ){
    				$.each(response.result, function(key, value){    		
                    console.log(key);
                    console.log(value);
    					if(typeof value == 'object'){
    						$.each(value, function(a, b){ 	
                                if(key=="password"){
                                    //$("span.feedback."+key).find("strong").html(b);
                                    $('span.feedback.'+key).addClass('invalid-feedback');
                                } else if(key=="password_confirmation"){
                                    $("span.feedback."+key).find("strong").html(b);
                                    $('span.feedback.'+key).addClass('invalid-feedback');
                                }
    							else $("span.invalid-feedback."+key).find("strong").html(b);
    						});
    					}else{
                            if(key=='password'){
                                //$("span.feedback."+key).find("strong").text(value);
                                $('span.feedback.'+key).addClass('invalid-feedback');
                            }else if(key=='password_confirmation'){
                                $("span.feedback."+key).find("strong").text(value);
                                $('span.feedback.'+key).addClass('invalid-feedback');
                            }
    						else $("span.invalid-feedback."+key).find("strong").text(value);
    					}    				
                        $('#'+key).addClass('is-invalid');	
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
        if($(this).parent().hasClass('dropdown-open')) $(this).parent().removeClass('dropdown-open');
        else $(this).parent().addClass('dropdown-open');
    });

    $(".custom-dropdown .custom-dropdown-menu button").click(function(){
        if($(this).closest(".custom-dropdown").hasClass('dropdown-open'))
            $(this).closest(".custom-dropdown").removeClass('dropdown-open');
    	var select_box = $(this).parent().parent();
    	select_box.toggle();
    	var show_box = $(this).closest('.custom-dropdown').find('>.select');
        $(show_box).addClass("chosen");
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
        if(select_box.find(".custom-select2 select").val()){
            regionIdx.push(select_box.find(".custom-select2 select").val());    
            region.push(select_box.find(".custom-select2 select").find("option:checked").text());
        }        
    	        
    	show_box.find("span").html(region.join(', '));
    	$("input[name='offercountry']").val(regionIdx.join(','));
    });

    $("#region.custom-dropdown .custom-dropdown-menu select").change(function(){        
        var select_box = $(this).parent().parent();
        select_box.toggle();
        
        var region = $(this).val();
        var regionName = $(this).find("option:selected").text();

        var show_box = $(this).closest('.custom-dropdown').find('>.select');
        $(show_box).addClass("chosen");
        show_box.find("span").html(regionName);

        $("input[name='region']").val(region);
    });

    $("#region.custom-dropdown .custom-dropdown-menu span.region").click(function(){        
       var select_box = $(this).parent();
       select_box.toggle();

       $("input[name='region']").val( $(this).attr("region-id") );
       var show_box = $(this).closest('.custom-dropdown').find('>.select');
        $(show_box).addClass("chosen");
       var regionName = $(this).text();
       show_box.find("span").html(regionName);
       
    });
    
    var validate = function (cur_step, elem) {                
        cur_step.find('.error_notice').removeClass('active'); 
        // cur_step.find('.error_notice').hide();
        var elem_name = $(elem).attr("name");
        if (elem_name) {
            elem_name = elem_name.replace('[]','');
            if( $(elem).val() === "" && $(elem).attr('remotefile') === undefined){
                cur_step.find('.error_notice.'+elem_name).show();
            } else if(!$(elem).is(":checked") && $(elem).attr('type')=='checkbox'){
                cur_step.find('.error_notice.'+elem_name).show();
            } else {
                cur_step.find('.error_notice.'+elem_name).hide();
            }
        }
    };
    $(".data-offer .step").each(function(key, elem){
    	var cur_step = $(this);
    	cur_step.find('.error_notice').hide();

        cur_step.find("input, textarea, select").on('blur', function (evt) {
            validate(cur_step, evt.target);
        });
    });
	
    $(".data-offer .step button.btn-next").click(function(e){
        var cur_step = $(this).closest("div.step");

        cur_step.find("input, textarea, select").each(function(key, elem) {
            validate(cur_step, elem);
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

    function validateURL(s) {
       var regexp = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
       return regexp.test(s);
    }
    const serialize_form = form => JSON.stringify(
      Array.from(new FormData(form).entries())
           .reduce((m, [ key, value ]) => Object.assign(m, { [key]: value }), {})
    );
    $('.period_select input[type="number"]').on('input', function(e){
        var val = $(this).val();
        if(parseFloat(val) < 0.5 || !(parseFloat(val)>0)){
            console.log('.error_notice.'+$(this).attr('name')+'_min');
            $(this).closest('.period_select').find('.error_notice.'+$(this).attr('name')+'_min').show();
        }else{
            $(this).closest('.period_select').find('.error_notice.'+$(this).attr('name')+'_min').hide();
        }
    });
    $("#add_product").submit(function(e){
        e.preventDefault();

        var bidType = $('input[name="period"]:checked').val();
        var dataType = $('input[name="format"]:checked').val();
        var _this = this;
        var formValues = JSON.parse(serialize_form(_this));
        
        $(_this).find('.error_notice').hide();               

        $(_this).find("input, textarea, select").each(function(key, elem){     
            $(_this).find('.error_notice').removeClass('active');
            if( $(elem).val() == "" && $(elem).attr('name')!="DataTables_Table_0_length" && $(elem).attr('type')!="search"){
                var elem_name = $(elem).attr("name").replace('[]','');
                var period_radio = $(this).parent().parent().parent().find('input[type="radio"]');

                if( period_radio.length >0 ){
                    if( period_radio.is(':checked') ){
                        $(_this).find('.error_notice.'+elem_name).show();                    
                    }                    
                }else{
                    if(elem_name != 'dataUrl')
                        $(_this).find('.error_notice.'+elem_name).show();
                }                
            } if(!validateURL($("#licenseUrl").val())){
                $(_this).find('.error_notice.licenceUrl').show();
            } if(bidType=="no_bidding" && parseFloat($('input[name="no_bidding_price"]').val())<0.5){
                $(_this).find('.error_notice.no_bidding_price_min').show();
            } if(bidType=="bidding_possible" && (parseFloat($('input[name="bidding_possible_price"]').val())<0.5 || !(parseFloat($('input[name="bidding_possible_price"]').val())>0))){
                $(_this).find('.error_notice.bidding_possible_price_min').show();
            } if(bidType=="free" && !validateURL($("#dataUrl").val())){
                $(_this).find('.error_notice.dataUrl').show();
            } if(dataType=="Stream" && $('#streamIP').val() == ""){
                $(_this).find('.error_notice.streamIP').show();
            } if(dataType=="Stream" && $('#streamPort').val() == ""){
                $(_this).find('.error_notice.streamPort').show();
            }
        });
        if(formValues.format === undefined){
            $(_this).find('.error_notice.format').show();
        } 
        if(formValues.period === undefined){
            $(_this).find('.error_notice.period').show();
        }

        var submit_flag = true;
        $(_this).find('.error_notice').each(function(key, elem){          
            if( $(elem).css('display') != "none"){
                submit_flag = false;
            }
        });
        console.log(submit_flag);

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

    var theme_select_obj = $("#theme option");
    
    $("#community").change(function(){                
        //window.location.href = '/'+ community.toLowerCase().replace(" ", "_");
        filter_dataoffer();

        var community = $("#community").val();
        if(community != 'all'){
           $("#theme").html(theme_select_obj);

            $.each( $("#theme option"), function(key, elem){                        
                if( community != 'all' && $(elem).attr('value') != 'all' && community  != $(elem).attr("community-id") ){
                    $(elem).remove();
                }            
            });  
            $('#theme').val('all');      
            var community_name = $("#community").find("option:selected").attr("community-name");
            if( community_name ){
                if($('input[name="region"]').val())
                    window.location.href = window.location.origin + "/" + community_name.toLowerCase().replace(' ','_') + "/region/" + $('input[name="region"]').val();
                else
                    window.location.href = window.location.origin + "/" + community_name.toLowerCase().replace(' ','_');
            }
        }else{
            let cur_theme = $("#theme").val();
            console.log(cur_theme);
            $.ajax({
                method: 'get',
                url: '/getAllThemes',
                dataType: 'json',
                success: function(res){
                    let themes = res.themes;
                    console.log(themes);
                    let options = '<option value="all">All themes</option>';
                    for(let i=0; i<themes.length; i++){
                        if(themes[i].themeIdx == cur_theme)
                            options+= '<option value="'+ themes[i].themeIdx+'" community-id="'+themes[i].communityIdx+'" selected>'+themes[i].themeName+'</option>';
                        else
                            options+= '<option value="'+ themes[i].themeIdx+'" community-id="'+themes[i].communityIdx+'">'+themes[i].themeName+'</option>';
                    }
                    $("#theme").html(options);
                }
            })
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
        var theme_text = $("#theme option:selected").text();
        var region1 = $("#region select").val();
        var region2 = $("#region span.region.active").attr("region-id");

        region = region1==""?region2:region1;
        var region_text = $('#region .select >span').html();
        if($("#region span.region.active").text() == "World") region = "";
        var data = {_token: crsf, community: community, theme:theme, region:region, loadmore:loadmore }
        
        $.ajax({
            type: "post",
            url : '/offer/filter',
            data : data,
            dataType: 'json',
            success: function(res){ 
                console.log(res);               
                var list= "";
                $.each(res.offers, function(key, elem){                                       
                    let companyName = (elem.companyName).toLowerCase();
                    let offer_title = elem.offerTitle.toLowerCase().replace(/\s/g, '-');
                    let offer_region = "";
                    $.each(elem.region, function(k, e){
                        offer_region+=e.regionName.toLowerCase().replace(/\s/g, '-');
                        if(k+1 < elem.region.length) offer_region+="-";
                    });
                    list += 
                        '<div class="col-md-4 mb-20">' +
                            '<div class="card card-profile card-plain mb-0">' +
                                '<div class="card-header">' +
                                    '<a href="/offers/'+companyName+'/'+offer_title+'-'+offer_region+'">' ;
                        if(elem.offerImage && elem.offerImage != "null"){
                            list +='<img class="img" src="'+elem.offerImage+'" />';
                        }else{
                            list +='<img class="img" src="/uploads/offer/default.png" />';
                        }
                            list += '</a>'+
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
                                    if(elem.provider.companyURL.indexOf('https')>-1){
                                        list+='</h6>'+ '<a href="/'+elem.companyName.replace(/\s/g, '-')+'/offers">';
                                        if(elem.provider.companyLogo){
                                            list+='<img class="img" src="/uploads/company/thumb/'+elem.provider.companyLogo+'" />';    
                                        }else{
                                            list+='<img class="img" src="/uploads/company/default_thumb.png" />';    
                                        }
                                        list+='</a>'+ 
                                        '</div>'+
                                    '</div>'+
                                '</div>';   
                                    }else{
                                        list+='</h6>'+ '<a href="/'+elem.companyName.replace(/\s/g, '-')+'/offers">'
                                        if(elem.provider.companyLogo){
                                            list+='<img class="img" src="/uploads/company/thumb/'+elem.provider.companyLogo+'" />';    
                                        }else{
                                            list+='<img class="img" src="/uploads/company/default_thumb.png" />';    
                                        }
                                        list+='</a>'+ 
                                        '</div>'+
                                    '</div>'+
                                '</div>'; 
                                }                   
                });

                if( theme_text != 'All themes' ){
                    $('.theme_text').html("/" + theme_text);
                }else{
                    $('.theme_text').html("");
                }
                if(region) $('.region_text').html("/" + region_text);
                else $('.region_text').html("");
                //list = '<div class="row">' + list + '</div>';
                var offercount = $("#offer-count span");
                if(loadmore == false){
                    $("#offer-list .row").html(list);   
                    offercount.html( res.offers.length );
                }else{
                    $("#offer-list .row").append(list);    
                    offercount.html( parseInt( offercount.text() ) + res.offers.length );
                }   

                var totalcount = $("input[name='totalcount']").val();
                
                $("#offer_loadmore").parent().removeClass('hide');
                
                if( parseInt(offercount.text()) >= res.total_count ){
                    $("#offer_loadmore").parent().addClass('hide');                    
                }                

            }
        });

    }

    $("#bids a.nav-link").click(function(){
        $($("#bids a.nav-link")).removeClass('active');
        $("#bids .bid").removeClass("open");
        $(this).find(".bid").addClass("open");
    });

    $(".more_dropdown a").click(function(){
        $(this).find("i").toggle();
        $(this).parent().find("div").toggle();
    });
    if( $(".text-wrapper textarea").length>0){
        $(".text-wrapper textarea").each(function(index, element){
            $(element).parent().find('.char-counter span').eq(0).text($(element).val().length);
            var text_length = $(element).attr('maxlength');
            $(element).parent().find('.char-counter span').eq(1).text(parseInt( text_length ) - $(element).val().length);
        });
    }
    $(".text-wrapper textarea").keyup(function(){
        var text = $(this).val();
        
        $(this).parent().find('.char-counter span').eq(0).text(text.length);
        var text_length = $(this).attr('maxlength');
        $(this).parent().find('.char-counter span').eq(1).text(parseInt( text_length ) - text.length);
    });

    // $("#community_box").change(function(){
    //     $("#community_title i").attr("data-original-title", $(this).find("option:selected").attr("tooltip-text"));
    // });
    $("#community_title i").hover(function(){
        $('#'+$(this).attr('aria-describedby')+' .tooltip-inner').html($('.tooltip-text').html());
        $('#'+$(this).attr('aria-describedby')+' .tooltip-inner').css('min-width', '600px');
    });

    function product_period(){
        $('.period .period_select').hide();
        $("input[name='period']:checked").parent().parent().find('.period_select').show();
    }

    $("input[name='period']").change(function(){
        product_period();
    });

    product_period();

    function product_format(){
        $('.stream_detail').hide();
        $("input[name='format']:checked").parent().parent().find('.stream_detail').show();
    }

    $("input[name='format']").change(function(){
        product_format();
    });
    product_format();

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
        var modal;
        if($(this).attr('data-type')=='offer') modal = $("#unpublishOfferModal");
        else if($(this).attr('data-type')=='product') modal = $("#unpublishProductModal");
        $(modal).find("input[name='data_type']").val($(this).attr('data-type'));
        $(modal).find("input[name='data_id']").val($(this).attr('data-id'));
    });
    $("#unpublishOfferModal button.unpublish").click(function(e){
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
    $("#unpublishProductModal button.unpublish").click(function(e){
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
        filter_dataoffer($("#offer-list .card").length);
    });

    $('#inviteModal .more_email').click(function(e){
        e.preventDefault();
        var emails_number = $(".email_lists label").length;
        var input_field = '<label class="pure-material-textfield-outlined">'+
                                '<input type="email" id="email'+(emails_number+1)+'" name="linked_email[]" class="form-control2 input_data" placeholder=" "  value="">'+
                                '<span>Email '+(emails_number+1)+'</span>'+
                                '<div class="error_notice">Email format is incorrect.</div>'+
                           '</label>';
            
        $(".email_lists").append(input_field);        
    });

    $('a[data-target="#deleteModal"]').click(function(){        
        $('#deleteModal').find("input[name='list_userIdx']").val( $(this).attr('user-id') );
        if( $(this).parent().parent().hasClass('invited') ){
            $('#deleteModal').find("input[name='user_type']").val( 'pendding' );
        }else{
            $('#deleteModal').find("input[name='user_type']").val( 'registered' );
        }
    });

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }

    $('#inviteModal .invite').click(function(e){
        var flag = false;
        var flag_a = false;
        $.each($('#inviteModal').find('input[type="email"]'), function(index, elem){
            if($(elem).val()!=""){
                $("#inviteModal .email_lists>.error_notice").hide();
                if(isEmail($(elem).val()) == false){
                    $(elem).parent().find(".error_notice").show();                    
                    flag = false;                     
                }else{
                    $(elem).parent().find(".error_notice").hide();                                    
                    flag = true; 
                }  
                flag_a = true;                                    
            }            
        });
        if(flag_a==false){
            $("#inviteModal .email_lists>.error_notice").show();
        }
        $(this).html("Inviting");
        if(flag){            
            $.ajax({
                type: "post",
                url : '/invite',
                data : $("#inviteModal form").serialize(),
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if(res.success == true){
                        $("#inviteModal .invalid-feedback").css('display', 'block');
                        $("#inviteModal .invite").html("Invite");
                        //window.location.reload();    
                    }
                }
            });
        }    
    });

    $('#deleteModal .confirm').click(function(e){
        var user_id = $("#deleteModal").find("input[name='list_userIdx']").val();     
        var type = $("#deleteModal").find("input[name='user_type']").val();        

        if(user_id){
            $.ajax({
                type: "post",
                url : '/user/delete',
                data : {user_id: user_id, _token:$("#deleteModal").find('input[name="_token"]').val(), type: type},
                dataType: 'json',
                success: function(res){
                    if(res.success == true){
                        window.location.reload();    
                    }
                }
            });
        }    
    });
    $('#buy-data').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var id=$('#offerIdx').val();
        var pid=$('#productIdx').val();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback strong').html("");
        $.ajax({
            url: '/data/buy/'+id+'/'+pid,
            method: 'post',
            data: $(this).serialize(),
            success: function(response){
                if(response.success == true){
                    if(response.redirect !== undefined){
                        window.location.href = response.redirect;
                    }else{
                        if(!form.data('cc-on-file')){
                            Stripe.setPublishableKey(form.data('stripe-publishable-key'));
                            try{
                                Stripe.createToken({
                                    number: $('#card_number').val(),
                                    cvc: $('#cvc').val(),
                                    exp_month: $('#exp_month').val(),
                                    exp_year: $('#exp_year').val()
                                }, stripeResponseHandler);
                            }catch(e){
                                console.log(e);
                            }
                        }
                    }
                }else{
                    if(response.result !==undefined){
                        result = response.result;
                        $.each(result, function(field,messages){
                            $("#"+field).addClass('is-invalid');
                            $('.invalid-feedback.'+field+" strong").html(messages[0]);
                        });
                    }
                    if(response.redirect !== undefined){
                        window.location.href = response.redirect;
                    }
                }      
            }
        })
    });
    function stripeResponseHandler(status, response){
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            $('.error').addClass('hide');
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $('#buy-data').find('input[type=text]').empty();
            $('#buy-data').append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $('#buy-data').get(0).submit();
        }
    }
    console.log($('.note-video-clip').html());
    $('.note-video-clip').contents().find('.ytp-cued-thumbnail-overlay').hover(function(){
        let _this = $(this);
    })
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
$("#copyToClipboard").click(function(){
    console.log("clicked");
    var copyText = $("#uniqueId").html();
    console.log(copyText);
    copyTextToClipboard(copyText);
});
function copyTextToClipboard(text) {
    var textArea = document.createElement( "textarea" );
    textArea.value = text;
    document.body.appendChild( textArea );
    textArea.select();
    try {
        var successful = document.execCommand( 'copy' );
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }
    document.body.removeChild( textArea );
}
var navbar_menu_visible = 0;
$(document).on('click', '.navbar-toggler', function() {
    $toggle = $(this);
  
    if (navbar_menu_visible == 1) {
      $('html').removeClass('nav-open');
      navbar_menu_visible = 0;
      $('#bodyClick').remove();
      setTimeout(function() {
        $toggle.removeClass('toggled');
      }, 150);
  
      $('html').removeClass('nav-open-absolute');
    } else {
      setTimeout(function() {
        $toggle.addClass('toggled');
      }, 180);
  
  
      div = '<div id="bodyClick" style="display:none"></div>';
      $(div).appendTo("body").click(function() {
        $('html').removeClass('nav-open');
  
        if ($('nav').hasClass('navbar-absolute')) {
          $('html').removeClass('nav-open-absolute');
        }
        navbar_menu_visible = 0;
        $('#bodyClick').remove();
        setTimeout(function() {
          $toggle.removeClass('toggled');
        }, 150);
      });
  
      if ($('nav').hasClass('navbar-absolute')) {
        $('html').addClass('nav-open-absolute');
      }
  
      $('html').addClass('nav-open');
      navbar_menu_visible = 1;
    }
  });