<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Indie Pattern Finder</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Materialize -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
                width: 75%;
            }

            .title {
                font-size: 64px;
                line-height: 55px;
                margin-bottom: 20px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            #search_bar {
                width: 50%;
                margin-bottom: 20px;
            }

            input {
                margin-top: 20px;
                height: 42px;
            }

            input[type="text"] {
                font-size: 20px;
                padding-left: 18px;
            }

            .text-center {
                display: block;
                margin: 0 auto;
            }

            button {
                border-radius: 0;
                color: dimgrey !important;
                font-weight: bold;
                margin-top: 15px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">

                <div class="title m-b-md">
                    Indie <br>Pattern <br>Finder
                </div>

                <form action="{{ action('PatternController@search') }}" method="get" >

                    <input type="text" name="query" id="search_bar" class="browser-default"/>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary grey lighten-2">Search</button>
                    </div>

                </form>

            </div>
        </div>

        <!-- Materialize JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    </body>
</html>
