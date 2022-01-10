<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        
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
            .separacion{
                padding: 3%;
            }

            #previsualizacion{
                margin: 0 auto;
                width: 320px;
                height: 200px;
            }

            #code_ambi{
                height: 50px;
                width: 360px;
                margin: 0 auto;
                font-weight: bold;
                font-size: 18pt;
            }

            .content { text-align: center; }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }

            #video{
                margin: 0 auto;
                width: 320px;
                height: 200px;
                position: relative;
                /* clip-path: inset(14% 9% 21% 10%); */
            }
        </style>
    </head>
    
    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small>Bienvenido/a {{$n_com}}</small>

                <div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>

                <div id="video">
                    <video name="previsualizacion" id="previsualizacion" autoplay></video>
                </div>
            </div> 

            
            {{-- script de implementación de la cámara scanner QR --}}
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

                scanner.addListener('scan', function(respuesta) {
                    sonido.play();
                    //alert("Contenido:" + respuesta);
                    document.getElementById('code_ambi').value=respuesta; //code_ambi es el input para escribir el QR
                });
            </script>

            
            <form action="{{route('qr')}}" method="post">
                @csrf
                <input class="container form-control text-center col-md-4" type="text" autofocus placeholder="O escriba el código QR" name="code_ambi" id="code_ambi" required><br>

                <div>
                    <button onclick="confirmar()" name="t_traza" class="btn btn-success" value="ENTRADA">Entrada</button>
                    <button onclick="confirmar()" name="t_traza" class="btn btn-danger" value="SALIDA">Salida</button>
                </div><br>
            </form>
        </div>


        {{-- función que genera las ventanas de confirmacion y rechazo al seleccionar
        los botones de entrada y salida usando sweetalert --}}
        <script>
            function confirmar(){
                var code_ambi = document.getElementById("code_ambi").value;
                if (code_ambi == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Necesita rellenar el cuadro de texto con la información del QR',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
                else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Su registro se ha completado con éxito!!',
                        showConfirmButton: false,
                        timer: 2000,
                    })    
                }         
            }
        </script>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>