<?php
$carrito = (new Carrito);
$id_carrito = $carrito->encontrarCarritoDelUsuario($autenticacion->getUsuario()->getIdUsuario());
$productos = $carrito->productosCarrito($id_carrito);

?>
<h1>Estas en el carrito</h1>
<ul>
<?php foreach ($productos as $producto):?>
        <li><?php print_r($producto)?></li>
<?php endforeach;?>
</ul>