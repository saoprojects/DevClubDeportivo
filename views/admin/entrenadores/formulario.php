
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="nombre" 
                id="nombre"
                placeholder="Nombre del Entrenador"
                value="<?php echo $entrenador->nombre ?? ''; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="apellido" 
                id="apellido"
                placeholder="Apellido del Entrenador"
                value="<?php echo $entrenador->apellido ?? ''; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="carnet_entrenador" class="formulario__label">Carnet de Entrenador</label>
            <input 
                type="text"
                class="formulario__input" 
                name="carnet_entrenador" 
                id="carnet_entrenador"
                placeholder="Carnet de Entrenador"
                value="<?php echo $entrenador->carnet_entrenador ?? ''; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Email del Entrenador"
                id="email"
                name="email"
                value="<?php echo $entrenador->email ?? ''; ?>"
            />
        </div>  

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Teléfono</label>
            <input 
                type="tel"
                class="formulario__input"
                placeholder="Teléfono del Entrenador"
                id="telefono"
                name="telefono"
                value="<?php echo $entrenador->telefono ?? ''; ?>"
            />
        </div>
            
        <div class="formulario__campo">
            <label for="imagen" class="formulario__label">Imagen</label>
            <input 
                type="file"
                class="formulario__input formulario__input--file" 
                name="imagen" 
                id="imagen"
            />
        </div>
        
        <?php if(isset($entrenador->imagen)) { ?>
            <p class="formulario__texto">Imagen Actual</p>
            <div class="formulario__imagen">
                <picture>
                    <source srcset="/build/img/entrenadores/<?php echo $entrenador->imagen; ?>.webp" type="image/webp">
                    <source srcset="/build/img/entrenadores/<?php echo $entrenador->imagen; ?>.png" type="image/png">
                    <img src="/build/img/entrenadores/<?php echo $entrenador->imagen; ?>.png" alt="Imagen del Entrenador">
                </picture>
            </div>
        <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[facebook]" 
                placeholder="Facebook del Entrenador"
                value="<?php echo $redes->facebook ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[twitter]" 
                placeholder="Twitter del Entrenador"
                value="<?php echo $redes->twitter ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[youtube]" 
                placeholder="YouTube del Entrenador"
                value="<?php echo $redes->youtube ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[instagram]" 
                placeholder="Instagram del Entrenador"
                value="<?php echo $redes->instagram ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[tiktok]" 
                placeholder="TikTok del Entrenador"
                value="<?php echo $redes->tiktok ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text"
                class="formulario__input--sociales" 
                name="redes[github]" 
                placeholder="GitHub del Entrenador"
                value="<?php echo $redes->github ?? ''; ?>"
            >
        </div>
    </div>
</fieldset>
