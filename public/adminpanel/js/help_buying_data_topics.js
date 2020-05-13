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
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var publish_icon = `<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" onclick="publish_record('`+data+`');" title="Publish">
                            <i class="la la-thumbs-up"></i>
                            </a>`;
                        if(full[3]=="Published")
                            publish_icon = `<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" onclick="publish_record('`+data+`');" title="Unpublish">
                                <i class="la la-thumbs-down"></i>
                                </a>`;
                        return publish_icon + `
                            <a href="/admin/help/buying_data/topic/edit/` + data + `" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                            <i class="la la-edit"></i>
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

function publish_record(record_idx){
  $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/admin/help/buying_data/topic/publish',
    data: {helpTopicIdx: record_idx},
    method: 'post',
    success: function(res){
      if(res=="success"){
        window.location.href="/admin/help/buying_data/topics";
      }
    }
  });
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
        url: '/admin/help/buying_data/topic/delete/'+record_idx,
        method: 'get',
        success: function(res){
          if(res=="success"){
            window.location.href="/admin/help/buying_data/topics";
          }
        }
      });
    }else 
      swal("Cancelled", "Action has cancelled", "error");
  });
}