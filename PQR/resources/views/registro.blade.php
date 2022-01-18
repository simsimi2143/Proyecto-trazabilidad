<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traza</title>
        <link rel="icon" href="{{ asset('iconoUCT.png') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        
        <!--Llamamos a nuesta carpeta public y su contenido bootstrap mediante esta sentencia-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Los iconos tipo Solid de Fontawesome-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <style>
            html, body {
                font-family: 'Roboto', sans-serif;
            }

            form {
                text-align:center
            }

            .datos{
                float: left;
                color: gray;
            }

            .radio{
                float: right;
                color: gray;
            }
            .centro{
                margin-right: 10%;
                color: gray;
            }

            .vac {
                color: gray;
            }

            .separacion{
                padding: 3%;
            }

            h2, h5{
                text-align:center;
                color: #636b6f;
            }

            #principal{
                padding-top: 3%;
                text-align: center;
                display: block;
            }

            h6{
                color: gray;
            }

            #tel1, #tel2, #mat, #pat, #nom{
                border-color: green;
            }

            small{
                text-align: center;
                color: #636b6f;
            }
        </style>

        <script>
            function isMobile(){
                return (
                    (navigator.userAgent.match(/Android/i)) ||
                    (navigator.userAgent.match(/webOS/i)) ||
                    (navigator.userAgent.match(/iPhone/i)) ||
                    (navigator.userAgent.match(/iPod/i)) ||
                    (navigator.userAgent.match(/iPad/i)) ||
                    (navigator.userAgent.match(/BlackBerry/i))
                );
            }
        </script>
    </head>


    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small> Confirme sus datos personales: {{ $n_rut }}</small>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- El formulario funciona por el método post para el envío de datos los cuales deben pasar por el controller
                                y los onSubmit son alertas que indican si los datos del usuario son correctos y le pregunta para continuar-->
                                <form action="{{route('registro')}}" method="POST" onSubmit="return confirm('Está seguro de los datos ingresados?');">
                                    <!-- Utilizamos este término para validar el envío del método post mediante un token -->
                                    @csrf
                                    <div class="container col-md-4 mb-3">
                                        <label for="nombre" class="datos form-label">Nombres (*)</label>
                                        <input type="text" class="form-control" id="nom" name="visi_nombres" placeholder="Nombres" required pattern="[a-zA-Z-ZñÑáéíóúÁÉÍÓÚüÜ ]{1,70}">
                                    </div>

                                    <!--Mediante un pattern validamos el ingreso de datos al formulario para que estos cunplan con los requisitos 
                                     que están en la base de datos-->
                                    <div class="container col-md-4 mb-3">
                                        <label for="apellido_p" class="datos form-label">Apellido paterno (*)</label>
                                        <input type="text" class="form-control" id="pat" name="visi_paterno" placeholder="Apellido paterno" required pattern="[a-zA-Z-ZñÑáéíóúÁÉÍÓÚüÜ ]{1,70}">
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="apellido_m" class="datos form-label">Apellido materno (*)</label>
                                        <input type="text" class="form-control" id="mat" name="visi_materno" placeholder="Apellido materno" required pattern="[a-zA-Z-ZñÑáéíóúÁÉÍÓÚüÜ ]{1,70}">
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="feNa" class="datos form-label">Fecha de nacimiento</label>
                                        <input type="date" id="fecha_nac" onclick="setDate()" class="form-control" name="visi_fecha_nac">
                                    </div><br>

                                    <!--Asignamos un valor numerico a cada tipo radio para que de esta forma podamos trabajar en la base de 
                                     datos con estos registros-->
                                    <div class="form-check container col-md-4 mb-3">
                                        <label for="sexo" class="datos form-label">
                                            <input id="sexo_codigo" value=1 type="radio" class="form-control" name="sexo_codigo">Masculino 
                                        </label>

                                        <label for="sexo" class="centro form-label">
                                            <input id="sexo_codigo" value=2 type="radio" class="form-control" name="sexo_codigo">Femenino
                                        </label>

                                        <label for="sexo" class="radio form-label">
                                            <input id="sexo_codigo" value=3 type="radio" class="form-control" name="sexo_codigo">Otro
                                        </label>

                                        {{-- este radio es para dejarlo oculto y seleccionado por defecto sin afectar a los demás para que no aparezca ninguno 
                                        preseleccionado --}}
                                        <label for="sexo" class="form-label">
                                            <input id="sexo_codigo" style="display: none;" value=0 type="radio" class="form-control" name="sexo_codigo" checked>
                                        </label>
                                    </div>

                                    <!--Los datos del número celular y/o telefónico son estrictamente requeridos por lo tanto se aplicó la etiqueta required a
                                    esta seccion del formulario-->
                                    <div class="container col-md-4 mb-3">
                                        <label for="telef" class="datos form-label">Número fijo/celular (*)</label>
                                        <input type="tel" class="form-control" id="tel1" name="visi_fono_per" placeholder="45 / 569" required 
                                        pattern="[0-9]+" minlength="7" maxlength="12" oninput="checkNum()"/>
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="telef2" class="datos form-label">Confirme su número fijo/celular (*)</label>
                                        <input type="tel" class="form-control" id="tel2" name="telef2" placeholder="45 / 569" required 
                                        pattern="[0-9]+" minlength="7" maxlength="12" oninput="checkNum()"/>
                                    </div> 

                                    <small id="error"></small>

                                    <div class="container col-md-4 mb-3">
                                        <label for="email" class="datos form-label">E-mail</label>
                                        <input type="email" class="form-control" pattern="[a-zA-Z0-9!#$%&'*\/=?^_`{|}~+-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`{|}~+-])+@[a-zA-Z0-9]([^@&%$/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
                                        name="visi_email" placeholder="Example@gmail.com">
                                    </div><br>

                                    <div class="form-check container col-md-4 mb-3">
                                        <h6>Esquema de vacunación</h6><br>
                                        <label for="vacuna" class="datos form-label">
                                            <input type="radio" value="C" class="form-control" name="visi_esquema_completo">Completo
                                        </label>

                                        <label for="vacuna" class="form-label vac">
                                            <input type="radio" value="I" class="form-control" name="visi_esquema_completo">Incompleto
                                        </label>

                                        <label for="vacuna" class="radio form-label">
                                            <input type="radio" value="S" class="form-control" name="visi_esquema_completo">No realizado
                                        </label>

                                        <label for="vacuna" class="form-label">
                                            <input style="display: none;" type="radio" value="NN" class="form-control" name="visi_esquema_completo" checked>
                                        </label>
                                    </div>
                                    
                                    <button type="submit" id="buttonSub" class="btn btn-success">Ingresar <i class="fal fa-sign-in-alt"></i></button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function setDate() {
                document.getElementById("fecha_nac").value = "1997-01-01"; 
            }

            // Mediante esta función nos aseguramos que los números telefónicos ingresados en ambos campos asigandos a esta tarea
            // sean iguales para así validar este dato 
            function checkNum() {
                var tel1 = document.getElementById("tel1").value;
                var tel2 = document.getElementById("tel2").value;
                var button = document.getElementById("buttonSub");
                var error = document.getElementById("error");
                
                // En nuestra condicional nos aseguramos que estos datos coincidan
                if (tel1 != tel2){ 
                    button.disabled = true;
                    error.textContent = "Los números no coinciden";
                    error.style.color = "red";
                }
                // Dado que si no es el caso arroje un error debajo de la etiqueta label para que el usuario sea capaz de verla
                else {
                    button.disabled = false;
                    error.textContent = '';
                }
            } 
        </script>

        <!--Llamamos a nuesta carpeta public y su contenido bootstrap mediante esta sentencia-->
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
        <script>

        </script>
    </body>
</html>