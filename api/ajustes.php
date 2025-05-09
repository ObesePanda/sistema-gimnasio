<?php
include_once "encabezado.php";

$payload = json_decode(file_get_contents("php://input"));
if (!$payload) {
    http_response_code(500);
    exit;
}

include_once "funciones_ajustes.php";

$metodo = $payload->metodo;

switch ($metodo) {
    case "registrar":
        $resultado  = (!obtenerInformacionAjustes()) ? registrarAjustes($payload->ajustes) : editarAjustes($payload->ajustes);
        echo json_encode($resultado);
        break;
    case "obtener";
        $ajustes = obtenerInformacionAjustes();
        if (!$ajustes) {
            $ajustes = [
                "nombre" => "PandaCode",
                "telefono" => "3531015780",
                "direccion" => "Direccion",
                "logo" => ""
            ];
        } else {
            $ajustes = $ajustes[0];
        }
        echo json_encode($ajustes);
        break;
        break;
}
