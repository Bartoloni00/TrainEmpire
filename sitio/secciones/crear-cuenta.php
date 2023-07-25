<?php
$roles = (new Roles)->todo();
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
    <h1>Crear cuenta</h1>
    <form action="acciones/registrar-usuario.php" method="post" class="row g-3">
        <div class="col-md-12">
            <label class="form-label" for="email">Correo electrónico:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Escriba aqui su email" 
                class="form-control" 
                value="<?=$oldData['email']??'';?>"
                required>
            <?php if(isset($errores['email'])):?>
                <div class="msg-error" id="error-email"><?= $errores['email'];?></div>
            <?php endif;?>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Escriba aqui su contraseña" class="form-control" required>
            <?php if(isset($errores['password'])):?>
                <div class="msg-error" id="error-password"><?= $errores['password'];?></div>
            <?php endif;?>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="roles_fk">Selecciona tu tipo de usuario:</label>
            <select name="roles_fk" id="roles_fk" class="form-select" required>
                <option value="" selected>Seleccione una opción</option> <!-- Agregamos una opción vacía como placeholder -->
                <?php foreach ($roles as $rol):?>
                    <?php if ($rol->getId() !== 1):?>
                        <option value="<?=$rol->getId()?>">
                            <?= $rol->getNombre()?>
                        </option>
                    <?php endif;?>
                <?php endforeach;?>
            </select>
            <?php if(isset($errores['roles_fk'])):?>
                <div class="msg-error" id="error-roles_fk"><?= $errores['roles_fk'];?></div>
            <?php endif;?>
        </div>

            <button type="submit" class="btn-contacto">Crear cuenta</button>
            <p class="opcional">Todos los campos son obligatorios</p>
    </form>
</section>