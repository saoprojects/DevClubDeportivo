<main class="agenda2 <?php echo 'categoria-' . $evento->categoria_id; ?>">
    
    <div class="evento2__informacion">
        
        <h4 class="evento2__nombre"><?php echo $evento->nombre; ?></h4>

        <p class="evento2__introduccion">
            <?php if (isset($evento->imagen) && !empty($evento->imagen)) { ?>
                <picture>
                    <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.webp" type="image/webp">
                    <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.png" type="image/png">
                    <img loading="lazy" width="200" height="300" src="/build/img/eventos/<?php echo $evento->imagen; ?>.png" alt="Imagen del evento">
                </picture>
            <?php } ?>
        </p>

        <p class="evento2__introduccion"><?php echo $evento->descripcion; ?></p>
            
    </div>

</main>


