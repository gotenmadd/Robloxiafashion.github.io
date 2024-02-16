<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $idea = $_POST["idea"];
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_temporal = $_FILES["imagen"]["tmp_name"];

    // Dirección de correo electrónico donde se enviará la idea
    $destinatario = "gotenmadd@gmail.com";
    $asunto = "Nueva idea recibida";

    // Contenido del correo electrónico
    $mensaje = "Nueva idea recibida:\n\n";
    $mensaje .= "Idea: " . $idea . "\n\n";

    // Verificar si se subió una imagen y adjuntarla al correo
    if ($imagen_nombre) {
        $ruta_imagen = "imagenes/" . $imagen_nombre;
        move_uploaded_file($imagen_temporal, $ruta_imagen);
        $mensaje .= "Imagen adjunta: " . $ruta_imagen . "\n";
    }

    // Enviar el correo electrónico
    $cabeceras = "From: gotenmadd@gmail.com";
    mail($destinatario, $asunto, $mensaje, $cabeceras);

    // Redireccionar a una página de confirmación
    header("Location: confirmacion.html");
} else {
    // Si no se ha enviado el formulario, redireccionar a la página de inicio
    header("Location: Inicio.html");
}
?>
