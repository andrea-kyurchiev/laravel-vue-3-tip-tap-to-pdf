<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<div>
    <h1 class="text-center">{{$request->heading}}</h1>
    {!! html_entity_decode($request->richtext) !!}
</div>

<style lang="scss">
    .page-break {
        page-break-after: always;
    }

    .text-right {
        text-align: right;
    }

    table {
        border-collapse: separate;
        table-layout: fixed;
        width: 100%;
        margin: 0;
        overflow: hidden;
    td {
        width: attr(colwidth px);
        min-width: 1em;
        padding: 3px 5px;
        vertical-align: top;
        box-sizing: border-box;
        position: relative;

    > * {
        margin-bottom: 0;
    }
    }

    th {
        font-weight: bold;
        text-align: left;
        background-color: #f1f3f5;
    }

    .selectedCell:after {
        z-index: 2;
        position: absolute;
        content: "";
        left: 0; right: 0; top: 0; bottom: 0;
        background: rgba(200, 200, 255, 0.4);
        pointer-events: none;
    }

    .column-resize-handle {
        position: absolute;
        right: -2px;
        top: 0;
        bottom: -2px;
        width: 4px;
        background-color: #adf;
        pointer-events: none;
    }
    }

    .tableWrapper {
        padding: 1rem 0;
        overflow-x: auto;
    }

    td {
        border: 0.25px solid #505050!important;
    }
</style>

</body>
</html>
