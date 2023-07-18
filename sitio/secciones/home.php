<?php
    //require_once __DIR__ . '/../clases/Entrenadores.php';
    $entrenadores = (new Entrenadores)->todos();

    //require_once __DIR__ . '/../clases/Categorias.php';
    $productos = (new Categorias)->todo();
?>

    <section class="hero">
    <div>
        <h1>TrainEmpire</h1>
        <p>"Convierte tu cuerpo en un imperio"</p>
        <a href="index.php?s=productos" class="btn-contacto">Ver rutinas</a>
    </div>
    <img src="assets/homePrincipal.svg" alt="ilustracion de comunidad de gym">
    </section>
    <section class="nosotros">
    <h2>Nuestro enfoque</h2>
    <div>
    <img src="assets/img_about.svg" alt="Entredador virtual apoyando a su alumno">
        <div class="info">
            <div class="tarjeta">
                <h3>Organizado</h3>
                <p>Somos <strong>un equipo de expertos altamente organizado para proporcionar el mejor servicio posible</strong> a nuestros clientes.</p>
            </div>
            <div class="tarjeta">
                <h3>Atencion al detalle</h3>
                <p>
               <strong> Los entrenadores adaptan cuidadosamente a las necesidades individuales de cada cliente</strong>, considerando su nivel de condición física, objetivos, limitaciones físicas y preferencias de entrenamiento.
                </p>
            </div>
            <div class="tarjeta">
                <h3>Experiencia</h3>
                <p>
                Cada uno de nuestros entrenadores tiene una formación especializada y <strong>años de experiencia en el campo del entrenamiento físico</strong>, lo que les permite adaptarse a las necesidades y objetivos de cada cliente de manera efectiva y eficiente.
                </p>
            </div>
            <div class="tarjeta">
                <h3>Empático</h3>
                <p>
                Comprendemos que cada cliente tiene necesidades y objetivos únicos, y <strong>nos esforzamos por entender sus preocupaciones y desafíos personales para crear planes de entrenamiento personalizados que sean efectivos y sostenibles a largo plazo</strong>. 
                </p>
            </div>
        </div>
    </div>
    </section>
    <section class="rutinas">
        <h2>Categorias</h2>
        <div class="categorias">
        <?php for ($i = 0; $i < 4; $i++): ?>
                <?php $categoria = $productos[$i]; ?>
                <div class="categoria">
                    <a href="index.php?s=productos&c=<?= $categoria->getId(); ?>">
                        <figure>
                            <picture>
                                <source srcset="assets/categorias/<?= $categoria->getNombre(); ?>Mobile.jpg" type="image/jpg" media="(max-width: 768px)" class="img-categoria">
                                <img src="assets/categorias/<?= $categoria->getNombre(); ?>.jpg" alt="Imagen representativa de la categoria <?= $categoria->getNombre(); ?>" class="img-categoria">
                            </picture>
                            <figcaption><?= $categoria->getNombre(); ?></figcaption>
                        </figure>
                    </a>
                </div>
        <?php endfor; ?>
        </div>

    </section>
    <section class="entrenadores">
                <h2>Nuestros expertos</h2>
                <div>
                <?php foreach ($entrenadores as $entrenador): ?>
                    <div class="entrenador" id="<?=$entrenador->getId();?>">
                        <img src="assets/entrenadores/<?=$entrenador->getImagen() ;?>" alt="<?=$entrenador->getDescripcion();?>">
                        <div>
                            <h3><?=$entrenador->getNombre();?></h3>
                            <p><?=$entrenador->getDescripcion();?></p>
                        </div>
                    </div>
                <?php endforeach;?>
                </div>
    </section>
    <section class="frecuentes">
      <h2>Preguntas frecuentes</h2>
      <div>
        <img src="assets/preguntasFrecuentes.svg" alt="">
      <div class="accordion preguntas-frecuentes" id="accordionExample">
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              ¿Cuáles son los costos asociados a los planes de entrenamiento y qué incluyen?
            </button>
          </h3>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
             <em> Los costos varian dependiendo de lo que incluye cada plan</em>, ya que algunos ofrecen acceso a una biblioteca de videos de entrenamiento, seguimiento de progreso, asesoramiento nutricional u otros recursos útiles.
            </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              ¿Cómo se adaptan los planes de entrenamiento a mi nivel de experiencia y a mis objetivos personales?
            </button>
          </h3>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <p>
            Los planes de entrenamiento se adaptan a tu nivel de experiencia y objetivos personales a través de un 
            cuestionario inicial que proporcionas al momento de adquirir el servicio. <em>A partir de tus respuestas, 
            se determina tu nivel de condición física actual, tus objetivos personales, limitaciones físicas y otras 
            necesidades individuales. Con esta información, se crea un plan de entrenamiento personalizado que se ajusta 
            a tus necesidades específicas y se adapta a medida que avanzas en el entrenamiento</em>.
            </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              ¿Puedo obtener asesoramiento personalizado o es todo automatizado?
            </button>
          </h3>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                Si, Esto puede incluir la opción de hablar con un entrenador personal o recibir retroalimentación personalizada sobre tu progreso. <strong> Si estás interesado en obtener asesoramiento adicional, es importante que busques un servicio que lo ofrezca explícitamente</strong>.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              ¿Cuánto tiempo tomará ver resultados con el plan de entrenamiento y cómo se miden esos resultados?
            </button>
          </h3>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                El tiempo que tardas en ver resultados con un plan de entrenamiento <em>depende de tu nivel de condición 
                física actual, tus objetivos personales, la intensidad y la frecuencia del entrenamiento y 
                tu adherencia al plan.</em> En general, es posible comenzar a ver algunos resultados en unas pocas semanas, 
                aunque los resultados significativos pueden tomar varios meses.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              ¿Hay algún tipo de garantía o política de devolución si no estoy satisfecho con mi plan de entrenamiento?
            </button>
          </h3>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            Sí, <em>Las planificaciones de entrenamiento ofrecen garantías o políticas de devolución si no estás satisfecho 
            con tu plan de entrenamiento.</em>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
