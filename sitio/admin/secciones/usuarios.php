<?php
$usuarios = (new Usuario)->todo();
?>
<section>
    <h1>Administrador de Usuarios</h1>
    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th class="esconder-movile">Email</th>
            <th>Rol</th>
            <th class="esconder-tablet">Username</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario):?>
        <tr>
            <td class="esconder-movile"><?=$usuario->getEmail();?></td>
            <td><?=$usuario->getRolFk();?></td>
            <td class="esconder-tablet"><?=$usuario->getUsername() !== null?$usuario->getUsername():'sin username';?></td>
            <td>
                <a href="index.php?s=editar-planificaciones&id=<?= $usuario->getIdUsuario();?>" class="btn btn-warning">Editar</a>
                <a href="index.php?s=eliminar-planificaciones&id=<?= $usuario->getIdUsuario();?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</section>