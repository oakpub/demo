<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap Table!</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <table data-toggle="table" class="table" id="table"></table>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-table/locale/bootstrap-table-ru-RU.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#table').bootstrapTable({
        url: '/demo/table',
        method:"POST",
        filterControl: true,
        pagination: true,
        columns: [{
            field: 'id',
            title: 'Item ID',
            sortable: true,
        }, {
            field: 'name',
            title: 'Item Name',
            sortable: true,
            filterControl: 'input',
        }, {
            field: 'price',
            title: 'Item Price',
            sortable: true,
            filterControl: 'select',
        }],
        /*data: [{
            id: 1,
            name: 'Item 1',
            price: '$1'
        }, {
            id: 2,
            name: 'Item 2',
            price: '$2'
        }]*/
    })

    /*$.ajax({
        url: '/demo/table',
        type: 'post',
        dataType: 'json',
        success: function(data) {
            $('#table').bootstrapTable({
                data: data
            });
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });*/
</script>
</body>
</html>