<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
        <link rel="icon" href="{{ asset('iconoUCT.png') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="../js/sweetalert2.all.min.js"></script>
        <script src="../js/html5-qrcode.min.js"></script>
        <script src="../js/vue.min.js"></script>
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
                display: block;
                text-align: center;
            }
            .separacion{
                padding: 3%;
                position: relative;
                display: block;
            }

            #video{
                top: 20%;
            }

            #code_ambi{
                height: 50px;
                width: 360px;
                margin: 0 auto;
                font-weight: bold;
                font-size: 18pt;
            }
            #botones{
                margin: 0 auto;
            }

            #formulario{
                margin-bottom: 40px;
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
                <small>Bienvenido/a {{$n_com}}</small>

                <h6>Escanéa o ingresa el código QR a registrar</h6><br>


                {{-- div para el input para escribir el código qr y los botones de entrada/salida --}}
                <div>
                    <form id="formulario" action="{{route('qr')}}" method="post">
                        @csrf
                        <input class="container form-control text-center col-md-4" type="text" autofocus placeholder="O escriba el código QR" name="code_ambi" id="code_ambi" required><br>
        
                        <div class="col-xs-2 justify-content-center" id="botones">
                            <button name="t_traza" class="btn btn-success" value="ENTRADA">Entrada</button>
                            <button name="t_traza" class="btn btn-danger" value="SALIDA">Salida</button><br>
                        </div>
                    </form>
                </div>

                <div class="row justify-content-md-center h-25">
                    <div id="video" class="justify-content-md-center col-md-4"></div>
                </div>
            </div>

            
            <!-- {{-- script de implementación de la cámara scanner QR --}} -->
            <script type="text/javascript">
                // Inicializamos una variable la cual reproduce
                // sonido al momento de captar un qr
                var sonido = new Audio('js/sonidito.mp3');

                // Mediante esta sentencia iniciamos la llamada a la cámara
                // mediante el id que esta almacenado en la etiqueta video
                // definiendole un periodo de 3.6 segundos para capturar un elemento
                function onScanSuccess(respuesta) {
                    sonido.play();
                    document.getElementById('code_ambi').value=respuesta;   //code_ambi es el input para escribir el QR
                    // al escanear un código el borde cambia a color verde como confirmación
                    document.getElementById('code_ambi').style.border='thick solid #32AC07';
                    // vibración que dura 2 segundos
                    navigator.vibrate(2000);
                }

                // A través de este segmento de código instanciamos un nuevo objeto a escanear
                // definiendo que este nuevo objeto sera obtenido a través de lo captado por la cámara
                // mediante la etiqueta video, además forma un borde de escaneo de 250 pixeles
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "video", { fps: 10, qrbox: 250 });
                    html5QrcodeScanner.render(onScanSuccess);
                    
                    // seteamos las variables globales las cuales determinan
                    // los tipos de dispositivo usados
                    class Dispositivo {
                    esMovil = false
                    esTablet = false
                    esAndroid = false
                    esiPhone = false
                    esiPad = false
                    esOrdenador = false
                    esWindows = false
                    esLinux = false
                    esMac = false
                }

                // a través de este segmento de codigo determinamos
                // si el tipom de dispositivo usado esta en la instancia de true 
                // es decir dependiendo de cual se use 
                // android o pc se activa un true el cual indica que tipo de
                // dispositivo se uso al momento de inicializar la camara
                const deteccion = () => {
                    dispositivo = new Dispositivo()

                    if (navigator.userAgent.toLowerCase().match(/mobile/)){
                        dispositivo.esMovil = true
                    }
                    else {
                        if (navigator.userAgent.toLowerCase().match(/tablet/))
                            dispositivo.esTablet = true
                        else
                            dispositivo.esOrdenador = true
                    }

                    // iniciamos condicionales para generar una accion de activación de camara 
                    // dependiendo de que dispositivo se este usando
                    if (dispositivo.esMovil == true) {
                        if (navigator.userAgent.toLowerCase().match(/android/)) {
                            dispositivo.esAndroid = true
                            // se activa la cámara trasera
                            html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
                        }
                        
                        else if (navigator.userAgent.toLowerCase().match(/ipad/)){
                            dispositivo.esiPad = true
                            // se activa la cámara trasera
                            html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
                        } 
                        
                        else {
                            dispositivo.esiPhone = true
                            html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
                        }
                    } 
                    
                    else if(dispositivo.esTablet == true){

                    } 
                    
                    else {
                        if (navigator.userAgent.toLowerCase().match(/mac/)) {
                            dispositivo.esMac = true
                            // se activa la cámara frontal
                            html5QrCode.start({ facingMode: "user" }, config, qrCodeSuccessCallback);

                        } 
                        
                        else if(navigator.userAgent.toLowerCase().match(/linux/)){
                            dispositivo.esLinux = true
                            html5QrCode.start({ facingMode: "user" }, config, qrCodeSuccessCallback);

                        } 
                        
                        else {
                            dispositivo.esWindows = true
                            html5QrCode.start({ facingMode: "user" }, config, qrCodeSuccessCallback);
                        }
                    }
                }

                // se llama la funcion de detectar el dispositivo
                window.addEventListener('load', deteccion())
            </script>
        </div>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>