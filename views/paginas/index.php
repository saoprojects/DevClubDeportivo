
<h2 class="agenda__heading">Campus y Pruebas de nuestro ClubDeportivo</h2>
    <main class="agenda">
    <div class="eventos iconos-nosotros">
            <div class="icono">
                <a href="/registro"><img src="build/img/liga.jpg" alt="Icono seguridad" loading="lazy">
                <h3 class="eventos__heading">Inscripciones</h3>
                </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Dolorem repudiandae maiores, rerum id quibusdam optio, 
                    reprehenderit commodi magni error.</p>
            </div>

            <div class="icono">
                <a href="/eventos">
                <img src="build/img/torneo.jpg" alt="Icono Precio" loading="lazy">
                <h3 class="eventos__heading">Torneos</h3>
            </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Dolorem repudiandae maiores, rerum id quibusdam optio, 
                    reprehenderit commodi magni error.</p>
            </div>

            <div class="icono">
                <a href="/eventos"><img src="build/img/deporte5.jpg" alt="Icono Tiempo" loading="lazy">
                <h3 class="eventos__heading">Campus</h3>
                </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Dolorem repudiandae maiores, rerum id quibusdam optio, 
                    reprehenderit commodi magni error.</p>
            </div>
        </div>
    </main>
<main class="agenda">
    <!-- Sección de Patrocinadores -->
    <div class="eventos">
        <!-- Patrocinadores Oro -->
        <h4 class="eventos__heading">Patrocinadores Oro</h3>
        
        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($patrocinadores['oro'] as $patrocinador) : ?>
                    <div class="swiper-slide patrocinador-oro">
                        <?php include __DIR__ . '../../templates/patrocinador.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Patrocinadores Plata -->
        <h4 class="eventos__heading">Patrocinadores Plata</h3>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    
                    <?php foreach($patrocinadores['plata'] as $patrocinador) : ?>
                        <div class="swiper-slide patrocinador-plata">
                        <?php include __DIR__ . '../../templates/patrocinador.php'; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
    </div>
    <!-- Resto de la sección de eventos ... -->
</main>
    
<section class="resumen">
    <div class="resumen__grid">

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $jugadores_total; ?></p>
            <p class="resumen__texto">Jugadores</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $torneos_total; ?></p>
            <p class="resumen__texto">Torneos</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $campus_total; ?></p>
            <p class="resumen__texto">Campus</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero">500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>




<section class="boletos">
    <h2 class="boletos__heading">Pases & Precios</h2>
    <p class="boletos__descripcion">Precios para Clu</p>

    <div class="boletos__grid">
        <div <?php aos_animacion(); ?> class="boleto boleto--presencial">
            <h4 class="boleto__logo"> &lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Superior</p>
            <p class="boleto__precio">200€</p>
        </div>

        <div <?php aos_animacion(); ?> class="boleto boleto--virtual">
            <h4 class="boleto__logo">&lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Intermedio</p>
            <p class="boleto__precio">50€</p>
        </div>

        <div <?php aos_animacion(); ?> class="boleto boleto--gratis">
            <h4 class="boleto__logo">&lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Gratis</p>
            <p class="boleto__precio">Gratis - 0€</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>

<div id="mapa" class="mapa"></div>