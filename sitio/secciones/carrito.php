<?php
$carrito = (new Carrito);
$rutina = (new Rutinas);
$id_carrito = $carrito->encontrarCarritoDelUsuario($autenticacion->getUsuario()->getIdUsuario()) ?? 0;
$productos = $carrito->productosCarrito($id_carrito) ?? [];
$precioTotal = 0;
$cantidad = 0;
?>

<h1>Carrito de compra</h1>
<div class="carrito_container">
  <section class="carrito">
          <h2>Productos</h2>
  <?php foreach ($productos as $producto):?>
          <?php $r = $rutina->porId($producto['productos_fk'])?>
          <div class="tarjeta_carrito">
            <div>
              <img src="assets/productos/<?= $r->getImagen();?>" alt="planificacion de <?= $r->getCategoria(); ?>">
            </div>
            <div>
              <h3><?= $r->getTitulo();?></h3>
              <span>$ <b><?= $r->getPrecio();?></b></span>
            </div>
            <form action="acciones/eliminar_del_carrito.php" method="post">
              <input type="hidden" name="id" value="<?=$producto['id_producto_en_carrito']?>">
              <button type="submit" class="btn btn-danger">X</button>
            </form>
          </div>
  <?php endforeach;?>
  </section>
  <section >
    <h2>Detalles del precio:</h2>
    <ul class="carrito_precio">
      <?php foreach ($productos as $producto):?>
          <?php $r = $rutina->porId($producto['productos_fk'])?>
          <li>
            <span><?= $r->getTitulo()?> </span>
            <span>$ <?= $r->getPrecio();?></span>
          </li>
          <?php $precioTotal += $r->getPrecio();?>
          <?php $cantidad ++;?>
      <?php endforeach;?>
    
    <li>
      <span>Cantidad de items:</span> 
      <b><?=$cantidad;?></b>
    </li>
    <li>
      <span>Valor total: </span>
      <b>$ <?= $precioTotal?></b>
    </li>
    </ul>
    <a href="#" class="btn-contacto">Realizar compra</a>
  </section>
</div>