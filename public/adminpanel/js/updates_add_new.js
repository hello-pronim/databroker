$(function(){
	$('input[name="published"]').datepicker({ 
		format: "dd/mm/yyyy"
	});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$( "#board_form" ).validate({
	    // define validation rules
	    rules: {
	        articleTitle: {
	            required: true,
	        },
	        articleContent: {
	            required: true,
	            minlength: 20 
			},
            category: {
                required: true,
            },
			meta_title: {
				required: true,
			},
			meta_desc: {
				required: true,
			},
			published: {
				required: true,
            },
            author: {
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
                        url: "/admin/updates/update", 
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        data: $("#board_form").serialize(),
                        success: function (result) 
                                {   
                                    if(result == "success")
                                    {
                                        window.location.href = "/admin/updates";
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
    var btnAttch = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents:
            '<label class="custom-file-upload mb-0 lh-1"> <input type="file" class="input-file hidden" id="input-file" multiple/>' +
            '<i class="la la-paperclip"></i> </label>',
            container: false,
            tooltip: 'Attach file',
            click: function(){
                $('.summernote').summernote('editor.saveRange');
            }
         });
        return button.render();
    }

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
          ['btnAttch', ['btnAttch']]
        ],
        buttons: {
            btnAttch: btnAttch
        },
        disableDragAndDrop: true,
        disableResizeEditor: true,
        callbacks: {
            onInit: function () {
            },
        }
    });

    var files;
    $("#input-file").change(function(e){
        var form_data = new FormData();

        // Read selected files
        var totalfiles = e.target.files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", e.target.files[index]);
        }
        // AJAX request
        $.ajax({
            url: '/admin/updates/summernote/upload_attach', 
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.success){
                    var names = response.result;
                    var domain = window.location.protocol + window.location.host;
                    var node = document.createElement('span');
                    node.classList.add("attach-files");
                    node.innerHTML = "";
                    for(var i=0; i<names.length; i++)
                    {
                        node.innerHTML += "<a href='/adminpanel/uploads/updates/"+names[i]+"' target='_blank' download='"+names[i]+"'>"+
                                            "<i class='material-icons'>get_app</i>" + 
                                            "<span class='ml-10'>"+names[i]+"</span>"+
                                           "</a><br/>";
                    }
                    range = $(".summernote").summernote('restoreRange');
                    $('.summernote').summernote('editor.restoreRange');
                    $('.summernote').summernote('editor.focus');
                    $('.summernote').summernote('editor.insertNode', node);
                }
            }
        });
    })
});