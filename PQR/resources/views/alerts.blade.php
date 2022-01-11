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
                margin: 0;
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
            }

            .content { text-align: center; }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }

            #video{
                margin: 0 auto;
                width: 300px;
                height: 200px;
            }

            .camara{
                clip-path: inset(5% 20% 15% 10%);
                width: 300px;
                height: 200px;
            }

            .hide{
                display: none;
            }
        </style>
    </head>
    
    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small>Bienvenido/a</small>

                <div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>

                <div id="video">
                    <div class="camara">
                        <video name="previsualizacion" id="previsualizacion" style="width:300px; height:200px;"></video>
                    </div>
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

                scanner.addListener('scan', function(respuesta) {
                    sonido.play();
                    //alert("Contenido:" + respuesta);
                    document.getElementById('code_ambi').value=respuesta;          
                });
            </script>
            
            <form action="#" method="post">
                @csrf
                <input class="container form-control text-center col-md-4" type="text" autofocus placeholder="O escriba el código QR" name="code_ambi" id="code_ambi"><br>

                <div>
                    <button type="submit" name="t_traza" class="btn btn-success" value="ENTRADA">Entrada</button>
                    <button type="submit" name="t_traza" class="btn btn-danger" value="SALIDA">Salida</button>
                    <!-- onclick="confirmar()" -->
                    <input value="{{$estado}}" type="text" id="estado" class="form-control hide" disabled>
                </div><br>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                var estado = document.getElementById("estado").value;
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Ha registrado con éxito',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(function(){
                        window.location.href = "/";
                    });
                }          
            });
        </script>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>