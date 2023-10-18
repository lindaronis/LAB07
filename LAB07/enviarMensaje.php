<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_persona, per.nombres , per.apellido_paterno ,per.apellido_materno,per.celular , per.fecha_nacimiento 
  FROM promociones pro 
  INNER JOIN persona per ON per.id = pro.id_persona 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance7103867835/SendMessage/24f6d5c708164ce585d64f47f3636d5db2c53a4ea35849d5aa';
    $data = [
        "chatId" => "51".$persona->celular."@c.us",
        "message" =>  'Estimado(a) '.strtoupper($persona->nombres).' '.strtoupper($persona->apellido_paterno).' '.strtoupper($persona->apellido_materno).' No se pierda '.strtoupper($persona->promocion).' valido solo '.$persona->duracion.''
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?codigo='.$persona->id_persona);
?>