<?php
$usuarios = (new Usuario)->todo();
$rol = (new Roles);
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
            <?php if ($usuario->getEmail() !== (new Autenticacion)->getUsuario()->getEmail()):?>
        <tr>
            <td class="esconder-movile"><?=$usuario->getEmail();?></td>
            <td><?=$rol->porId($usuario->getRolFk())->getNombre();?></td>
            <td class="esconder-tablet"><?=$usuario->getUsername() !== null?$usuario->getUsername():'sin username';?></td>
            <td>
                <a href="index.php?s=eliminar-usuario&id=<?= $usuario->getIdUsuario();?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
            <?php endif;?>
        <?php endforeach;?>
    </tbody>
</table>
</section>