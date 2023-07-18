<?php
$asunto = $_GET['c']??'';
$usuario;
$autenticacion = (new Autenticacion);
if ($autenticacion->estaAutenticado()) {
  $usuario = $autenticacion->getUsuario();
}else{
  $usuario = false;
}
if ($asunto === 'tyc') {
  $asunto = 'Términos  y condiciones';
}elseif ($asunto === 'dac') {
  $asunto = 'Defensa al consumidor';
}
?>

<section> 
<h1>Contactate con TrainEmpire</h1>
<form action="index.php" method="post" class="row g-3">
  <div class="col-md-12">
    <label class="form-label" for="nombre">Nombre:</label>
    <input type="text" 
            id="nombre" 
            name="nombre" 
            placeholder="Ejemplo: Juan Pérez" 
            class="form-control" 
            required
            value="<?=$usuario ? ($usuario->getUsername() ? $usuario->getUsername() : '') : '';?>">
  </div>
  <div class="col-md-12">
    <label class="form-label" for="email">Correo electrónico:</label>
    <input type="email" 
            id="email" 
            name="email" 
            placeholder="Ejemplo: ejemplo@dominio.com" 
            class="form-control" 
            required
            value="<?=$usuario ? ($usuario->getEmail() ? $usuario->getEmail() : '') : '';?>">
  </div>
  <div class="col-md-12">
    <label class="form-label" for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" placeholder="+54 3436 234567" class="form-control" required>
  </div>
  <div class="col-md-12">
    <label for="asunto" class="form-label">Asunto:</label>
    <input type="text" 
            class="form-control" 
            require 
            id="asunto" 
            name="asunto" 
            placeholder="Ejemplo: Consulta sobre planificaciones"
            value="<?=$asunto; ?>">
  </div>
  <div class="col-md-12">
    <label for="mensaje" class="form-label">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control"></textarea>
  </div>
  <div class="col-md-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="privacidad" name="privacidad" required>
      <label class="form-check-label" for="privacidad">
        Acepto los términos y condiciones de privacidad.
      </label>
    </div>
  </div>
  <div class="col-md-12 text-center">
    <p class="opcional">Todos los campos son obligatorios</p>
    <button type="submit" class="btn-contacto">Enviar</button>
  </div>
</form>

</section>