<?php 
require_once __DIR__ . '/bootstrap/autoload.php';
session_start();

  $rutas = [
    'error' => [
     'title' => 'Página no encontrada',
    ],
    'home' => [
      'title' => 'Página principal',
     ],
     'productos' => [
      'title' => 'Nuestros productos',
     ],
     'detalles' => [
      'title' => 'Planificacion personalizada',
     ],
     'contacto' => [
      'title' => 'Contacto',
     ],
     'carrito' => [
      'title' => 'Carrito de compras',
     ],
     'login'=>[
      'title' => 'Log in'
     ],
     'crear-cuenta'=>[
      'title'=>'Registro'
     ]
    ];

  $vista = $_GET['s'] ?? 'home';

  if(!isset($rutas[$vista])) {
    // Esta vista no "existe", así que mostramos una pantalla de error.
    $vista = 'error';
  }

  $rutaOpciones = $rutas[$vista];

  $autenticacion = new Autenticacion();
  $requiereAutenticacion = $rutaOpciones['requiereAutenticacion'] ?? false;
  if($requiereAutenticacion && !$autenticacion->estaAutenticado()){
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para ver este contenido.';
    header('Location: index.php?s=home');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $rutaOpciones['title'];?> :: TrainEmpire</title>
    <link rel="shortcut icon" href="assets/tp1_logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <span>TrainEmpire</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?s=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=productos">Productos</a>
          </li>
          <?php if($autenticacion->estaAutenticado()):?>
            <?php if($autenticacion->getUsuario()->getRolFk() === 2)://si el usuario es entrenador?>
              <li class="nav-item">
                <a class="nav-link" href="admin/index.php?s=dashboard">Administrador</a>
              </li>
            <?php else:?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?s=carrito">Carrito</a>
              </li>
            <?php endif;?>
            <li class="nav-item">
              <form action="acciones/cerrar-sesion.php" method="post">
                <button type="submit" class="nav-link"><?= $autenticacion->getUsuario()->getUsername()?$autenticacion->getUsuario()->getUsername():$autenticacion->getUsuario()->getEmail();?> (Cerrar Sesión)</button>
              </form>
            </li>
          <?php else:?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?s=login">Iniciar sesion</a>
            </li>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">
  <?php
        if(isset($_SESSION['mensajeExito'])):
        ?>
        <div class="msg-exito mb-3"><?= $_SESSION['mensajeExito']; ?></div>
        <?php
        unset($_SESSION['mensajeExito']);
        endif;
        ?>
        <?php
        if(isset($_SESSION['mensajeError'])):
        ?>
        <div class="msg-error"><?= $_SESSION['mensajeError']; ?></div>
        <?php
        unset($_SESSION['mensajeError']);
        endif;
        ?>
        <?php
        require_once __DIR__ . '/secciones/' . $vista . '.php';
        ?>
  </main>
  <footer class="footer">
    <h2 class="logo">TrainEmpire</h2>
     <div class="contenedor">
      <div class="footer-row">
        <div class="footer-col">
          <h3>TrainEmpire</h3>
          <ul>
            <li><a href="#">Sobre nosotros</a></li>
            <li><a href="#">Nuestros servicios</a></li>
            <li><a href="index.php?s=contacto">Contactanos</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h3>Legal</h3>
          <ul>
            <li><a href="#">Terminos y condiciones</a></li>
            <li><a href="#">Politica de privacidad</a></li>
            <li><a href="#">Defensa al consumidor</a></li>
            <li><a href="#">Opciones de pago</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h3>Socio</h3>
          <ul>
            <li><a href="#">Atencion al socio</a></li>
            <li><a href="#">Solicitud de baja</a></li>
            <li><a href="#">Arrepentimiento</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h3>Redes sociales</h3>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
     </div>
     <div>
      <p>
        En TrainEmpire cuidamos tu salud, por eso te recordamos que tu apto médico es indispensable al momento de iniciar una actividad física (leyes nº 139 y 12329).
      </p>
      <p>
      &copy; 2023 TrainEmpire. Todos los derechos reservados.
      </p>
    </div>
  </footer>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>