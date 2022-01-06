<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        
        <style>
            html, body {
                background-color: #fff;
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

            .content { text-align: center; }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }
        </style>
    </head>
    
    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small>Bienvenido/a  Juan Carlos Pérez Pérez</small>

                <div class="abs-center">
                    <br><div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>
                    <video id="previsualizacion" style="width:900px; height:300px;"></video>
                </div>
            </div>   
            
            <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
            
            <script type="text/javascript">
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
                    console.log("Contenido:" + respuesta);
                });
            </script>
            
            <input class="container form-control text-center col-md-4" type="text" placeholder="O escriba el código QR"><br>

            <a href="#" type="submit" onclick="confirmar()" class="a btn btn-success">Entrada</a>
            <a href="#" type="submit" onclick="confirmar()" class="a btn btn-danger">Salida</a>
        </div>

        <script>
            function confirmar(){
                Swal.fire({
                    icon: 'success',
                    title: 'Su registro se ha completado con éxito!!',
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function(){
                    window.location.href = "/";
                })
            }
        </script>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>

    </body>
</html>