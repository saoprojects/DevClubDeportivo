<div class="evento swiper-slide">
        <p class="evento__hora"> <?php echo $evento->hora->hora; ?> </p>
        
        <div class="evento__informacion">
            <!-- <a href="/inscripciones"> -->
            <a href="/evento?id=<?php echo $evento->id; ?>">
                <h4 class="evento__nombre"> <?php echo $evento->nombre; ?> </h4>

                <p class="evento__introduccion">
                    <?php if (isset($evento->imagen) && !empty($evento->imagen)) { ?>
                        <picture>
                                <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.webp" type="image/webp">
                                <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.png" type="image/png">
                                <img  loading="lazy" width="200" height="300" src="/build/img/eventos/<?php echo $evento->imagen; ?>.png" alt="Imagen Jugador">
                            </picture>
                        <?php } // cierra if ?>
                    </p>

                <p class="evento__introduccion"> <?php echo $evento->descripcion; ?> </p>
                <div class="evento__autor-info">
                    <picture>
                        <source srcset="/build/img/entrenadores/<?php echo $evento->entrenador->imagen; ?>.webp" type="image/webp">
                        <source srcset="/build/img/entrenadores/<?php echo $evento->entrenador->imagen; ?>.png" type="image/png">
                        <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/build/img/entrenadores/<?php echo $evento->entrenador->imagen; ?>.png" alt="Imagen Jugador">
                    </picture>
                    <p class="evento__autor-nombre">
                        <?php echo $evento->entrenador->nombre . " " . $evento->entrenador->apellido; ?>
                    </p>
            
            </a>
            
            </div>
        </div>
    </div>