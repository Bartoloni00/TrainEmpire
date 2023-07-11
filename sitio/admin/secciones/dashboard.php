<section>
    <h1>panel de admin</h1>
    <div class="dashboard">
        <?php if ($autenticacion->getUsuario()->getRolFk() === 1):?>
        <article class="admin-article">
            <a href="index.php?s=categorias">
                <h2>Categorias</h2>
            </a>
        </article>
        <?php endif;?>
        <article class="admin-article">
            <a href="index.php?s=productos">
                <h2>Productos</h2>
            </a>
        </article>
        <?php if ($autenticacion->getUsuario()->getRolFk() === 1):?>
            <article class="admin-article">
            <a href="index.php?s=usuarios">
                <h2>Usuarios</h2>
            </a>
        </article>
        <?php endif;?>
    </div>
</section>