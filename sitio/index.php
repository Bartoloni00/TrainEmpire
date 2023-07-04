<?php 
  require_once __DIR__ . '/bootstrap/autoload.php';

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
    ];

  $vista = $_GET['s'] ?? 'home';

  if(!isset($rutas[$vista])) {
    // Esta vista no "existe", así que mostramos una pantalla de error.
    $vista = 'error';
  }

  $rutaOpciones = $rutas[$vista];
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
          <li class="nav-item">
            <a class="nav-link" href="index.php?s=contacto">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">
        <?php
        require_once __DIR__ . '/secciones/' . $vista . '.php';
        ?>
  </main>
  <footer>
      <a href="#" class="logo">TrainEmpire</a>
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