<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tablesorter</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/tablesorter/css/theme.blue.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <table id="table" class="table tablesorter">
        <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Due</th>
            <th>Web Site</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Smith</td>
            <td>John</td>
            <td>jsmith@gmail.com</td>
            <td>$50.00</td>
            <td>http://www.jsmith.com</td>
        </tr>
        <tr>
            <td>Bach</td>
            <td>Frank</td>
            <td>fbach@yahoo.com</td>
            <td>$50.00</td>
            <td>http://www.frank.com</td>
        </tr>
        <tr>
            <td>Doe</td>
            <td>Jason</td>
            <td>jdoe@hotmail.com</td>
            <td>$100.00</td>
            <td>http://www.jdoe.com</td>
        </tr>
        <tr>
            <td>Conway</td>
            <td>Tim</td>
            <td>tconway@earthlink.net</td>
            <td>$50.00</td>
            <td>http://www.timconway.com</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>1</th> <!-- tfoot text will be updated at the same time as the thead -->
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
        </tr>
        <tr>
            <td class="pager" colspan="5">
                <img src="../addons/pager/icons/first.png" class="first"/>
                <img src="../addons/pager/icons/prev.png" class="prev"/>
                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                <img src="../addons/pager/icons/next.png" class="next"/>
                <img src="../addons/pager/icons/last.png" class="last"/>
                <select class="pagesize">
                    <option value="25">25</option>
                </select>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/tablesorter/js/jquery.tablesorter.js') }}"></script>
<script src="{{ asset('js/tablesorter/js/jquery.tablesorter.widgets.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#table").tablesorter({
        theme: 'blue',
        widgets: ['zebra', 'filter'],
    });
</script>
</body>
</html>