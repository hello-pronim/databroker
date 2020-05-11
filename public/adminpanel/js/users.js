var admin_table;

(function($) {

    // Initialize datatable with ability to add rows dynamically
    var initTableWithDynamicRows = function() {
        var table = $('#admin_users');

        var settings = {
            responsive: true,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Display _MENU_',
            },

            order: [[2, 'asc']],

            columnDefs: [
                {
                  targets: 0,
                  orderable: false
                },
                {
                  targets: 1,
                  orderable: false
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                            <a href="/admin/users/edit/`+data+`" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                            <i class="la la-edit"></i>
                            </a>
                            <a href="#" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="wantDelete('`+data+`');"><i class="la la-trash" title="Delete"></i>
                            </a>`;
                    },
                },
            ],
        };

        admin_table = table.DataTable(settings);
    }

    initTableWithDynamicRows();

    $("#admin_users tbody").on("click", "td.details-control", function () {
        var tr = $(this).closest("tr");
        var row = admin_table.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass("shown");
            tr.find("td:eq(1)").html("<h4>+</h4>");
        } else {
          if(row.data()[0]!=0){
            row.child( getCompanyUsers(row.data()), 'table-child no-padding no-borders').show();
            tr.find("td:eq(1)").html("<h4>-</h4>");
            tr.addClass("shown");
          }
        }
    });
    function getCompanyUsers(adminInfo) {
      console.log(adminInfo);
        var container = $('<div class="outlier-table-text-overlap"/>').addClass("loading").text("Loading...");
        var url = "/admin/company_users/" + adminInfo[2];
        $.ajax({
            url: url,
            dataType: "json",
            success: function (res) {
                var child_table = "";
                child_table = "<thead>" + 
                                "<tr>" +
                                  "<th>User ID</th>" +
                                  "<th>Date Registered</th>" +
                                  "<th>Industry</th>" +
                                  "<th>Email</th>" +
                                  "<th>First Name</th>" +
                                  "<th>Last Name</th>" +  
                                  "<th>Job Title</th>" +
                                  "<th>Role</th>" +  
                                  "<th>Products</th>" +
                                  "<th>Actions</th>" +
                                "</tr>" + 
                              "</thead>";
                child_table += "<tbody>";
                for(var i=0; i<res.users.length; i++){
                  var user = res.users[i];
                  var tmp = "<tr>" + 
                                '<td class="text-nowrap">' + user.userIdx + "</td>" + 
                                '<td class="text-nowrap">' + moment(user.createdAt).format('DD/MM/YYYY') + "</td>" + 
                                '<td class="text-nowrap">' + user.businessName + "</td>" + 
                                '<td class="text-nowrap">' + user.email + "</td>" + 
                                '<td class="text-nowrap">' + user.firstname + "</td>" + 
                                '<td class="text-nowrap">' + user.lastname + "</td>" + 
                                '<td class="text-nowrap">' + (user.jobTitle ? user.jobTitle : "N/A") + "</td>" + 
                                '<td class="text-nowrap">' + user.role + "</td>" + 
                                '<td class="text-nowrap">' + user.count_products + "</td>" + 
                                '<td class="text-nowrap">' + user.userIdx + "</td>" + 
                              "</tr>";
                  child_table += tmp;
                }
                container.removeClass("loading");
                $('#admin_users .border-primary').removeClass('border-primary');
                container.html("<h4 class='table-child-title'>"+ adminInfo[4] +" invited users</h4><table id='dtRow' class='datatable table table-bordered no-margins outlierSubTable'>" + child_table + "</table>").addClass('border-primary');
                try {
                    $("#dtRow").DataTable({
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
                                    return `
                                        <a href="/admin/users/edit/`+data+`" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                                        <i class="la la-edit"></i>
                                        </a>
                                        <a href="#" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="wantDelete('`+data+`');"><i class="la la-trash" title="Delete"></i>
                                        </a>`;
                                },
                            },
                        ],
                    });
                } catch (g) {
                    console.log(g);
                }
            },
            error: function(err) {
              if ( err.status === 403 ) {
                container.html('<div style="height: 50px; position: relative;"><h4 class="unauthorized" id="unauthorized" style="">You are unauthorized to view the Data Preview</h4></div>');
              }
            }
        });
        return container;
    }
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
        url: '/admin/users/delete/'+record_idx,
        method: 'post',
        success: function(res){
          if(res=="success"){
            window.location.href="/admin/users";
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