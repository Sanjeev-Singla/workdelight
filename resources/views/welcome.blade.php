<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <form method="post" id="upload-image-form" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="image-input">
            <button type="submit" class="btn btn-success">Upload</button>
    </form>

    <span class="text-danger" id="image-input-error"></span>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


    <script>
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#upload-image-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#image-input-error').text('');
            // return console.log($('meta[name="csrf-token"]').attr('content'));
            $('#image-input-error').text('');

                $.ajax({
                    type:'POST',
                    url: `{{ url("/api/upload") }}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:   function(response) {
                        if (response) {
                            //this.reset();
                            alert('Image has been uploaded successfully');
                            location.reload();
                        }
                    },
                    error: function(response){
                        console.log(response);
                         $('#image-input-error').text(response.responseJSON.errors.file);
                    }
                });
            });
        });
    </script>

</body>
</html>