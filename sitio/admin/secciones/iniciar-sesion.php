<?php 
if(isset($_SESSION['errorAutenticacion'])) {
    $emailGuardado = $_SESSION['errorAutenticacion']??'';
    unset($_SESSION['errorAutenticacion']);
} else {
    $emailGuardado = '';
}

?>
<section>
    <h1>Ingresar al panel de administracion</h1>
    <form action="acciones/iniciar-sesion.php" method="post" class="row g-3">
        <div class="col-md-12">
            <label class="form-label" for="email">Correo electrónico:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Escriba aqui su email" 
                class="form-control" 
                value="<?=$emailGuardado?>"
                required>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Escriba aqui su contraseña" class="form-control" required>
        </div>
        <button type="submit" class="btn-contacto">Ingresar</button>
    </form>
</section>