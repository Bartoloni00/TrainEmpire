<?php
//require_once __DIR__.'/../../bootstrap/autoload.php';
$categorias = (new Categorias)->todo();
$id = isset($_GET['id'])? $_GET['id']: null;
//echo $id;
if ($id != null) {
    $categoria = (new Categorias)->porId($id);
}
//require_once __DIR__ . '/../../bootstrap/autoload.php';
// si existe la variable errores los usamos, sino la definimos vacia
if(isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    //print_r($errores);
    unset($_SESSION['errores']);
} else {
    $errores = [];
}
//recuperamos los datos que tenía el formulario si se envio con errores.
if(isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    //print_r($oldData);
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}

?>
<section>
    <h1>Administrador de Categorias</h1>
   <div class="admin-categorias">
   <section>
        <h2>Añadir/Modificar categoria</h2>
        <form action="acciones/administrar-categoria.php" method="post">
            <div class="row mt-3">
                <?php if($id != null):?>
                    <div class="col-md-12 mb-3">
                        <label for="id" class="form-label">ID:</label>
                        <input type="text" name="id" id="id" value="<?=$categoria->getId()?>"  class="form-control" >
                    </div>
                <?php endif;?>
                <div class="col-md-12">
                    <label class="form-label" for="nombre">Nombre de la categoria:</label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        placeholder="Nombre" 
                        class="form-control" 
                        <?php if($id != null): ?>
                            value="<?= $categoria->getNombre()?>"
                        <?php else: ?>
                            value="<?= $oldData['nombre'] ?? null;?>"
                        <?php endif; ?>
                        <?php if(isset($errores['nombre'])): ?> aria-describedby="error-nombre" <?php endif; ?>>
                        <?php
                        if(isset($errores['nombre'])):
                        ?>
                            <div class="msg-error" id="error-nombre"><?= $errores['nombre'];?></div>
                        <?php
                        endif;
                        ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                <?php if($id == null):?>
                    <button type="submit" class="btn btn-primary" name="accion" value="agregar">Agregar</button>
                <?php else:?>
                    <button type="submit" class="btn btn-warning" name="accion" value="editar">Editar</button>
                    <button type="submit" class="btn btn-danger" name="accion" value="eliminar">Eliminar</button>
                    <a href="../admin/index.php?s=categorias" class="btn btn-primary">Restaurar</a>
                <?php endif;?>
                </div>
            </div>
        </form>
    </section>

    <section>
        <h2>Categorias</h2>
            <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria):?>
                <tr>
                    <td><?=$categoria->getNombre();?></td>
                    <td>
                        <a href="index.php?s=categorias&id=<?= $categoria->getId();?>" class="btn-contacto">Seleccionar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </section>
   </div>
</section>