<?php
 //require_once __DIR__ . '/../clases/Categorias.php';
 $categorias = (new Categorias)->todo();

//require_once __DIR__ . '/../clases/Rutinas.php';
$rutinas = (new Rutinas)->todo();
?>

<h1>Compra de planificación de entrenamiento</h1>
<form action="index.php" method="post" class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido" class="form-control" required>
  </div>
  <div class="col-md-12">
    <label class="form-label" for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" placeholder="Correo electrónico" class="form-control" required>
  </div>
  <div class="col-md-12">
    <label class="form-label" for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="categoria">Categoría:</label>
    <select id="categoria" name="categoria" class="form-select" required>
      <option value="">Seleccione una categoría</option>
      <?php foreach ($categorias as $categoria): ?>
        <option value="<?= $categoria->getId(); ?>"><?= $categoria->getNombre(); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="rutina">Rutina:</label>
    <select id="rutina" name="rutina" class="form-select" required>
      <option value="">Seleccione una rutina</option>
      <?php foreach ($rutinas as $rutina): ?>
        <option value="<?= $rutina->getId(); ?>"><?= $rutina->getTitulo(); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-12">
    <button type="submit" class="btn-contacto">Enviar</button>
  </div>
</form>
