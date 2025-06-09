<fieldset class="formulario__fieldset">

    <legend class="formulario__legend">Generador de Eventos</legend>
          
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre Evento</label>
            <input 
                type="text" 
                class="formulario__input" 
                id="nombre" 
                name="nombre"
                placeholder="Torneos, Eventos, Campus"
                value="<?php echo $evento->nombre; ?>"
                />
            </div>


            <div class="formulario__campo">
                <label for="descripcion" class="formulario__label">Descripción del Evento</label>
                <textarea 
                    class="formulario__input" 
                    id="descripcion" 
                    name="descripcion" 
                    placeholder="Descripcion Evento"
                    rows="8"
                    ><?php echo $evento->descripcion; ?></textarea>
                </div>

            <div class="formulario__campo">
                <label for="categoria" class="formulario__label">Categoria o Tipo de Evento</label>
                    <select 
                        class="formulario__select"
                        id="categoria"
                        name="categoria_id">
                    
                        <option value="">- Seleccionar -</option>
                        <?php foreach($categorias as $categoria) { ?>
                                <option <?php echo($evento->categoria_id === $categoria->id) ? 'selected' : '' ?> value="<?php echo $categoria->id; ?>"><?php echo 
                                $categoria->nombre; ?></option>
                            <?php } ?>
                    </select>
                </div>

           

            <div class="formulario__campo">
                <label for="categoria" class="formulario__label">Selecciona el Dia</label>
                    <div class="formulario__radio">
                        <?php foreach($dias as $dia) { ?>
                            <div>
                                <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                                <input 
                                    type="radio" 
                                    id="<?php echo strtolower($dia->nombre); ?>"
                                    name="dia"
                                    value="<?php echo $dia->id; ?>"
                                    <?php echo ($evento->dia_id === $dia->id) ? 'checked' : '' ;?>
                                    />
                            </div>
                            <?php } ?>
                    </div>
                </div>
            <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id; ?>">

            <div id="horas" class="formulario__campo">
                   <label for="" class="formulario__label">Seleccionar Hora</label>
                   
                   <ul id="horas" class="horas">
                        <?php foreach($horas as $hora) { ?>
                              <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--deshabilitada"><?php echo $hora->hora; ?></li>  
                            <?php } ?>
                   </ul>
                <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id; ?>">      
            </div>

</fieldset>


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="entrenadores" class="formulario__label">Entrenador</label>
        <input 
            type="text" 
            class="formulario__input" 
            id="entrenadores" 
            placeholder="Buscar Entrenador"
            />
        <ul id="listado-entrenadores" class="listado-entrenadores"></ul>
        <input type="hidden" name="entrenador_id" value="<?php echo $evento->entrenador_id ?? ''; ?>">             
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
        <input 
            type="number" 
            min="1"
            class="formulario__input" 
            id="disponibles" 
            name="disponibles"
            placeholder="Ej. 20"
            value="<?php echo $evento->disponibles ?? ''; ?>"
            />
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen del Evento</label>
        <input 
            type="file"
            class="formulario__input formulario__input--file" 
            name="imagen" 
            id="imagen" 
            />
    </div>

    <div class="formulario__campo">
        <?php if(isset($evento->imagen)) { ?>
            <p class="formulario__texto">Imagen Actual del Evento</p>
            <div class="formulario__imagen">
                <picture>
                    <!-- <source srcset="<?php echo $_ENV['HOST'] . '/build/img/eventos/' . $evento->imagen_actual; ?>" type="image/webp">
                    <source srcset="<?php echo $_ENV['HOST'] . '/build/img/eventos/' . $evento->imagen_actual; ?>" type="image/png">
                    <img src="<?php echo $_ENV['HOST'] . '/build/img/eventos/' . $evento->imagen_actual; ?>" alt="Imagen Evento"> -->

                    <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.webp" type="image/webp">
                    <source srcset="/build/img/eventos/<?php echo $evento->imagen; ?>.png" type="image/png">
                    <img src="/build/img/eventos/<?php echo $evento->imagen; ?>.png" alt="Imagen Evento">
                </picture>
            </div>
        <?php } ?>
    </div>
        
</fieldset>

        

       
        