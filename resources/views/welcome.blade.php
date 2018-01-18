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


        /* --------------- Default: EXTRA SMALL devices (portrait phones, less than 576px) ---------------- */

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

        .form {
            display: inline-block;
        }

        .inline-block {
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

        header {
            background-color: #F8F8F8;
            display: flex;
            flex-wrap: wrap;
        }

        .title {
            font-size: 7vw;
            padding-top: 10px;
            width: 100%;
            position: relative;
            text-align: center;
        }

        #query {
            margin-top: 15px;
            padding-bottom: 20px;
            box-shadow: 3px 3px 3px -3px gray;
            border: 1px solid lightgray;
            width: 100%;
        }

        input {
            height: 50px;
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
            margin-top: 5px;
            width: 100%;
            height: 45px;
        }

        .pattern-grid {
            width: 100%;
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
            width: 100%;
            padding: 0.04%;
            position: relative;
        }

        .pattern-container {
            padding: 10px;
            text-align: center;
        }

        .pattern-img {
            max-width: 100%;
            vertical-align: bottom;
        }

        .pattern-label {
            font-size: 4vw;
            border-style: none;
            background-color: #E8E8E8;
            margin: 8% 0 0;
            z-index: 1;
            opacity: 0.85;
            color: black;
            position: absolute;
            width: 70%;
            height: 20%;
            top: 65%;
            left: 15%;
        }

        .pattern-name {
            font-size: 3.6vw;
        }

        #home-link {
            text-decoration: none;
            color: inherit;
        }

        .no-result-container {
            text-align: center;
            position: relative;
        }

        .no-result-message {
            width: 100%;
            padding: 10px;
        }

        .pattern-container-pauline-1 {
            text-align: center;
            overflow: hidden;
            margin: 1.8vw 0 0 -2.6vw;
            width: 95vw;
        }

        .pattern-img-pauline-1 {
            object-fit: cover;
            height: 150vw;
            margin: -5vw 0 0 -17vw;

        }

        .pattern-container-pauline-2 {
            text-align: center;
            overflow: hidden;
            margin: -0.8vw 0 -34px -8vw;
            width: 100vw;
        }

        .pattern-img-pauline-2 {
            object-fit: cover;
            height: 181vw;
            margin: -6vw 0 0 -23vw;
        }

        .pattern-container-pauline-3 {
            text-align: center;
            overflow: hidden;
            margin: 5.2vw 0 -34px 4vw;
            width: 88.5vw;
        }

        .pattern-img-pauline-3 {
            object-fit: cover;
            height: 178vw;
            margin: -3vw 0 0 -36vw;
        }

        .pattern-container-pauline-4 {
            text-align: center;
            overflow: hidden;
            margin: 4.2vw 0 9px -1vw;
            width: 93vw;
        }

        .pattern-img-pauline-4 {
            object-fit: cover;
            height: 181vw;
            margin: -6vw 0 0 -23vw;
        }


        /* --------------------  SMALL devices (landscape phones, 576px and up) ------------------------ */
        @media (min-width: 576px) {
            .pattern {
                width: 50%;
            }

            .pattern-label {
                font-size: 2.4vw;
            }

            .pattern-name {
                font-size: 2.2vw;
            }

            .title {
                font-size: 2.5vw;
                line-height: 25px;
                padding-top: 20px;
                margin-left: 20px;
            }

            .inline-block {
                display: inline-block;
            }

            #query {
                width: unset;
            }

            input {
                height: 35px;
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
        }

        /* ------------------- MEDIUM devices (tablets, 768px and up) ---------------------------------- */
        @media (min-width: 768px) {
            .pattern-label {
                font-size: 2vw;
            }

            .pattern-name {
                font-size: 1.8vw;
            }

            .pattern-container-pauline-1 {
                margin: -0.4vw 0 0 2.4vw;
                text-align: center;
                width: 44.2vw;
                height: 62.75vw;
                overflow: hidden;
            }

            .pattern-img-pauline-1 {
                object-fit: cover;
                height: 73vw;
                margin: -3vw 0 0 -15vw;
            }

            .pattern-container-pauline-2 {
                margin: 2vw 0 0 -0.6vw;
                text-align: center;
                width: 51vw;
                height: 62.8vw;
                overflow: hidden;
            }

            .pattern-img-pauline-2 {
                object-fit: cover;
                height: 75.5vw;
                margin: -6vw 0 0 -12vw;
            }

            .pattern-container-pauline-3 {
                margin: 1.8vw 0 0 2.3vw;
                text-align: center;
                width: 44.3vw;
                height: 63vw;
                overflow: hidden;
            }

            .pattern-img-pauline-3 {
                object-fit: cover;
                height: 71vw;
                margin: -4vw 0 0 -13vw;
            }

            .pattern-container-pauline-4 {
                margin: 1.9vw 0 0 1.4vw;
                text-align: center;
                width: 45.2vw;
                height: 63vw;
                overflow: hidden;
            }

            .pattern-img-pauline-4 {
                object-fit: cover;
                height: 74vw;
                margin: -12vw 0 0 -11vw;
            }
        }

        /*  ------------------ LARGE devices (desktops, 992px and up) ----------------------------------  */
        @media (min-width: 992px) {
            .pattern {
                width: 33%;
            }

            .pattern-label {
                font-size: 1.5vw;
            }

            .pattern-name {
                font-size: 1.3vw;
            }

            .pattern-container-pauline-1 {
                margin: -0.4vw 0 0 2vw;
                text-align: center;
                width: 29vw;
                height: 40.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-1 {
                object-fit: cover;
                height: 54vw;
                margin: -3vw 0 0 -12vw;
            }

            .pattern-container-pauline-2 {
                margin: 1.7vw 0 0 2vw;
                text-align: center;
                width: 29vw;
                height: 40.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-2 {
                object-fit: cover;
                height: 54vw;
                margin: -6vw 0 0 -12vw;
            }

            .pattern-container-pauline-3 {
                margin: 1.8vw 0 0 2vw;
                text-align: center;
                width: 29vw;
                height: 40.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-3 {
                object-fit: cover;
                height: 57vw;
                margin: -4vw 0 0 -13vw;
            }

            .pattern-container-pauline-4 {
                margin: 1.6vw 0 0 2vw;
                text-align: center;
                width: 29vw;
                height: 40.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-4 {
                object-fit: cover;
                height: 55vw;
                margin: -12vw 0 0 -11vw;
            }
        }

        /* --------------------   EXTRA LARGE devices (large desktops, 1200px and up)  ------------------- */
        @media (min-width: 1200px) {
            .pattern {
                width: 25%;
            }

            .pattern-label {
                font-size: 1.2vw;
                border-style: none;
                background-color: #E8E8E8;
                margin: 8% 0 0;
                z-index: 1;
                opacity: 0.85;
                color: black;
                position: absolute;
                width: 70%;
                top: 65%;
                left: 15%;
            }

            .pattern-name {
                font-size: 1.1vw;
            }

            .pattern-container-pauline-1 {
                margin: -0.2vw 0 0 2vw;
                text-align: center;
                width: 21vw;
                height: 29.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-1 {
                object-fit: cover;
                height: 46vw;
                margin: -4vw 0 0 -13vw;
            }

            .pattern-container-pauline-2 {
                margin: 1.7vw 0 0 2vw;
                text-align: center;
                width: 21vw;
                height: 29.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-2 {
                object-fit: cover;
                height: 46vw;
                margin: -4vw 0 0 -13vw;
            }

            .pattern-container-pauline-3 {
                margin: 1.8vw 0 0 2vw;
                text-align: center;
                width: 21vw;
                height: 29.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-3 {
                object-fit: cover;
                height: 46vw;
                margin: -4vw 0 0 -13vw;
            }

            .pattern-container-pauline-4 {
                margin: 1.8vw 0 0 2vw;
                text-align: center;
                width: 21vw;
                height: 29.5vw;
                overflow: hidden;
            }

            .pattern-img-pauline-4 {
                object-fit: cover;
                height: 43vw;
                margin: -12vw 0 0 -12vw;
            }
        }


    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <header class="row">

        <div class="title m-b-md inline-block col-sm-3">
            <a href="/" id="home-link">
                Indie Pattern Finder
            </a>
        </div>

        <form action="#" method="get" class="form col-sm-8" id="searchRequest">
            <input type="text" id="query" class="inline-block" value="<?= $query ?>"/>
            <div class="text-center inline-block">
                <button type="submit" id="search-button">Search</button>
            </div>
        </form>
    </header>

    <div class="content">
        <div id="ajax-response">
        @include('patterns.searchResults')
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
        integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#searchRequest').submit(function (e) {
            e.preventDefault();
            var query = {query:  $('#query').val()};
            $.get('search', {query: query.query}, function (data) {
                $('#ajax-response').html(data);
                history.pushState(query, "Search for " + query.query, "?query=" + query.query);
            });
        });
    });
</script>

</body>
</html>
