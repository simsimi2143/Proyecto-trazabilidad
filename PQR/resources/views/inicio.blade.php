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
                margin-right: 5%;
                margin-left:5%;
            }

            #leftbox {
                float:left;
                width:100%;
                margin-left:10%;
            }

            #rightbox{
                float:right;
                width:20%;
            }

            div, h2, p {
                padding-top: 5%;
                padding-top: 5%;
            }

            div{
                padding-top: 3%;
                padding-top: 3%;
            }

            input[type="text"],
            input[type="number"], {
                width : 100%;
                border: 1px solid #333;
                box-sizing: border-box;
            }

            .guion{
                font-family: 'Roboto', sans-serif;
                font-weight: bold;
                font-size: 150%;
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

            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            ::placeholder{
                opacity:10
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
            
            .m-b-md { margin-bottom: 30px; }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <h2>Módulo de Trazabilidad</h2>
            <small>Registro Acceso/Salida</small>

            <form action="{{route('inicio')}}" method="post">
                @csrf
                <div class="container ">
                    <div class="form-check ">
                        
                        <label class="form-check-label" for="flexRut">
                            <input class="form-check-input" type="radio" value="rut" name="flexRut" id="flexRut" checked>RUT
                        </label>                        
                        <label class="form-check-label" for="flexPasaporte">
                            <input class="form-check-input" type="radio" value="pasaporte" name="flexRut" id="flexPasaporte">Pasaporte
                        </label>

                    </div>

                    <div class="form-check rut selectt center">
                        <div class="input-group row">
                            <div class="col-6 col-lg-6 row" id="leftbox">
                               <input class="form-control form-control-lg" minlength="8" maxlength="8" type="text" pattern="[0-9]+" name="rut" placeholder="12345678" >
                           </div>
                           <div class="guion col-1">-</div>
                            <div class="col-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 row" id="rightbox">
                                <input class="form-control form-control-lg" minlength="1" maxlength="1" type="text" name="dv" pattern="[0-9]+" placeholder="9">
                            </div>
                        </div>
                    </div>

                    <div class="form-check pasaporte selectt hide center">
                        <div class="input-group row">
                            <div class="col-7 col-lg-7 row" id="leftbox">
                                <input class="form-control form-control-lg" minlength="10" maxlength="10" type="text" name="pasaporte" placeholder="1234567890">
                            </div>
                            <div class="guion col-1">-</div>
                            <div class="col-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 row" id="rightbox">
                                <input class="form-control form-control-lg" type="text" name="p" placeholder="p">
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary">Siguiente</button>
                    </div>
                </div>
                
            </form>
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