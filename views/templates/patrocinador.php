<div class="patrocinador swiper-slide">
    <div class="ricky">
        <?php 
            // Asegúrate de que la propiedad url es un objeto y tiene el atributo 'web'
            $url = isset($patrocinador->url) ? json_decode($patrocinador->url) : null;
            $urlWeb = $url && isset($url->web) ? $url->web : '#';
            ?>
        <a href="<?php echo htmlspecialchars($urlWeb); ?>" target="_blank">
            <img class="patrocinador__imagen-logo" loading="lazy" 
                src="/build/img/logos/<?php echo $patrocinador->logo; ?>" alt="Logo">
        </a>
    </div>
</div>      