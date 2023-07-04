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
    <form action="acciones/anadir-categoria.php" method="post">
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
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn-contacto">Agregar planificacion</button>
            </div>
        </div>
    </form>
</section>
