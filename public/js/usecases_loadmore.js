$(document).on('click','#btn-more',function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    var published = $(this).data('id');
    $('#btn-more').html('Loading....');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url: '/about/usecases/usecases_loadmore',
        type: 'POST',
        data: {published: published},
        success: function (data)
        {
            if(data!="")
            {
                $('#remove-row').remove();
                $('#load-data').append(data);
            }
            else
            {
                $('#btn-more').html('No Articles');
            }
        },
        error: function (data)
        {
            console.log(data);
            window.alert('net work error!');
        }
    });
});