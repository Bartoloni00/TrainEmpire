<?php
$carrito = (new Carrito);
$rutina = (new Rutinas);
$id_carrito = $carrito->encontrarCarritoDelUsuario($autenticacion->getUsuario()->getIdUsuario()) ?? 0;
$rutinas = $carrito->productosCarrito($id_carrito) ?? [];
$precioTotal = 0;
$cantidad = 0;

//Product access token de prueba
MercadoPago\SDK::setAccessToken('TEST-7137060724184192-072605-fd5ead3d1ddb2752cdecf60cbd8615aa-533583724');
$preference = new MercadoPago\Preference();

$productos=[];
foreach ($rutinas as $producto) {
  $r = $rutina->porId($producto['productos_fk']);
  $item=new MercadoPago\Item();
  $item->id          = $r->getId();
  $item->title       = $r->getTitulo();
  $item->description = $r->getSintesis();
  $item->category_id = $r->getCategoria();
  $item->quantity    = 1;
  $item->unit_price  = $r->getPrecio();
  $item->currency_id = 'ARS';
  //print_r($item);
  array_push($productos,$item);
}
$preference->items = $productos;

$preference->back_urls = array(
    'success'=>'http://localhost/trainempire/sitio/index.php?s=carrito&p=s',
    'failture'=>'http://localhost/trainempire/sitio/index.php?s=carrito&p=f',
    'pending'=>'http://localhost/trainempire/sitio/index.php?s=carrito&p=p'
);
 $preference->auto_return = "approved";
 $preference->binary_mode = true;//al tener esto activado el estado: pending no sera posible


$preference->save();

$p = '';
if(isset($_GET['p'])){
    if ($_GET['p'] == 's') {
        $p = 'compra exitosa';
    } if ($_GET['p'] == 'f') {
        $p = 'compra fallida';
    } else {
        $p = 'compra pendiente';
    }
}
?>
<?php if (isset($_GET['p'])):?>
  <?php if ($_GET['p'] == 's' || $_GET['p'] == 'p'):?>
    <div class="msg-exito mb-3"><?= $p ?></div>
  <?php else:?>
    <div class="msg-error"><?= $p ?></div>
  <?php endif;?>
<?php endif;?>
<h1>Carrito de compra</h1>
<div class="carrito_container">
  <section class="carrito">
          <h2>Productos</h2>
  <?php foreach ($rutinas as $producto):?>
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
      <?php foreach ($rutinas as $producto):?>
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
    <?php if(!empty($productos)):?>
    <div id="wallet_container"></div>
    <?php else:?>
    <a href="index.php?s=checkout" class="btn-contacto">Realizar compra</a>
    <?php endif;?>
  </section>
</div>
<!-- SDK MercadoPago.js -->
<script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
      const mp = new MercadoPago('TEST-abcd14a0-6a42-4a2e-9df6-f5f7c9f3a5b4');//public key de prueba
      const bricksBuilder = mp.bricks();
      
        mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?=$preference->id;?>",
            redirectMode: "modal",
        },   
        callbacks: {
              onReady: () => {},
              onSubmit: () => {},
              onError: (error) => console.error(error),
            },
        });
    </script>