<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traza</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto Condensed" rel="stylesheet">
        <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        form{
            text-align:center

        }

        h1, h3 {
            text-align:center 
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

        .formulario {
            display: grid;
            gap: 20px;
        }

        .formulario__label {
            display: block;
            font-weight: 700;
            padding: 10px;
            cursor: pointer;
        }

        .formulario__grupo-input {
            position: relative;
        }

        .formulario__input {
            width: 50%;
        }


        .formulario__input-error {
            font-size: 12px;
            margin-bottom: 0;
            display: none;
        }

        .formulario__input-error-activo {
            display: block;
        }

        .formulario__validacion-estado {
            position: absolute;
            right: 10px;
            bottom: 15px;
            z-index: 100;
            font-size: 16px;
            opacity: 0;
        }

        .formulario__checkbox {
            margin-right: 10px;
        }

        .formulario__grupo-terminos, 
        .formulario__mensaje,
        .formulario__grupo-btn-enviar {
            grid-column: span 2;
        }

        .formulario__mensaje {
            height: 45px;
            line-height: 45px;
            background: #F66060;
            padding: 0 15px;
            border-radius: 3px;
            display: none;
        }

        .formulario__mensaje-activo {
            display: block;
        }

        .formulario__mensaje p {
            margin: 0;
        }

        .formulario__grupo-btn-enviar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .formulario__btn {
            height: 45px;
            line-height: 45px;
            width: 30%;
            background: #000;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: .1s ease all;
        }

        .formulario__btn:hover {
            box-shadow: 3px 0px 30px rgba(163,163,163, 1);
        }

        .formulario__mensaje-exito {
            font-size: 14px;
            color: #119200;
            display: none;
        }

        .formulario__mensaje-exito-activo {
            display: block;
        }

        /* ----- -----  Estilos para Validacion ----- ----- */
        .formulario__grupo-correcto .formulario__validacion-estado {
            color: #1ed12d;
            opacity: 1;
        }

        .formulario__grupo-incorrecto .formulario__label {
            color: #bb2929;
        }

        .formulario__grupo-incorrecto .formulario__validacion-estado {
            color: #bb2929;
            opacity: 1;
        }

        .formulario__grupo-incorrecto .formulario__input {
            border: 3px solid #bb2929;
        }





        </style>

        <script>
                const formulario = document.getElementById('formulario');
                const inputs = document.querySelectorAll('#formulario input');

                const expresiones = {
                    rut: /^[\_\-]{4,16}$/, // numeros, guion y guion_bajo
                    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.function
                    apellidop: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
                    apellidom: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
                    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
                    telefono: /^\d{7,14}$/ // 7 a 14 numeros.
                    sexo: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
                    fechan: /^[\_\-]{4,16}$/, // numeros, guion y guion_bajo
                    vacunas: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.function

                const campos = {
                    rut: false,
                    nombre: false,
                    apellidop:false,
                    apellidom:false,
                    correo: false,
                    telefono: false,
                    sexo:false,
                    fechan:false,
                    vacunas:false
                }

                const validarFormulario = (e) => {
                    switch (e.target.name) {
                        case "rut":
                            validarCampo(expresiones.usuario, e.target, 'ru');
                        break;
                        case "nombre":
                            validarCampo(expresiones.nombre, e.target, 'nombre');
                        break;
                        case "apellidop":
                            validarCampo(expresiones.nombre, e.target, 'apellidop');
                        break;
                        case "apellidom":
                            validarCampo(expresiones.nombre, e.target, 'apellidom');
                        break;
                        case "correo":
                            validarCampo(expresiones.correo, e.target, 'correo');
                        break;
                        case "telefono":
                            validarCampo(expresiones.telefono, e.target, 'telefono');
                        break;
                        case "sexo":
                            validarCampo(expresiones.nombre, e.target, 'sexo');
                        break;
                        case "fechan":
                            validarCampo(expresiones.nombre, e.target, 'fechan');
                        break;
                        case "vacunas":
                            validarCampo(expresiones.nombre, e.target, 'vacunas');
                        break;
                    }
                }

                const validarCampo = (expresion, input, campo) => {
                    if(expresion.test(input.value)){
                        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
                        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
                        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
                        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
                        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
                        campos[campo] = true;
                    } else {
                        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
                        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
                        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
                        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
                        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
                        campos[campo] = false;
                    }
                }

                inputs.forEach((input) => {
                    input.addEventListener('keyup', validarFormulario);
                    input.addEventListener('blur', validarFormulario);
                });

                formulario.addEventListener('submit', (e) => {
                    e.preventDefault();

                    const terminos = document.getElementById('terminos');
                    if(campos.rut && campos.nombre && campos.apellidop && campos.apellidom && campos.correo && campos.telefono && campos.sexo 
                    && campos.fechan && campos.vacunas ){
                        formulario.reset();

                        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
                        setTimeout(() => {
                            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
                        }, 5000);

                        document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
                            icono.classList.remove('formulario__grupo-correcto');
                        });
                    } else {
                        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
                    }
                });
        </script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />


        </head>
        <body>
            <div style="text-align: center;">
                <img src="https://lh3.googleusercontent.com/proxy/OEA8dsDGU_xUAG9ZDxUH14r2kU3v4JYfTJ5cQrrqmXRCMdh9utfe1Njh35y-3vt7kRMeAvBHL9Mt5pxW4DJ_8tDMPJExWObplpQwDO9hJfq7g-jrrVg" alt="uct" width="300" height="100">
            </div>
            <h1>Modulo de Trazabilidad</h1>
            <h3> Registre sus datos personales </h3>
            
            <div>
                <br>
                <br>
                <form action="qr" class="formulario" id="formulario">
                <!-- Grupo: rut -->
                <div class="formulario__grupo" id="grupo__rut">
                    <label for="rut" class="formulario__label">Rut/Pasaporte</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="rut" id="rut" placeholder="11111111-1">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El  Rut debe ser ingresado solo con el guión mas no con los puntos.</p>
                </div>

                <!-- Grupo: Nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Nombres</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="John frank">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Nombre solo debe contener la primera letra en mayuscula.</p>
                </div>

                <!-- Grupo: Apellido paterno -->
                <div class="formulario__grupo" id="grupo__apellidop">
                    <label for="apellidop" class="formulario__label">Apellido paterno</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="apellidop" id="apellidop" placeholder="Harris">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Apellido solo debe contener un maximo de 60 caracteres.</p>
                </div>

                <!-- Grupo: Apellido materno -->
                <div class="formulario__grupo" id="grupo__apellidom">
                    <label for="apellidom" class="formulario__label">Apellido materno</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="apellidom" id="apellidom" placeholder=" Doe">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Apellido solo debe contener un maximo de 60 caracteres.</p>
                </div>

                <!-- Grupo: Correo Electronico -->
                <div class="formulario__grupo" id="grupo__correo">
                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                    <div class="formulario__grupo-input">
                        <input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                </div>

                <!-- Grupo: Teléfono -->
                <div class="formulario__grupo" id="grupo__telefono">
                    <label for="telefono" class="formulario__label">Teléfono</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="4491234567" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14 dígitos.</p>
                </div>

                <!-- Grupo: Sexo -->
                <div class="formulario__grupo" id="grupo__sexo">
                    <label for="sexo" class="formulario__label">Sexo</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="sexo" id="sexo" placeholder=" Masculino/Femenino">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El Sexo solo puede ser una de estas dos opciones.</p>
                </div>

                 <!-- Grupo: fechan -->
                <div class="formulario__grupo" id="grupo__fechan">
                    <label for="fechan" class="formulario__label">Fecha de nacimiento</label>
                    <div class="formulario__grupo-input">
                        <input type="date" class="formulario__input" name="fechan" id="fechan" placeholder=" ">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Por favor seleccione una fecha .</p>
                </div>

                 <!-- Grupo: vacunas -->
                 <div class="formulario__grupo" id="grupo__vacunas">
                    <label for="vacunas" class="formulario__label">Esquema de vacunación</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="vacunas" id="fvacunas" placeholder="Completo/Incompleto ">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Por favor seleccione agregue su respuesta .</p>
                </div>


                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="formulario__btn btn btn-secondary" >Ingresar</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
                </div>
		    </form>

            </div>

            <script src="{{ asset('js/app.js') }}" type="text/js"></script>


        </body>
</html>