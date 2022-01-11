<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traza</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
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

            #tel1, #tel2{
                border-color: green;
            }

            small{
                text-align: center;
                color: #636b6f;
            }
        </style>
    </head>


    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small> Confirme su número de Teléfono </small>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('registro')}}" method="POST" onSubmit="return confirm('Está seguro de los datos ingresados?');">
                                    @csrf
                                    <div class="container col-md-4 mb-3">
                                        <label for="nombre" class="datos form-label">Nombres</label>
                                        <input type="text" class="form-control" name="visi_nombres" placeholder="Nombres" pattern="[A-Za-z]">
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="apellido_p" class="datos form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="visi_paterno" placeholder="Apellido paterno" pattern="[A-Za-z]">
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="apellido_m" class="datos form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="visi_materno" placeholder="Apellido materno" pattern="[A-Za-z]">
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="feNa" class="datos form-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" name="visi_fecha_nac">
                                    </div><br>

                                    <div class="form-check container col-md-4 mb-3">
                                        <label for="sexo" class="form-label">
                                            <input id="sexo_codigo" value=1 type="radio" class="form-control" name="sexo_codigo" checked>Masculino 
                                        </label>

                                        <label for="sexo" class="form-label">
                                            <input id="sexo_codigo" value=2 type="radio" class="form-control" name="sexo_codigo">Femenino
                                        </label>

                                        <label for="sexo" class="form-label">
                                            <input id="sexo_codigo" value=3 type="radio" class="form-control" name="sexo_codigo">Otro
                                        </label>
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="telef" class="datos form-label">Número fijo/celular (*)</label>
                                        <input type="tel" class="form-control" id="tel1" name="visi_fono_per" placeholder="45 / 569"  minlength="7" maxlength="11"  
                                        required pattern="[0-9]+" oninput="checkNum()"/>
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="telef2" class="datos form-label">Confirme su número número fijo/celular (*)</label>
                                        <input type="tel" class="form-control" id="tel2" name="telef2" placeholder="45 / 569"  minlength="7" maxlength="11" 
                                        required pattern="[0-9]+" oninput="checkNum()"/>
                                    </div>

                                    <small id="error"></small>

                                    <div class="container col-md-4 mb-3">
                                        <label for="email" class="datos form-label">E-mail</label>
                                        <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="visi_email" required placeholder="Example@gmail.com">
                                    </div><br>

                                    <div class="form-check container col-md-4 mb-3">
                                        <h6>Esquema de vacunación</h6><br>
                                        <label for="vacuna" class="form-label">
                                            <input type="radio" value="C" class="form-control" name="visi_esquema_completo">Completo
                                        </label>

                                        <label for="vacuna" class="form-label">
                                            <input type="radio" value="I" class="form-control" name="visi_esquema_completo">Incompleto
                                        </label>

                                        <label for="vacuna" class="form-label">
                                            <input type="radio" value="S" class="form-control" name="visi_esquema_completo" checked>No realizado
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
            function checkNum() {
                var tel1 = document.getElementById("tel1").value;
                var tel2 = document.getElementById("tel2").value;
                var button = document.getElementById("buttonSub");
                var error = document.getElementById("error");
                
                if (tel1 != tel2){ 
                    button.disabled = true;
                    error.textContent = "Los números no coinciden";
                    error.style.color = "red";
                }
                else {
                    button.disabled = false;
                    error.textContent = '';
                }
            } 
        </script>

        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
        <script>

        </script>
    </body>
</html>