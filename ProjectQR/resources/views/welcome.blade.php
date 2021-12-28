<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            .m-b-md { margin-bottom: 30px; }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div class="content">
            <img src="https://lh3.googleusercontent.com/proxy/OEA8dsDGU_xUAG9ZDxUH14r2kU3v4JYfTJ5cQrrqmXRCMdh9utfe1Njh35y-3vt7kRMeAvBHL9Mt5pxW4DJ_8tDMPJExWObplpQwDO9hJfq7g-jrrVg" alt="uct" width="300" height="100">
            <h1>Modulo de Trazabilidad</h1>
            <p>Registro Acceso/Salida</p>

            <form action="registro">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRut" id="flexRut">
                    <label class="form-check-label" for="flexRut">RUT</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexPasaporte" id="flexPasaporte">
                    <label class="form-check-label" for="flexPasaporte">Pasaporte</label>
                </div>

                <div class="mb-3">
                    <input class="form-control form-control-lg" type="text" placeholder="Rut con dígito verificador">
                </div>

                <button type="submit" class="btn btn-primary">Siguiente</button>
                <a href="qr" type="submit" class="btn btn-secondary">Estoy registrado</a>
            </form>
        </div>

        <script src="{{ asset('js/app.js') }}" type="text/js"></script>


    </body>
</html>