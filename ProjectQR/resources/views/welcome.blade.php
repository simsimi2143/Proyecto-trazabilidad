<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad</title>
        <script src= "https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 200;
                height: 100%;
            }

            label {
                margin-right: 20px;
            }

            #leftbox {
                float:left;
                width:75%;
                padding-left: 15%;
                padding-right: 10%;
            }

            #rightbox{
                float:right;
                width:25%;
            }

            div, h2, p {
                margin-top: 15px;
                margin-bottom:15px;
            }

            .guion{
                font-family: 'Roboto', sans-serif;
                font-weight: bold;
                font-size: 150%;
                padding-right: 5%;
                text-align: center;
            }
            
            .hide{
                display: none;
            }
            
            .full-height { height: 100vh; }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref { position: relative; }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content { text-align: center; }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="300" height="100">
            <h2>Módulo de Trazabilidad</h2>
            <p>Registro Acceso/Salida</p>

            <div class="container">
                <form action="registro">
                    <div class="form-check">
                        <label class="form-check-label" for="flexRut">
                            <input class="form-check-input" type="radio" value="rut" name="flexRut" id="flexRut" checked>RUT
                        </label>
 
                        <label class="form-check-label" for="flexPasaporte">
                            <input class="form-check-input" type="radio" value="pasaporte" name="flexRut" id="flexPasaporte">Pasaporte
                        </label>
                    </div>
                
                    <div class="form-check rut selectt">
                        <div class="row">
                            <div class="col-md-6 mb-3 row" id="leftbox">
                                <input class="form-control form-control-lg" type="text" placeholder="12345678">
                            </div>
                            <div class="guion">-</div>
                            <div class="col-md-1 mb-3 row" id="rightbox">
                                <input class="form-control form-control-lg" type="text" placeholder="9">
                            </div>
                        </div>
                    </div>

                    <div class="form-check pasaporte selectt hide center">
                        <div class="input-group row">
                            <div class="col-md-6 mb-3 row" id="leftbox">
                                <input class="form-control form-control-lg" type="text" placeholder="12345678">
                            </div>
                            <div class="guion">-</div>
                            <div class="col-md-1 mb-3 row" id="rightbox">
                                <input class="form-control form-control-lg" type="text" placeholder="p">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Siguiente <i class="fal fa-arrow-to-right"></i></button>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $("div.pasaporte").hide();
                $('input[type="radio"]').click(function() {
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".selectt").not(targetBox).hide();
                    $(targetBox).show();
                });
            });
        </script>


        <script src="{{ asset('js/app.js') }}" type="text/js"></script>


    </body>
</html>