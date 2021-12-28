<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
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
            
            .m-b-md { margin-bottom: 30px; }
        </style>
    </head>
    
    <body>
        <div class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="300" height="100">
            <h2>Módulo de Trazabilidad</h2><br>
            <h2>Bienvenido/a </h2>   

            <div class="contenedor">
                <div class="abs-center">
                    <div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>
                    <video id="previsualizacion" class="p-1 border" style="width:300px; height:200px;"></video>
                </div>
            </div>
            
            <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
            
            <script type="text/javascript">
                var scanner = new Instascan.Scanner({ 
                    video: document.getElementById('previsualizacion'), 
                    scanPeriod: 5, 
                    mirror: false 
                });
        
                scanner.addListener('scan',function(content){
                    alert(content);
                    //window.location.href=content;
                });
        
                Instascan.Camera.getCameras().then(function (cameras){
                    if(cameras.length>=0){
                        scanner.start(cameras[0]);
                        $('[name="options"]').on('change',function(){
                            if($(this).val()==1){
                                if(cameras[0]!=""){
                                    scanner.start(cameras[0]);
                                }else{
                                    alert('No Front camera found!');
                                }
                            }else if($(this).val()==2){
                                if(cameras[1]!=""){
                                    scanner.start(cameras[1]);
                                }else{
                                    alert('No Back camera found!');
                                }
                            }
                        });
                    }else{
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                }).catch(function(e){
                    console.error(e);
                    alert(e);
                });
            </script>

            <a href="javascript:previsualizacion" class="btn btn-secondary">Activar Cámara</a>

            <div class="container col-md-4" style="text-align: center;">
                <input class="form-control text-center" type="text" placeholder="O escriba el código QR">
            </div><br>

            <button type="button" class="btn btn-success">Entrada</button>
            <button type="button" class="btn btn-danger">Salida</button>
        </div>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>

    </body>
</html>