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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
            margin: 0 auto;
        }

        .title {
            font-size: 2.5vw;
            line-height: 25px;
            padding-top: 20px;
            margin-left: 20px;
        }

        .form {
            display: inline-block;
        }

        .inline-block {
            display: inline-block;
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
            padding-bottom: 20px;
            box-shadow: 3px 3px 3px -3px gray;
            border: 1px solid lightgray;
        }

        input {
            height: 35px;
            padding: 20px;
        }

        input[type="text"] {
            font-size: 20px;
            padding-left: 18px;
        }

        #search-button {
            border-radius: 0;
            background-color: #E8E8E8 !important;
            color: dimgray;
            font-weight: bold;
            margin: 20px;
            width: 80px;
            height: 35px;
            border: none;
        }

        header {
            background-color: #F8F8F8;
        }

        .pattern-grid {
            width:100%;
            padding: 10px 10px 0 10px;
            margin: 0;
            list-style: none;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-flow: row wrap;
            flex-flow: row wrap;
            -webkit-justify-content: flex-start;
            justify-content: flex-start;
        }

        .pattern {
            -webkit-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 25%;
            padding: 0.04%;
            position: relative;
        }

        .pattern-container {
            padding:10px;
            text-align: center;
        }

        .pattern-img {
            max-width:100%;
            vertical-align:bottom;
        }

        .pattern-label {
            font-size: 1.2vw;
            border-style: none;
            background-color: #E8E8E8;
            margin:8% 0 0;
            z-index: 1;
            opacity: 0.85;
            color: black;
            position: absolute;
            width: 70%;
            top: 65%;
            left: 15%;
        }

        a#home-link {
            text-decoration: none;
            color: inherit;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <header class="row">

        <div class="title m-b-md inline-block col-3">
            <a href="/" id="home-link">
            Indie Pattern Finder
            </a>
        </div>

        <form action="{{ action('PatternController@search') }}" method="get" class="form col-8">

            <input type="text" name="query" id="search_bar" class="inline-block"/>

            <div class="text-center inline-block">
                <button type="submit" id="search-button">Search</button>
            </div>
        </form>
    </header>

    <div class="content">
        <ul class="pattern-grid">
            @foreach($patterns as $key => $value)
                <li class="pattern">
                    <div class="pattern-container">
                        <a class="btn" href="{{ URL::to($value->redirect_url) }}">
                            <img src="{{ $value->image_url }}" class="pattern-img">
                        </a>

                            <button class="pattern-label"><strong>Designer #{{ $value->company_id }} </strong>
                                <br> {{ $value->name }}<br> {{ $value->price }}</button>

                    </div>
                </li>
            @endforeach
        </ul>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
        integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
        crossorigin="anonymous"></script>

</body>
</html>
