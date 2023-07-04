<?php
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
    <h1>Añadir planificación</h1>
    <form action="acciones/anadir-planificacion.php" method="post" enctype="multipart/form-data">
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="categoria_fk">Selecciona Categoría:</label>
                <select name="categoria_fk" id="categoria_fk" class="form-select" >
                    <option value="">-- Seleccione Categoría --</option>
                    <?php foreach((new Categorias)->todos() as $categoria_fk):?>
                        <option 
                            value="<?= $categoria_fk->getId() ?>"
                            <?= $categoria_fk->getId() == ($oldData['categoria_fk'] ?? null)
                            ? 'selected'
                            : '';?>
                            ><?= $categoria_fk->getNombre() ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="hidden" name="usuarios_fk" value="<?= $autenticacion->getUsuario()->getIdUsuario(); ?>">
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label class="form-label" for="titulo">Título de la planificación:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Título" 
                    class="form-control" 
                    value="<?= $oldData['titulo'] ?? null;?>"
                    <?php if(isset($errores['titulo'])): ?> aria-describedby="error-titulo" <?php endif; ?>>
                    <?php
                    if(isset($errores['titulo'])):
                    ?>
                        <div class="msg-error" id="error-titulo"><?= $errores['titulo'];?></div>
                    <?php
                    endif;
                    ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label" for="descripcion">Descripción:</label>
                <textarea 
                name="descripcion" 
                id="descripcion" 
                class="form-control form-control-lg" 
                <?php if(isset($errores['descripcion'])): ?> aria-describedby="error-descripcion" <?php endif; ?>
                ><?= $oldData['descripcion'] ?? null;?></textarea>
                <?php
                if(isset($errores['descripcion'])):
                ?>
                    <div class="msg-error" id="error-descripcion"><?= $errores['descripcion'];?></div>
                <?php
                endif;
                ?>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sinopsis">Resumen de la descripción<span class="opcional"> (Opcional)</span> :</label>
                <textarea name="sinopsis" id="sinopsis" class="form-control form-control-sm"><?= $oldData['sinopsis'] ?? null;?></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label" for="imagen">Imagen<span class="opcional"> (Opcional)</span>:</label>
                <input type="file" id="imagen" name="imagen" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    class="form-control" 
                    step="0.01"
                    value="<?= $oldData['precio'] ?? null;?>"
                    <?php if(isset($errores['precio'])): ?> aria-describedby="error-precio" <?php endif; ?>>
                    <?php
                    if(isset($errores['precio'])):
                    ?>
                        <div class="msg-error" id="error-precio"><?= $errores['precio'];?></div>
                    <?php
                    endif;
                    ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn-contacto">Agregar planificacion</button>
            </div>
        </div>
    </form>
</section>
