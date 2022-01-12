<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <style>
            html, body {
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0 auto;
            }
            small{
                text-align: center;
                color: #636b6f;
            }
            #principal{
                padding-top: 3%;
                display: block;
                text-align: center;
            }

            .full-height { height: 100vh; }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .separacion{
                padding: 3%;
                position: relative;
            }
            #previsualizacion{
                margin: 0 auto;
                clip-path: inset(23% 13% 35% 10%);
                width: 70%;
                height: auto;
                display: block; 
                display: inline-block;
                line-height: 0;
                font-size: 3px;
            }
            #code_ambi{
                height: 50px;
                width: 360px;
                margin: 0 auto;
                font-weight: bold;
                font-size: 18pt;
                position: absolute;
                top: 550px;
                left: 4px;
                right: 2px;
            }
            #botones{
                position: absolute;
                top: 625px;
                left: 4px;
                right: 2px;
            }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }
            #video{
                width: auto;
                height: auto;
            }
            #formulario{
                margin-bottom: 40px;
            }
            .hide{
                display: none;
            }

            .swal2-popup {
                font-size: 0.5rem !important;
            }
        </style>
    </head>
    
    <body>
        <!-- Esta vista lo unico que hace es retornar error o exito en caso del resultado para ingresar a trazabilidad -->
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small>Bienvenido/a</small>

                <div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>

                <div id="video">
                    <video name="previsualizacion" id="previsualizacion" autoplay></video>
                </div>

                <div>
                    <form action="#" method="post">
                        @csrf
                        <input class="container form-control text-center col-md-4" type="text" autofocus placeholder="O escriba el código QR" name="code_ambi" id="code_ambi"><br>
        
                        <div>
                            <div id="botones">
                                <button type="submit" name="t_traza" class="btn btn-success" value="ENTRADA">Entrada</button>
                                <button type="submit" name="t_traza" class="btn btn-danger" value="SALIDA">Salida</button>
                            </div>
                            <input value="{{$estado}}" type="text" id="estado" class="form-control hide" disabled>
                            <input value="{{$nom_ambi}}" type="text" id="nom_ambi" class="form-control hide" disabled>
                            <input value="{{$t_traza}}" type="text" id="t_traza" class="form-control hide" disabled>
                        </div><br>
                    </form>
                </div>
            </div> 
            
            <script type="text/javascript">
                var sonido = new Audio('js/sonidito.mp3');

                var scanner = new Instascan.Scanner({ 
                    video: document.getElementById('previsualizacion'), 
                    scanPeriod: 5, 
                    mirror: false 
                });
        
                Instascan.Camera.getCameras().then(function(cameras) {
                    if(cameras.length > 0){
                        scanner.start(cameras[0]);
                    }else{
                        console.error('No se han encontrado cámaras');
                        alert('No se encontraron cámaras');
                    }
                }).catch(function(e){
                    console.error(e);
                    alert("Error:" + e);
                });

                window.navigator = window.navigator || {};

                scanner.addListener('scan',vibrate(1000), function(respuesta) {
                    sonido.play();
                    navigator.vibrate(respuesta);
                    document.getElementById('code_ambi').value=respuesta; //code_ambi es el input para escribir el QR
                    document.getElementById('code_ambi').addEventListener(function(respuesta){
                        navigator.vibrate([1000, 500, 1000, 500, 2000]);
                    });
                });
            </script>
        </div>

        <script>
            // Script encargado de devolver la alerta segun el valor que tenga el input oculto de id "estado"
            $(document).ready(function() {
                var estado = document.getElementById("estado").value;
                var nom_ambi = document.getElementById("nom_ambi").value;
                var t_traza = document.getElementById("t_traza").value;
                // En caso de error arroja una alerta de error y vuelve a la vista QR
                if (estado == 'error'){
                    Swal.fire({
                        icon: 'error',
                        title: 'El código ingresado no es válido',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(function(){
                        return view('qr');
                    });
                }
                else{
                // En caso de exito arroja una alerta de success y retorna la vista de inicio
                    Swal.fire({
                        icon: 'success',
                        title: 'Ha registrado '+t_traza+' con éxito a '+nom_ambi,
                        showConfirmButton: false,
                        timer: 4500,
                    }).then(function(){
                        window.location.href = "/";
                    });
                }          
            });
        </script>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>