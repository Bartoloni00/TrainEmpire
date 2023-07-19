<?php 
    $categoriaGet = $_GET['c']??'';//categoria
    $precio_min = isset($_GET['minp']) ? intval($_GET['minp']) : 0;//precio minimo
    $precio_max = isset($_GET['maxp']) ? intval($_GET['maxp']) : PHP_INT_MAX;//precio maximo
    $paginaInicial = $_GET['p'] ?? 1;
    
    $categorias = (new Categorias)->todo();
    $busqueda = $categoriaGet? [
        ['categorias_fk','=',$categoriaGet],
    ]:[];
       
    [$rutinas,$paginacion,$totalData] = (new Rutinas)->todoPaginado($busqueda,9,$paginaInicial);
        //print_r((new Rutinas)->todoPaginado($busqueda,6,$paginaInicial));
    //print_r($totalData);
    $filtro = new Filtro;
    // if ($categoriaGet !== '') {
    //     $rutinas = (new Rutinas)->filtradoPorCategoria($categoriaGet);
    // }
    //$rutinas = $filtro->filtradoPorEntrenador($rutinas,$entrenador);
    $rutinas = $filtro->filtradoPorPrecio($rutinas,$precio_min,$precio_max);
?>

    <h1 class="productos-h2">Productos</h1>
    <form action="index.php" method="get" class="filtros">
        <input type="hidden" name="s" value="productos">
                <div class="buscador-container">
                    <div>
                        <label for="c">Filtrar por Categoria</label>
                        <select name="c" class="form-select" id="c">
                            <option value="">--Seleccione Categoria--</option>
                            <?php foreach($categorias as $categoria):?>
                                <option value="<?= $categoria->getId();?>" <?= $categoria->getId() === $categoriaGet ? 'selected' : '';?>><?= $categoria->getNombre();?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="div-precios">
                        <span>Establecer rango de precios:</span>
                        <div>
                            <label for="minp">Precio minimo</label>
                            <input 
                                type="number" 
                                class="form-control"
                                name="minp" 
                                min="0" 
                                placeholder="minimo" 
                                id="minp"
                                <?=$precio_min?'value="'.$precio_min.'"':''?>>
                            <label for="maxp">Precio maximo</label>
                            <input 
                                type="number" 
                                class="form-control"
                                name="maxp" 
                                min="0" 
                                placeholder="maximo" 
                                id="maxp"
                                <?=$precio_max != PHP_INT_MAX?'value="'.$precio_max.'"':''?>>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-contacto">Filtrar</button>
            </form>   
    <section class="productos">
        <?php foreach ($rutinas as $rutina): ?>
            <article class="card">
            <a href="index.php?s=detalles&id=<?= $rutina->getId();?>">
                <img src="assets/productos/<?=$rutina->getImagen()?$rutina->getImagen():'defecto.jpg';?>" class="card-img-top" alt="planificacion de <?= $rutina->getTitulo(); ?>">
                <div class="card-body">
                    <h2 class="card-title"><?=$rutina->getTitulo(); ?></h2>
                    <p class="card-text"><?= $rutina->getSintesis();?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">$ <?=$rutina->getPrecio(); ?></li>
                </ul>
            </a>
            <!-- <div class="card-body">
                <a href="index.php?s=detalles&id=<?= $rutina->getId();?>" class="btn-contacto">ver mas</a>
            </div> -->
            </article>
        <?php endforeach; ?>
    </section>
    <nav class="paginador">
        <p>Páginas</p>
        <ul class="paginador-lista">
            <?php if($paginacion['pagina'] > 1):?>
                <li><a href="index.php?s=productos&p=1"><i class="fa-solid fa-backward-fast"></i></a></li>
                <li><a href="index.php?s=productos&p=<?= ($paginacion['pagina'] - 1);?>"><i class="fa-solid fa-arrow-left"></i></a></li>
            <?php else:?>
                <li class="disable"><i class="fa-solid fa-backward-fast"></i></li>
                <li class="disable"><i class="fa-solid fa-arrow-left"></i></li>
            <?php endif;?>
            <?php for($i = 1; $i <= $paginacion['totalPaginas']; $i++): ?>
                <?php if($i == $paginacion['pagina']):?>
                    <li class="pag-actual"><span><?= $i;?></span></li>
                <?php else:?>
                    <li><a href="index.php?s=productos&p=<?= $i;?>"><?= $i;?></a></li>
                <?php endif;?>
            <?php endfor;?>
            <?php if($paginacion['pagina'] < $paginacion['totalPaginas']):?>
                <li><a href="index.php?s=productos&p=<?= ($paginacion['pagina'] + 1);?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                <li><a href="index.php?s=productos&p=<?= $paginacion['totalPaginas'];?>"><i class="fa-solid fa-forward-fast"></i></a></li>
            <?php else: ?>
                <li class="disable">=></li>
                <li class="disable"><i class="fa-solid fa-forward-fast"></i></li>
            <?php endif;?>
        </ul>
    </nav>