<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
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
                display: block;
                text-align: center;
            }

            h6{
                color: gray;
            }

            small{
                text-align: center;
                color: #636b6f;
            }

            .dato_label{
                text-align: center;
                font-style: italic;
                font-weight: bold;
                color: grey;
            }

            .center {
                text-align: center;
            }

            .hide{
                display: none;
            }

            #tel1, #tel2{
                border-color: green;
            }

        </style>
    </head>


    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small> Confirme los datos requeridos</small>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('confirma')}}" method="post" onSubmit="return confirm('¿Está seguro de los datos ingresados?');">
                                @csrf
                                    <div class="container col-md-4 mb-3">
                                        <label for="num_rut" class="dato_label">{{ $n_rut }}</label><br>
                                        <label for="num_rut" class="dato_label">{{ $n_com }}</label>
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <label for="telef" class="datos form-label">Confirme sus datos (*)</label>
                                        <input type="tel" class="form-control" id="tel1" name="telef1" placeholder="Ingrese número telefónico"  minlength="7" maxlength="12"  
                                        required pattern="[0-9]+" oninput="checkNum()"/>
                                    </div>

                                    <div class="container col-md-4 mb-3">
                                        <input type="tel" class="form-control" id="tel2" name="telef2" placeholder="Re: ingrese su número"  minlength="7" maxlength="12" 
                                        required pattern="[0-9]+" oninput="checkNum()"/>
                                    </div>

                                    <small id="error"></small>

                                    <div class="container col-md-4 mb-3">
                                        <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Correo electrónico">
                                    </div>

                                    <div class="container col-md-4 mb-3 oficina">
                                        <input type="text" class="form-control" name="oficina" id="oficina" placeholder="Oficina">
                                        <input value="{{ $carg }}" type="text" class="form-control hide" name="oficina_cargo" id="oficina_cargo" placeholder="Oficina" disabled>
                                    </div>

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


        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
        <script type="text/javascript">
            var ofi = document.getElementById("oficina_cargo").value;
            if (ofi == 0){
                document.getElementById("oficina").style.display= "none";
            }
            else{
                document.getElementById("oficina").style.display= "block";
            }

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
    </body>
</html>