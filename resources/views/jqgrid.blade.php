<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jqGrid</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('js/jqgrid/css/ui.jqgrid-bootstrap4.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <table id="table" class="table"></table>
    <div id="pager"></div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jqgrid/js/i18n/grid.locale-ru.js') }}"></script>
<script src="{{ asset('js/jqgrid/js/jquery.jqGrid.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#table").jqGrid({
        url: "/demo/jqgrid",
        datatype: "json",
        mtype: "post",
        colNames: ["ID", "Name", "Price"],
        colModel: [
            { name: "id"},
            { name: "name" },
            { name: "price", align: "right" },
        ],
        pager: "#pager",
        rowNum: 10,
        rowList: [10, 20, 30],
        sortname: "id",
        sortorder: "asc",
        viewrecords: true,
        gridview: true,
        autoencode: true,
        caption: "Table",
        autowidth: true,
        height: 'auto',
        styleUI : 'Bootstrap',
    });//.navGrid(pager, { edit: false, add: false, del: false, refresh: true, search: false });
</script>
</body>
</html>