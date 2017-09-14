<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Charts</title>

        {!! Charts::styles() !!}

    </head>
    <body>
        <!-- Main Application (Can be VueJS or other JS framework) -->
        <div class="app">
            <center>
                {!! $chart->html() !!}
            </center>
        </div>
        <!-- End Of Main Application -->
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
    </body>
</html>
