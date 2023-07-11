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
      'requiereAutenticacion' => true,
      'soloAdmin' => true
     ],
     'usuarios' => [
      'title' => 'Usuarios',
      'requiereAutenticacion' => true,
      'soloAdmin' => true
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
  $soloAdmin = $rutaOpciones['soloAdmin'] ?? false;
  if($requiereAutenticacion && !$autenticacion->estaAutenticado()){
    $_SESSION['mensajeError'] = 'Se requiere haber iniciado sesion para ver este contenido.';
    header('Location: index.php?s=iniciar-sesion');
    exit;
  }
  if($soloAdmin && $autenticacion->getUsuario()->getRolFk() != 1){
    $_SESSION['mensajeError'] = 'Necesitas ser Administrador para visualizar este contenido';
    header('Location: index.php?s=dashboard');
    exit;
  }
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
          <?php if ($autenticacion->getUsuario()->getRolFk() === 1):?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=productos">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=categorias">Categorias</a>
          </li>
          <?php endif;?>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Web</a>
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
  <footer class="footer">
    <h2 class="logo">TrainEmpire</h2>
<?php if (isset($_GET['s']) && $_GET['s'] ==  'iniciar-sesion'):?>
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
     <?php endif;?>
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