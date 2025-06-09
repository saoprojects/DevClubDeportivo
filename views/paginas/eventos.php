<main class="agenda">
    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion">Campus y Pruebas de nuestro ClubDeportivo/</p>

    

    <div class="eventos">     
        <h3 class="eventos__heading">&lt;Torneos /></h3>      
            <p class="eventos__fecha">Viernes 5 de Diciembre</p>
                
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper" >
                    <?php foreach($eventos['torneos_v'] as $evento) { ?>
                        <?php include __DIR__ . '../../templates/evento.php'; ?>
                    <?php } ?>
                </div>
                
            </div>

            <p class="eventos__fecha">Sabado 6 de Diciembre</p>

               <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                     <?php foreach($eventos['torneos_s'] as $evento) { ?>
                        <?php include __DIR__ . '../../templates/evento.php'; ?>
                    <?php } ?>
                </div>
                
            </div>
        </div>

        <div class="eventos eventos--workshops">
                <h3 class="eventos__heading">&lt;Campus /></h3>
                <p class="eventos__fecha">Viernes 5 de Diciembre</p>

                <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                     <?php foreach($eventos['campus_v'] as $evento) { ?>
                        <?php include __DIR__ . '../../templates/evento.php'; ?>
                    <?php } ?>
                </div>
                
            </div>

                <p class="eventos__fecha">Sabado 6 de Diciembre</p>

                <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                     <?php foreach($eventos['campus_s'] as $evento) { ?>
                        <?php include __DIR__ . '../../templates/evento.php'; ?>
                    <?php } ?>
                </div>
                
            </div>
        </div>

        <!-- <div class="eventos">
            <h3 class="eventos__heading">&lt;Pruebas /></h3>
            <p class="eventos__fecha">Viernes 5 de Diciembre</p>

            <div class="eventos__listado">

            </div>

            <p class="eventos__fecha">Sabado 6 de Diciembre</p>

            <div class="eventos__listado">
                
        </div>
    </div> -->

    
    
</main>