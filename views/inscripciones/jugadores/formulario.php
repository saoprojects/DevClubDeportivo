<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>

        <div class="formulario__campo">
            <label for="dni" class="formulario__label">D.N.I.</label>
                <input 
                    type="text" 
                    class="formulario__input"
                    id="dni" 
                    name="dni"
                    placeholder="Ej: 37663995Z" maxlength="9"
                    title="DNI incorrecto o formato incorrecto"
                    value="<?php echo $jugador->dni ?? ''; ?>"
                    />
            </div>  
       
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="nombre" 
                id="nombre"
                placeholder="Nombre Jugador"
                value="<?php echo $jugador->nombre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="primer_apellido" class="formulario__label">Primer Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="primer_apellido" 
                id="primer_apellido"
                placeholder="Primer Apellido Jugador"
                value="<?php echo $jugador->primer_apellido ?? ''; ?>"
                >
        </div>
        <div class="formulario__campo">
            <label for="segundo_apellido" class="formulario__label">Segundo Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="segundo_apellido" 
                id="segundo_apellido"
                placeholder="Segundo Apellido Jugador"
                value="<?php echo $jugador->segundo_apellido ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu Email"
                id="email"
                name="email"
                value="<?php echo $jugador->email ?? ''; ?>"
                />
            </div>  

        <div class="formulario__campo">
            <label for="padre" class="formulario__label">Nombre Padre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="padre" 
                id="padre"
                placeholder="Nombre del Padre"
                value="<?php echo $jugador->padre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="madre" class="formulario__label">Nombre Madre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="madre" 
                id="madre"
                placeholder="Nombre de la Madre"
                value="<?php echo $jugador->madre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Teléfono</label>
            <input 
                type="tel"
                class="formulario__input"
                placeholder="Tu teléfono"
                id="telefono"
                name="telefono"
                value="<?php echo $jugador->telefono ?? ''; ?>"
                />
        </div>
            
        <div class="formulario__campo">
            <label for="genero" class="formulario__label">Genero</label>
                <select class="formulario__input" id="genero" name="genero">
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                        </select>
                        
        </div>

        <div class="formulario__campo">
            <label for="fecha_nacimiento" class="formulario__label">Fecha de Nacimiento</label>
                <input 
                type="date" 
                class="formulario__input" 
                id="fecha_nacimiento" 
                name="fecha_nacimiento"
                value="<?php echo $jugador->fecha_nacimiento ?? ''; ?>" required
               >

            </div>

            <div class="formulario__campo">
                <label for="direccion" class="formulario__label">Direccion</label>
                        <input 
                            type="text" 
                            class="formulario__input"  
                            id="direccion"
                            name="direccion"
                            placeholder="Ej: C/Madrid 22 4D" required title="Sin comas o puntos"
                            value="<?php echo $jugador->direccion ?? ''; ?>"
                            >
                </div>
            <div class="formulario__campo">
                <label for="codigo_postal" class="formulario__label">Codigo Postal</label>
                    <input 
                        type="number" 
                        class="formulario__input"
                        id="codigo_postal"
                        name="codigo_postal"
                        placeholder="Ej: 29900" min="1" max="99999" required title="Solo 5 dígitos númericos"
                        value="<?php echo $jugador->codigo_postal ?? ''; ?>"
                        >

                </div>

            <div class="formulario__campo">
                <label for="ciudad" class="formulario__label">Ciudad</label>
                <input 
                    type="text"
                    class="formulario__input" 
                    name="ciudad" 
                    id="ciudad"
                    placeholder="Ciudad Jugador"
                    value="<?php echo $jugador->ciudad ?? ''; ?>"
                    >
            </div>

        <div class="formulario__campo">
            <label for="pais" class="formulario__label">Pais</label>
                <input 
                    type="text"
                    class="formulario__input" 
                    name="pais" 
                    id="pais"
                    placeholder="Pais Jugador"
                    value="<?php echo $jugador->pais ?? ''; ?>"
                    >
            </div>

            <div class="formulario__campo">
                <label for="nacionalidad" class="formulario__label">Nacionalidad</label>
                    <input 
                        type="text" 
                        class="formulario__input" 
                        id="nacionalidad"  
                        name="nacionalidad"
                        placeholder="Ej: Española"
                        value="<?php echo $jugador->nacionalidad ?? ''; ?>"
                        >
                </div>
        
        <div class="formulario__campo">
            <label for="categoria" class="formulario__label">Catégoria</label>
                        <select class="formulario__input" id="categoria" name="categoria" required>
                            <option value="juvenil">Juvenil</option>
                            <option value="cadete">Cadete</option>
                            <option value="infantil">Infantil</option>
                            <option value="alevin">Alevín</option>
                            <option value="benjamin">Benjamín</option>
                            <option value="prebenjamin">Prebenjamín</option>
                        </select>          
            </div>
        
        <div class="formulario__campo">
                <label for="grupo" class="formulario__label">Grupo</label>
                <select class="formulario__input" id="grupo" name="grupo" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>          
            </div>

        <div class="formulario__campo">
            <label for="federado" class="formulario__label">¿Federado?</label> 
                        <select class="formulario__input" id="federado" name="federado">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
            </div>

        <div class="formulario__campo">
            <label for="nadar" class="formulario__label">¿Sabe nadar?</label> 
                        <select class="formulario__input" id="nadar" name="nadar">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
            </div>

        <div class="formulario__campo">
            <label for="alergias" class="formulario__label">¿Tiene alergias?</label> 
                        <select class="formulario__input" id="alergias" name="alergias">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
            </div>

        <div class="formulario__campo">
                <label for="informacion" class="formulario__label">¿Información extra que se quiera comunicar al club?</label>
                <textarea class="formulario__input" id="informacion" name="informacion" rows="4" cols="50" placeholder="¿Preferencias?, ¿Posibles alergias?"></textarea>
            </div>
            

        <div class="formulario__campo">
            <label for="imagen" class="formulario__label">Imagen</label>
            <input 
                type="file"
                class="formulario__input formulario__input--file" 
                name="imagen" 
                id="imagen" >
        </div>
        
        <?php if(isset($jugador->imagen_actual)) { ?>
            <p class="formulario__texto">Imagen Actual</p>
            <div class="formulario__imagen">

            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/build/img/jugadores/' . $jugador->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/build/img/jugadores/' . $jugador->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/build/img/jugadores/' . $jugador->imagen; ?>.png" alt="Imagen Jugador">
            </picture>
                  </div>
        <?php } ?>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>

        <div class="formulario__campo">
                <label for="tags_input" class="formulario__label">Areas de Experiencia (separadas por coma)</label>
                <input 
                    type="text"
                    class="formulario__input" 
                    id="tags_input"
                    placeholder="Ej. MCO, Cadete, Zurdo, ES, Medio Centro Completo"
                    >

                <div id="tags" class="formulario__listado"></div>
                <input type="hidden" name="tags" value="<?php echo $jugador->tags ?? ''; ?>">
            </div>
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
                        placeholder="Facebook"
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
                        placeholder="Twitter"
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
                        name="redes[youtbe]" 
                        placeholder="Youtube"
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
                        placeholder="Instagram"
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
                        placeholder="Tik Tok"
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
                        placeholder="GitHub"
                        value="<?php echo $redes->github ?? ''; ?>"
                    >
               </div>
                
        </div>

</fieldset>