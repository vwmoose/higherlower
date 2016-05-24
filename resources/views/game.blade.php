<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
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

        .card {
            font-size: 25px;
            padding: 10px;
            width: 240px;
            border: 1px solid #5e5e5e;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 5px 5px 5px #888888;
            -moz-box-shadow: 5px 5px 5px #888888;
            box-shadow: 5px 5px 5px #888888;
            margin-bottom: 10px;
        }

        .card > .card_top_left {

            padding-right: 85%;
        }

        .card > .card_bottom_right {

            padding-left: 85%;
            -moz-transform: scale(1, -1);
            -webkit-transform: scale(1, -1);
            -o-transform: scale(1, -1);
            -ms-transform: scale(1, -1);
            transform: scale(1, -1);
        }

        .card > .card_top_left > img, .card > .card_bottom_right > img {

            width: 25px;
        }

        .card > .card_suit {
            margin: 50px 0px;
        }

        .card > .card_suit > img {
            width: 90px;
        }

        .score {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .high_score {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .instructions {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px
        }

        .row {
            margin: 10px;

        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">

            <div class="content">

                <div class="score">

                    @if ($lives > 0 && $cards_left > 0)

                        Score = {{ $score }}&nbsp;&nbsp;&nbsp;Lives = {{ $lives }}

                    @elseif ($cards_left == 0)

                        YOU WIN!!!!

                    @else

                        YOU LOSE!

                    @endif

                </div>

                <div class="high_score">High Score = {{ $high_score }}</div>

                <div class="card">

                    <div class="card_top_left">
                        {!! $card !!}<br/>
                        <img src="/img/{!! $card_suit !!}.png" class="card_suit"/>
                    </div>

                    <div class="card_suit">

                        <img src="/img/{!! $card_suit !!}.png" />

                    </div>

                    <div class="card_bottom_right">
                        {!! $card !!}<br/>
                        <img src="/img/{!! $card_suit !!}.png" class="card_suit"/>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="content">

                <form id="higherlower">

                    @if ($lives > 0 && $cards_left > 0)

                        <div class="instructions">Will the next card be higher or lower than the one above?</div>

                        <a href="/higherlower/higher" class="btn btn-primary" role="button">Higher</a>&nbsp;<a href="/higherlower/lower" class="btn btn-success" role="button">Lower</a>

                    @endif

                    <br/><br/><a href="/higherlower/shuffle" class="btn btn-warning btn-xs" role="button">Shuffle Deck</a>

                </form>
            </div>

        </div>

        {{--<div class="row">--}}

            {{--<div class="content">--}}
                {{--{!! $deck !!} - {!! $cards_left !!}--}}
            {{--</div>--}}

        {{--</div>--}}
        {{--<div class="row">--}}

            {{--<div class="content">--}}
                {{--{!! $debug !!}--}}
            {{--</div>--}}

        {{--</div>--}}
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>
