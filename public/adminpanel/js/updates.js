var board_data_table;

(function($) {

    // Initialize datatable with ability to add rows dynamically
    var initTableWithDynamicRows = function() {
        var table = $('#board_table');

        var settings = {
            responsive: true,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Display _MENU_',
            },

            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `<img src="`+data+`" style="height: 40px;">`;
                    },
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                      var publish_icon = `<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" onclick="publish_record('`+data+`');" title="Publish">
                            <i class="la la-thumbs-up"></i>
                            </a>`;
                      if(full[6]=="Published")
                        publish_icon = `<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" onclick="publish_record('`+data+`');" title="Unpublish">
                            <i class="la la-thumbs-down"></i>
                            </a>`;
                        return publish_icon + `
                            <a href="/admin/updates/edit/` + data + `" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                            <i class="la la-edit"></i>
                            </a>
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" onclick="attach_record('`+data+`');"><i class="la la-image" title="Upload Image"></i>
                            </a>
                            <a href="#" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="wantDelete('`+data+`');"><i class="la la-trash" title="Delete"></i>
                            </a>`;
                    },
                },
            ],
        };

        board_data_table = table.dataTable(settings);
    }

    initTableWithDynamicRows();

})(window.jQuery);

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

var attach_record_idx;

function publish_record(record_idx){
  $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/admin/updates/publish',
    data: {articleIdx: record_idx},
    method: 'post',
    success: function(res){
      if(res=="success"){
        window.location.href="/admin/updates";
      }
    }
  });
}

function attach_record(record_idx) {
    attach_record_idx = record_idx;
    $("#upload_attach").click();
}
function wantDelete(record_idx){
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/updates/delete/'+record_idx,
        method: 'post',
        success: function(res){
          if(res=="success"){
            window.location.href="/admin/updates";
          }
        }
      });
    }else 
      swal("Cancelled", "Action has cancelled", "error");
  });
}

transferComplete = function(e) {
    window.location.reload(true);
}

$("#upload_attach").change(function(event){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    var file = event.target.files[0];       
    var data = new FormData();
    data.append("uploadedFile", file);

    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/usecases/upload_attach/" + attach_record_idx,
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success:function(response) {
                if(response == "true")
                {
                    transferComplete();
                }
                else
                {
                    window.alert("Net Work Error");
                }
        }
   });
});
