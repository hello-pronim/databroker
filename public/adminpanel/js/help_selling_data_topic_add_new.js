$(function(){
    var faqIdx = $('#faqIdx').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( "#board_form" ).validate({
        // define validation rules
        rules: {
            title: {
                required: true,
            },
            meta_title: {
                required: true,
            },
            meta_description: {
                required: true,
            },
            description: {
                minlength: 20 
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
                        url: "/admin/help/selling_data/topic/update", 
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        data: $("#board_form").serialize(),
                        success: function (result) 
                                {   
                                    if(result == "success")
                                    {
                                        window.location.href = "/admin/help/selling_data/topics";
                                    }
                                },
                        error: function (msg) 
                                {
                                    console.log('error', msg);
                                    window.alert("Network Error!");
                                }
                    }
                );
        }
    });  
    $(".summernote").summernote({
        height: 600,
        linkTargetBlank: true,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
});