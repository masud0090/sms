<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Laravel Vue JS with Rest API</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
{{--    for Datatable--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
        .bg-light {
            background-color: #eae9e9 !important;
        }
    </style>
</head>
<body>

<div id="app">
</div>


<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
{{--for Datatable--}}
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#datatable').DataTable();--}}
{{--    } );--}}
{{--</script>--}}
</body>
</html>
