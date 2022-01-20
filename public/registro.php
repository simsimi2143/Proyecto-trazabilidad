<?php
session()->has('rut_nro');

if($_POST['rut_nro']){
    header('qr');
} else if($_POST()) {
    header('confirma');
} else {
    header('registro');
}
?>