<?php
$roles = (new Roles)->todo();
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
                required>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Escriba aqui su contraseña" class="form-control" required>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="roles_fk">Selecciona tu tipo de usuarios:</label>
            <select name="roles_fk" id="roles_fk" class="form-select" required>
            <?php foreach ($roles as $rol):?>
                <?php if ($rol->getId() !== 1):?>
                <option 
                    value="<?=$rol->getId()?>"
                    <?=$rol->getNombre() == 'usuario'?'selected':'';?>
                >
                    <?= $rol->getNombre()?>
                </option>
                <?php endif;?>
            <?php endforeach;?>
            </select>
        </div>
            <button type="submit" class="btn-contacto">Crear cuenta</button>
            <p class="opcional">Todos los campos son obligatorios</p>
    </form>
</section>