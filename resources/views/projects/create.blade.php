@extends('welcome')


@section('content')
<a href="{{ route('projects.index') }}" type="button" class="btn btn-primary mb-3">View</a>
<div class="">
    <form id="form" enctype="multipart/form-data">
        <div class="mb-3">
            @csrf
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name"   class="form-control" id="exampleFormControlInput1"
                placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="date" name="start_date" class="form-label" id="exampleCheck1">
        </div>
        <div class="mb-3 form-check">
            <input type="file" multiple name="attachments[]" class="form-label" id="exampleCheck1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection


@section('javascript')
<script>
    $('#form').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById('form'));
        $.ajax({
        type: 'POST',
        url: "{{ route('projects.store') }}",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: function(response) {
        console.log(response);
        if (response.code == 200) {
       Toastify({
        text: `${response.message}`,
        className: "success",
        position: "center",
        }).showToast();

        setTimeout(() => {
            window.location.reload()
        }, 2000)

        }
        },
        error: function(error) {
        console.log(error.responseText);
        }
        });
        });
</script>
@endsection
