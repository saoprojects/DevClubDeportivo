<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Generador de Patrocinadores</legend>
          
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Patrocinador</label>
        <input 
            type="text" 
            class="formulario__input" 
            id="nombre" 
            name="nombre"
            placeholder="Nombre del Patrocinador"
            value="<?php echo $patrocinador->nombre ?? ''; ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción del Patrocinador</label>
        <textarea 
            class="formulario__input" 
            id="descripcion" 
            name="descripcion" 
            placeholder="Descripción del Patrocinador"
            rows="8"
        ><?php echo $patrocinador->descripcion ?? ''; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="rango" class="formulario__label">Rango del Patrocinador</label>
        <select 
            class="formulario__select"
            id="rango"
            name="rango_id">
            <option value="">- Seleccionar -</option>
            <?php foreach($rangos as $rango) { ?>
                <option 
                    <?php echo $patrocinador->rango_id == $rango->id ? 'selected' : '' ?>
                    value="<?php echo $rango->id; ?>">
                    <?php echo $rango->nombre; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__campo">
        <?php if(isset($patrocinador->logo_actual)) { ?>
            <p class="formulario__texto">Logo Actual</p>
            <div class="formulario__imagen">
                <picture>
                    <source srcset="<?php echo $_ENV['HOST'] . '/build/img/logos/' . $patrocinador->logo_actual; ?>" type="image/webp">
                    <source srcset="<?php echo $_ENV['HOST'] . '/build/img/logos/' . $patrocinador->logo_actual; ?>" type="image/png">
                    <img src="<?php echo $_ENV['HOST'] . '/build/img/logos/' . $patrocinador->logo_actual; ?>" alt="Logo Patrocinador">
                </picture>
            </div>
        <?php } ?>
    </div>

    <div class="formulario__campo">
            <label for="logo" class="formulario__label">Logo del Patrocinador</label>
            <input 
                type="file"
                class="formulario__input formulario__input--file" 
                name="logo" 
                id="logo" >
        </div>

    <div class="formulario__campo">
        <label for="url" class="formulario__label">URL del Patrocinador</label>
            <div class="formulario__contenedor-icono">
                    <div class="formulario__icono">
                        <i class="fa-brands fa-chrome"></i>
                    </div>
                <input 
                    type="text"
                    class="formulario__input--sociales" 
                    name="url[web]" 
                    placeholder="URL"
                    value="<?php echo $url->web ?? ''; ?>"
                />
            </div> 
        </div> 
        
</fieldset>
