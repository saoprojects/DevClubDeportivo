<div class="evento">
    <p class="evento__hora"> <?php echo $evento->hora->hora; ?> </p>
    
    <div class="evento__informacion">
        <h4 class="evento__nombre"> <?php echo $evento->nombre; ?> </h4>
        <p class="evento__introduccion"> <?php echo $evento->descripcion; ?> </p>
        <div class="evento__autor-info">
            <picture>
                <source srcset="<?php echo $_ENV['HOST']; ?>/build/img/jugadores/<?php echo $evento->jugador->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST']; ?>/build/img/jugadores/<?php echo $evento->jugador->imagen; ?>.png" type="image/png">
                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST']; ?>/build/img/jugadores/<?php echo $evento->jugador->imagen; ?>.png" alt="Imagen Jugador">
            </picture>
            <p class="evento__autor-nombre">
                <?php echo $evento->jugador->nombre . " " . $evento->jugador->primer_apellido; ?>
            </p>
        </div>

        <button
            type="button"
            data-id="<?php echo $evento->id; ?>"
            class="evento__agregar"
            <?php echo ($evento->disponibles === "0") ? 'disabled' : ''; ?>
            >
            <?php echo ($evento->disponibles === "0") ? 'Agotado' : 'Agregar - ' . $evento->disponibles . ' Disponibles' ; ?>
        </button>
    </div>
</div>