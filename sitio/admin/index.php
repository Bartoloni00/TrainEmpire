<?php 
  require_once __DIR__ . '/../bootstrap/autoload.php';
session_start();
  $rutas = [
    'error' => [
     'title' => 'Página no encontrada',
    ],
    'dashboard' => [
      'title' => 'Tablero de Administracion',
      'requiereAutenticacion' => true
     ],
     'productos' => [
      'title' => 'Nuestros productos',
      'requiereAutenticacion' => true
     ],
     'anadir-planificaciones' => [
      'title' => 'Añadir planificacion',
      'requiereAutenticacion' => true
     ],
     'editar-planificaciones' => [
      'title' => 'Editar planificacion',
      'requiereAutenticacion' => true
     ],
     'eliminar-planificaciones' => [
      'title' => 'Eliminar planificacion',
      'requiereAutenticacion' => true
     ],
     'categorias' => [
      'title' => 'Nuestras categorias',
      'requiereAutenticacion' => true
     ],
     'iniciar-sesion' => [
      'title' => 'Ingresar al panel de administracion',
     ],
    ];

  $vista = $_GET['s'] ?? 'iniciar-sesion';

  if(!isset($rutas[$vista])) {
    // Esta vista no "existe", así que mostramos una pantalla de error.
    $vista = 'error';
  }

  $rutaOpciones = $rutas[$vista];

  $autenticacion = new Autenticacion();
  $requiereAutenticacion = $rutaOpciones['requiereAutenticacion'] ?? false;
  if($requiereAutenticacion && !$autenticacion->estaAutenticado()){
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para ver este contenido.';
    header('Location: index.php?s=iniciar-sesion');
    exit;
  }
  // if (!($autenticacion->estaAutenticado())) {
  //   echo 'no esta autenticado';
  // }else{
  //   echo 'esta autenticado';
  // }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $rutaOpciones['title'];?> :: TrainEmpire Admin</title>
    <link rel="shortcut icon" href="../assets/tp1_logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="estilos_admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container-fluid">
      <span>TrainEmpire</span>
      <?php 
    if($autenticacion->estaAutenticado()):
    ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?s=dashboard">Panel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=productos">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=categorias">Categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php" target="_blank">Web</a>
          </li>
          <li class="nav-item">
            <form action="acciones/cerrar-sesion.php" method="post">
              <button type="submit" class="nav-link"><?= $autenticacion->getUsuario()->getUsername()?$autenticacion->getUsuario()->getUsername():$autenticacion->getUsuario()->getEmail();?> (Cerrar Sesión)</button>
              </form>
          </li>
        </ul>
      </div>
      <?php else:?>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Web</a>
            </li>
          </ul>
        </div>
      <?php endif;?>
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
  <footer>
      <a href="#" class="logo">TrainEmpire</a>
      <?php 
      if (isset($_GET['s']) && $_GET['s'] ==  'iniciar-sesion'):
      ?>
      <div class="footer-links">
        <div>
            <span>Redes sociales</span>
          <ul class="redes-sociales">
            <li><a href="http://www.instagram.com" target="_blank">instagram</a></li>
            <li><a href="http://www.tiktok.com" target="_blank">tiktok</a></li>
            <li><a href="http://www.youtube.com" target="_blank">youtube</a></li>
          </ul>
        </div><!--fin de links de redes sociales -->
        <div>
          <ul>
            <li><span>Socio</span></li>
            <li><a href="#">Atencion al Socio</a></li>
            <li><a href="#">Solicitud de baja</a></li>
            <li><a href="#">Tramite de Arrepentimiento</a></li>
          </ul>
        </div><!-- fin de cosas de socios-->
        <div>
          <ul>
            <li><span>Legal</span></li>
            <li><a href="#">Terminos y condiciones</a></li>
            <li><a href="#">Politica de privacidad</a></li>
            <li><a href="#">Defensa del consumidor</a></li>
          </ul>
        </div><!-- Fin de legales-->
    </div>
    <?php 
      endif;
      ?>
    <div>
      <p>
        En TrainEmpire cuidamos tu salud, por eso te recordamos que tu apto médico es indispensable al momento de iniciar una actividad física (leyes nº 139 y 12329).
      </p>
      <p>
      &copy; 2023 TrainEmpire. Todos los derechos reservados.
      </p>
    </div>
  </footer>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>