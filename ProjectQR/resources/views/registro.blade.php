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

            h2, h5{
                text-align:center;
            }

            h6{
                color: gray;
            }
        </style>
    </head>


    <body>
        <div style="text-align: center;">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="300" height="100">
        </div><br>
        <h2>Módulo de Trazabilidad</h2>
        <h5> Confirme su número de Teléfono </h5><br>
            

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="qr">
                                <div class="container col-md-4 mb-3">
                                    <label for="nombre" class="datos form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="John">
                                </div>

                                <div class="container col-md-4 mb-3">
                                    <label for="apellido_p" class="datos form-label">Apellido paterno</label>
                                    <input type="text" class="form-control" name="apellido_p" placeholder="Doe">
                                </div>

                                <div class="container col-md-4 mb-3">
                                    <label for="apellido_m" class="datos form-label">Apellido materno</label>
                                    <input type="text" class="form-control" name="apellido_m" placeholder="Doe">
                                </div>

                                <div class="container col-md-4 mb-3">
                                    <label for="feNa" class="datos form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" name="feNa">
                                </div><br>

                                <div class="form-check container col-md-4 mb-3">
                                    <h6>Sexo</h6><br>
                                    <label for="sexo" class="form-label">
                                        <input type="radio" class="form-control" name="sexo">Masculino 
                                    </label>

                                    <label for="sexo" class="form-label">
                                        <input type="radio" class="form-control" name="sexo">Femenino
                                    </label>
                                </div><br>

                                <div class="container col-md-4 mb-3">
                                    <label for="telef" class="datos form-label">Número de teléfono</label>
                                    <input type="tel" class="form-control" name="telef" placeholder="+56991342565" required>
                                </div>

                                <div class="container col-md-4 mb-3">
                                    <label for="telef" class="datos form-label">Confirme su número de teléfono</label>
                                    <input type="tel" class="form-control" name="telef" placeholder="+56991342565" required>
                                </div>

                                <div class="container col-md-4 mb-3">
                                    <label for="email" class="datos form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="Doe@gmail.com">
                                </div><br>

                                <div class="form-check container col-md-4 mb-3">
                                    <h6>Esquema de vacuna</h6><br>
                                    <label for="vacuna" class="form-label">
                                        <input type="radio" class="form-control" name="vacuna">Completo
                                    </label>

                                    <label for="vacuna" class="form-label">
                                        <input type="radio" class="form-control" name="vacuna">Incompleto
                                    </label>

                                    <label for="vacuna" class="form-label">
                                        <input type="radio" class="form-control" name="vacuna">No Realizado
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Ingresar <i class="fal fa-sign-in-alt"></i></button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    </body>
</html>