<!DOCTYPE html>
<html>
    <head>
        <title>Yoursport</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="/css/app.css" media="screen" title="no title" charset="utf-8">

        <style>
            html, body {
                height: 100%;
                color: black;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            a {
                color: black;
                text-decoration: none;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <ul>
                    <li><a href="{{ route('admin::dashboard') }}">Admin-Dashboard</a></li>
                    <li><a href="#">other stuff</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
