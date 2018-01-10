<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Indie Pattern Finder</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

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
                box-shadow: 3px 3px 3px -3px gray;
                border: 1px solid lightgray;
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
                background-color: #E8E8E8 !important;
                color: dimgray;
                font-weight: bold;
                margin-top: 10px;
                width: 130px;
                height: 35px;
                border: none;
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
                        <button type="submit" class="">Search</button>
                    </div>

                </form>

            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    </body>
</html>
