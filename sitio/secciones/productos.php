<?php 
 //$entrenadores = (new Entrenadores)->todos();

    $categorias = (new Categorias)->todos();

 $rutinas = (new Rutinas)->todas();

    //$entrenador = isset($_GET['e']) ? $_GET['e'] : '';//entrenador
    $categoriaGet = $_GET['c']??'';//categoria
    $precio_min = isset($_GET['minp']) ? intval($_GET['minp']) : 0;//precio minimo
    $precio_max = isset($_GET['maxp']) ? intval($_GET['maxp']) : PHP_INT_MAX;//precio maximo

    $filtro = new Filtro;
    $rutinas = $filtro->filtradoPorCategoria($rutinas,$categoriaGet);
    //$rutinas = $filtro->filtradoPorEntrenador($rutinas,$entrenador);
    $rutinas = $filtro->filtradoPorPrecio($rutinas,$precio_min,$precio_max);
?>

    <h1 class="productos-h2">Productos</h1>
    <form action="index.php" method="get" class="filtros">
        <input type="hidden" name="s" value="productos">
                <label for="c">Filtrar por Categoria</label>
                <select name="c" class="form-select" id="c">
                    <option value="">--Seleccione Categoria--</option>
                    <?php foreach($categorias as $categoria):?>
                        <option value="<?= $categoria->getId();?>" <?= $categoria->getId() === $categoriaGet ? 'selected' : '';?>><?= $categoria->getNombre();?></option>
                    <?php endforeach;?>
                </select>
                <div class="div-precios">
                    <span>Precio:</span>
                    <label for="minp">Precio minimo</label>
                    <input 
                        type="number" 
                        name="minp" 
                        min="0" 
                        placeholder="minimo" 
                        id="minp"
                        <?=$precio_min?'value="'.$precio_min.'"':''?>>
                    <label for="maxp">Precio maximo</label>
                    <input 
                        type="number" 
                        name="maxp" 
                        min="0" 
                        placeholder="maximo" 
                        id="maxp"
                        <?=$precio_max != PHP_INT_MAX?'value="'.$precio_max.'"':''?>>
                </div>
                <button type="submit" class="btn btn-danger">Filtrar</button>
            </form>   
    <section class="productos">
        <?php foreach ($rutinas as $rutina): ?>
            <article class="card">
            <img src="assets/productos/<?=$rutina->getImagen()?$rutina->getImagen():'defecto.jpg';?>" class="card-img-top" alt="planificacion de <?= $rutina->getTitulo(); ?>">
            <div class="card-body">
                <h2 class="card-title"><?=$rutina->getTitulo(); ?></h2>
                <p class="card-text"><?= $rutina->getSintesis();?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">$ <?=$rutina->getPrecio(); ?></li>
            </ul>
            <div class="card-body">
                <a href="index.php?s=detalles&id=<?= $rutina->getId();?>" class="btn btn-danger">ver mas</a>
            </div>
            </article>
        <?php endforeach; ?>
    </section>