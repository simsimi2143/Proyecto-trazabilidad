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
                margin-right: 3%;
                margin-left:3%;
            }

            #leftbox {
                float:left;
            }

            #rightbox{
                float:right;
            }

            .pad_left{
                padding-left: 1%;
            }

            div, h2, p {
                padding-top: 3%;
                color: #636b6f;
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

            small{
                color: #636b6f;
            }

            .content { text-align: center; }

            .title { font-size: 84px; }

            #rut, #pasaporte{
                width: 150px;
            }

            #dv, #p {
                width: 55px;
            }

            
            .m-b-md { margin-bottom: 30px; }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <h2>Módulo de Trazabilidad</h2>
            <small>Registro Entrada/Salida</small>

            <form action="{{route('inicio')}}" method="POST" class="form-inline"> 
                @csrf
                <div class="container">
                    <div class="form-check ">
                        
                        <label class="form-check-label" for="flexRut">
                            <input class="form-check-input" type="radio" value="rut" name="flexRut" id="flexRut" checked>RUT
                        </label>                       
                        <label class="form-check-label" for="flexPasaporte">
                            <input class="form-check-input" type="radio" value="pasaporte" name="flexRut" id="flexPasaporte">Pasaporte
                        </label>

                    </div>

                    <div class="form-check rut selectt center ">
                        <div class="input-group row pad_left">
                            <div id="leftbox">
                               <input value="" class="form-control form-control-lg" size=8 minlength="7" maxlength="8" type="text" pattern="[0-9]+" name="rut" id="rut" placeholder="N° Rut" oninput="checkRut()">
                            </div>
                            <div class="guion col-1">-</div>
                            <div id="rightbox">
                                <input class="form-control form-control-lg" size=2 minlength="1" maxlength="1" type="text" name="dv" id="dv" placeholder="dv" oninput="checkRut()" onkeyup="this.value = this.value.toUpperCase();" >
                            </div>
                        </div>
                    </div>

                    <div class="form-check pasaporte selectt hide center">
                        <div class="input-group row">
                            <div id="leftbox">
                               <input class="form-control form-control-lg" size=8 minlength="10" maxlength="10" type="text" name="pasaporte" id="pasaporte" placeholder="N° pasaporte">
                            </div>
                            <div class="guion col-1">-</div>
                            <div id="rightbox">
                                <input class="form-control form-control-lg" size=2 minlength="1" maxlength="1" type="text" name="p" id="p" placeholder="p">
                            </div>
                        </div>
                    </div>
                    
                    <small id="error"></small>

                    <div>
                        <button type="submit" id="buttonSub" class="btn btn-success">Siguiente</button>
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
            if(document.getElementById('flexRut').checked){
                function checkRut() {
                    var valor = document.getElementById("rut").value;
                    var dv = document.getElementById("dv").value;
                    var button = document.getElementById("buttonSub");
                    var error = document.getElementById("error");

                    // Calcular Dígito Verificador
                    suma = 0;
                    multiplo = 2;
                    
                    // Para cada dígito del Cuerpo
                    for(i=1;i<=valor.length;i++) {
                    
                        // Obtener su Producto con el Múltiplo Correspondiente
                        index = multiplo * valor.charAt(valor.length - i);
                        
                        // Sumar al Contador General
                        suma = suma + index;
                        
                        // Consolidar Múltiplo dentro del rango [2,7]
                        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
                
                    }
                    
                    // Calcular Dígito Verificador en base al Módulo 11
                    dvEsperado = 11 - (suma % 11);
                    
                    // Casos Especiales (0 y K)
                    dv = (dv == 'K')?10:dv;
                    dv = (dv == 'k')?10:dv;
                    dv = (dv == 0)?11:dv;
                    
                    // Validar que el Cuerpo coincide con su Dígito Verificador
                    if((dvEsperado != dv) || (valor.length <7 )) { 
                        // rut.setCustomValidity("RUT Inválido");
                        error.textContent = "Su número de rut con el dígito verificador no coinciden";
                        error.style.color = "red";
                        button.disabled = true;
                    }

                    else{
                        button.disabled = false;
                        error.textContent = ""
                    }
                    
                    // Si todo sale bien, eliminar errores (decretar que es válido)
                    
                }
            }
        </script>


        <script src="{{ asset('js/app.js') }}" type="text/js"></script>


    </body>
</html>