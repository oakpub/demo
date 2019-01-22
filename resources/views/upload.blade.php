<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Upload</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    @if ($started)
        <p>Записей: {{ $rows }} </p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="upload_progressbar">0%</div>
        </div>
    @else
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" name="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Загрузить</button>
        </form>
    @endif
</div>



<script src="{{ asset('js/app.js') }}"></script>
@if ($started)
    <script>
        var limit = 100,
            total_rows = {{ $rows }},
            file = '{{ $file }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        upload(0);

        function upload(start_row) {
            $.ajax({
                url: '/demo/',
                type: "POST",
                method: "POST",
                dataType: 'json',
                data: {file: file, offset: start_row+1, limit: limit, "_token": "{{ csrf_token() }}"},
                //headers: {'X-CSRF-Token': @csrf},
                success: function(data) {
                    if (data.result == 'ok') {
                        var percent = data.percent,
                            last_row = data.row,
                            next_row = last_row + limit;

                        $('#upload_progressbar').text(percent + '%');
                        $('#upload_progressbar').css('width', percent + '%');

                        if (total_rows > last_row) {
                            upload(next_row);
                        } else {
                            alert('Готово!');
                        }
                    } else {
                        alert('Ошибка');
                    }
                }
            })
        }
    </script>
@endif
</body>
</html>