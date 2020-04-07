$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$( "#board_form" ).validate({
	    // define validation rules
	    rules: {
	        featured_data_title: {
	            required: true,
	        },
	        featured_data_content: {
	            required: true,
	            minlength: 20 
			},
            featured_data_provider: {
                required: true,
            }
	    },
	    //display error alert on form submit  
	    invalidHandler: function(event, validator) {     
	        var alert = $('#m_form_1_msg');
	        alert.removeClass('m--hide').show();
	        mUtil.scrollTop();
	        setTimeout(function(){
	        	$('#m_form_1_msg').addClass('m--hide').hide();
	        }, 5000);
	    },
	    submitHandler: function (form) {
	    	$.ajax(
                    {
                        url: "/admin/home_featured_data/update", 
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        data: $("#board_form").serialize(),
                        success: function (result) 
                                {   
                                    if(result == "success")
                                    {
                                        window.location.href = "/admin/home_featured_data";
                                    }
                                    
                                },
                        error: function (msg) 
                                {
                                    console.log('error', msg);
                                    window.alert("Network Error!", "Please Match the Date format as like 2000-01-31");
                                }
                    }
                );
	    }
	});  
	$(".summernote").summernote({height: 500,linkTargetBlank: true});
});