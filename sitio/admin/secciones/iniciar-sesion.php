<?php 
//require_once __DIR__ . '/../../bootstrap/autoload.php';
// $usuario = (new Usuario)->porEmail('abraham@prueba.com');
// echo $usuario->getEmail().'<br>';
// echo $usuario->getPassword().'<br>';
// echo $usuario->getUsername().'<br>';
?>
<section>
    <h1>Ingresar al panel de administracion</h1>
    <form action="acciones/iniciar-sesion.php" method="post" class="row g-3">
        <div class="col-md-12">
            <label class="form-label" for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" placeholder="abraham@prueba.com" class="form-control" required>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="12345" class="form-control" required>
        </div>
        <button type="submit" class="btn-contacto">Ingresar</button>
    </form>
</section>