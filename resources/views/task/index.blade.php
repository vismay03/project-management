@extends('welcome')

@section('content')

<a href="{{ route('projects.create') }}" type="button" class="btn btn-primary mb-3">Create</a>


<div id="change">

    @include('projects.table')
</div>

@endsection


@section('javascript')

<script>
    $('#show .action').on('click', 'button', function() {
        
    Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
        method: 'DELETE',
        url: $(this).attr('href'),
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
        
   


        
        if (response.code == 200) {

     
        
        Toastify({
        text: `${response.message}`,
        className: "success",
        position: "center",
        }).showToast();
        
        show(1);
        }
        },
        error: function(error) {
        $('#deleteRecordModal ,.modal-backdrop').removeClass('show').css('display', 'none')
        $('body').css('overflow-y', 'scroll')
        
        Toastify({
        text: `Error! An error occurred. Try again`,
        className: "danger",
        position: "center",
        }).showToast();
        }
        });
    // Swal.fire({
    // title: "Deleted!",
    // text: "Your file has been deleted.",
    // icon: "success"
    // });
    }
    });
});



function show(page) {


$.ajax({
method: 'get',
url: "{{ url('/projects?page=') }}" + page

,
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

success: function(data) {



$('#change').html(data);


},
error: function(error) {
console.log(error.responseText);
}
});
}

</script>

@endsection