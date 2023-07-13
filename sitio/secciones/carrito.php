<?php
$carrito = (new Carrito);
$rutina = (new Rutinas);
$id_carrito = $carrito->encontrarCarritoDelUsuario($autenticacion->getUsuario()->getIdUsuario());
$productos = $carrito->productosCarrito($id_carrito);
?>

<h1>Estas en el carrito</h1>
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
        </div>
<?php endforeach;?>
</section>