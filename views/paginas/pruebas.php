<main class="agenda">
    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion">Campus y Pruebas de nuestro ClubDeportivo</p>

    <!-- Sección de Patrocinadores -->
    <div class="eventos">
        <!-- Patrocinadores Oro -->
        <h4 class="eventos__heading">&lt;Patrocinadores Oro /></h3>
        
        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($patrocinadores['oro'] as $patrocinador) : ?>
                    <div class="swiper-slide">
                        <?php include __DIR__ . '../../templates/patrocinador.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Patrocinadores Plata -->
        <h4 class="eventos__heading">&lt;Patrocinadores Plata /></h3>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    
                    <?php foreach($patrocinadores['plata'] as $patrocinador) : ?>
                        <div class="swiper-slide">
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