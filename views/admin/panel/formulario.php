<form method="POST" action="/registro" class="formulario">
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Datos Personales</legend>

        <div class="formulario__campo">
            <label for="dni" class="formulario__label">Documentación</label>
                <input 
                    type="text" 
                    class="formulario__input"
                    id="dni" 
                    name="dni"
                    placeholder="Ej:05329900Z" maxlength="9"
                    title="DNI incorrecto o formato incorrecto"
                    value="<?php echo $usuario->dni ?? ''; ?>"
                    />
                    <span id="dni-error" class="formulario__error" style="display: none; color: red;">
                        DNI no válido
                    </span>
            </div>  
       
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="nombre" 
                id="nombre"
                placeholder="Ej: Ricardo"
                maxlength="20"
                value="<?php echo $usuario->nombre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="apellido1" class="formulario__label">Primer Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="apellido1" 
                id="apellido1"
                placeholder="Ej: Mendez"
                maxlength="20"
                value="<?php echo $usuario->apellido1 ?? ''; ?>"
                >
        </div>
        <div class="formulario__campo">
            <label for="segundo_apellido" class="formulario__label">Segundo Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="apellido2" 
                id="apellido2"
                placeholder="Ej: Cuellar"
                maxlength="20"
                value="<?php echo $usuario->apellido2 ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Introduce e-mail"
                id="email"
                name="email"
                maxlength="50"
                value="<?php echo $usuario->email ?? ''; ?>"
                />
            </div>  

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Contraseña"
                id="password"
                name="password"
                maxlength="20"
                value="<?php echo $usuario->password ?? ''; ?>"
            />
        </div>

        <div class="formulario__campo">
                <label for="password2" class="formulario__label">Repetir Contraseña</label>
                <input 
                    type="password"
                    class="formulario__input"
                    placeholder="Repetir contraseña"
                    id="password2"
                    name="password2"
                    maxlength="20"
                    value="<?php echo $usuario->password ?? ''; ?>"
                />
        </div>            

        <div class="formulario__campo">
            <label for="padre" class="formulario__label">Nombre del Padre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="padre" 
                id="padre"
                placeholder="Ej: Oscar"
                maxlength="40"
                value="<?php echo $usuario->padre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="correo_padre" class="formulario__label">Correo del Padre</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Introduce e-mail del padre"
                id="correo_padre"
                name="correo_padre"
                maxlength="50"
                value="<?php echo $usuario->correo_padre ?? ''; ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="madre" class="formulario__label">Nombre de la Madre</label>
            <input 
                type="text"
                class="formulario__input" 
                name="madre" 
                id="madre"
                placeholder="Ej: Marlene"
                maxlength="40"
                value="<?php echo $usuario->madre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="correo_madre" class="formulario__label">Correo de la Madre</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Introduce e-mail de la madre"
                id="correo_madre"
                name="correo_madre"
                maxlength="50"
                value="<?php echo $usuario->correo_madre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Teléfono</label>
            <input 
                type="tel"
                class="formulario__input"
                placeholder="Teléfono del Padre o de la Madre"
                id="telefono"
                name="telefono"
                maxlength="9"
                value="<?php echo $usuario->telefono ?? ''; ?>"
                />
        </div>
            
        <div class="formulario__campo">
            <label for="genero" class="formulario__label">Genero</label>
                <select class="formulario__input" id="genero" name="genero">
                            <!-- <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option> -->
                            <option value="masculino" <?php echo ($usuario->genero == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                            <option value="femenino" <?php echo ($usuario->genero == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                        </select>
                        
        </div>

        <div class="formulario__campo">
            <label for="fecha_nacimiento" class="formulario__label">Fecha de Nacimiento</label>
                <input 
                type="date" 
                class="formulario__input" 
                id="fecha_nacimiento" 
                name="fecha_nacimiento"
                value="<?php echo $usuario->fecha_nacimiento ?? ''; ?>" required
               >

            </div>

            <div class="formulario__campo">
                <label for="direccion" class="formulario__label">Direccion</label>
                        <input 
                            type="text" 
                            class="formulario__input"  
                            id="direccion"
                            name="direccion"
                            placeholder="Ej: C/Madrid 22 4D"
                            maxlength="50"
                            value="<?php echo $usuario->direccion ?? ''; ?>"
                            >
                </div>
            <div class="formulario__campo">
                <label for="codigo_postal" class="formulario__label">Codigo Postal</label>
                    <input 
                        type="number" 
                        class="formulario__input"
                        id="codigo_postal"
                        name="codigo_postal"
                        placeholder="Ej: 29900" min="1" max="99999" title="Solo 5 dígitos númericos"
                        maxlength="5"
                        value="<?php echo $usuario->codigo_postal ?? ''; ?>"
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
                    value="<?php echo $usuario->ciudad ?? ''; ?>"
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
                    value="<?php echo $usuario->pais ?? ''; ?>"
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
                        value="<?php echo $usuario->nacionalidad ?? ''; ?>"
                        >
                </div>

                <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                   
                    <!-- Campos exclusivos para administradores aquí -->
                    <div class="formulario__campo">
                        <label for="categoria" class="formulario__label">Catégoria</label>
                            <select class="formulario__input" id="categoria" name="categoria">
                                <option disabled selected value="">Seleccione</option>
                                <option value="juvenil" <?php echo ($usuario->categoria == 'juvenil') ? 'selected' : ''; ?>>Juvenil</option>
                                <option value="cadete" <?php echo ($usuario->categoria == 'cadete') ? 'selected' : ''; ?>>Cadete</option>
                                <option value="infantil" <?php echo ($usuario->categoria == 'infantil') ? 'selected' : ''; ?>>Infantil</option>
                                <option value="alevin" <?php echo ($usuario->categoria == 'alevin') ? 'selected' : ''; ?>>Alevín</option>
                                <option value="benjamin" <?php echo ($usuario->categoria == 'benjamin') ? 'selected' : ''; ?>>Benjamín</option>
                                <option value="prebenjamin" <?php echo ($usuario->categoria == 'prebenjamin') ? 'selected' : ''; ?>>Prebenjamín</option>
                            </select>          
                    </div>
                <?php endif; ?>
        
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                <!-- Campos exclusivos para administradores aquí -->
                <div class="formulario__campo">
                    <label for="grupo" class="formulario__label">Grupo</label>
                        <select class="formulario__input" id="grupo" name="grupo">
                            <option disabled selected value="">Seleccione</option>
                            <option value="A" <?php echo ($usuario->grupo == 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?php echo ($usuario->grupo == 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?php echo ($usuario->grupo == 'C') ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?php echo ($usuario->grupo == 'D') ? 'selected' : ''; ?>>D</option>
                        </select>          
                </div>
            <?php endif; ?>

        

        <div class="formulario__campo">
            <label for="federado" class="formulario__label">¿Federado?</label> 
                        <select class="formulario__input" id="federado" name="federado">
                            <!-- <option value="si">Si</option>
                            <option value="no">No</option> -->
                            <option value="si" <?php echo ($usuario->federado == 'si') ? 'selected' : ''; ?>>Si</option>
                            <option value="no" <?php echo ($usuario->federado == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
            </div>

        <div class="formulario__campo">
            <label for="nadar" class="formulario__label">¿Sabe nadar?</label> 
                        <select class="formulario__input" id="nadar" name="nadar">
                            <!-- <option value="si">Si</option>
                            <option value="no">No</option> -->
                            <option value="si" <?php echo ($usuario->nadar == 'si') ? 'selected' : ''; ?>>Si</option>
                            <option value="no" <?php echo ($usuario->nadar == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
            </div>

        <div class="formulario__campo">
            <label for="alergias" class="formulario__label">¿Tiene alergias?</label> 
                        <select class="formulario__input" id="alergias" name="alergias">
                            <!-- <option value="si">Si</option>
                            <option value="no">No</option> -->
                            <option value="si" <?php echo ($usuario->alergias == 'si') ? 'selected' : ''; ?>>Si</option>
                            <option value="no" <?php echo ($usuario->alergias == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
            </div>

        <div class="formulario__campo">
                <label for="informacion" class="formulario__label">¿Información extra que se quiera comunicar al club?</label>
                    <textarea class="formulario__input" id="informacion" name="informacion" rows="4" cols="50" placeholder="¿Preferencias?, ¿Posibles alergias?"><?php echo $usuario->informacion; ?></textarea>
            </div>
            
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                <!-- Campos exclusivos para administradores aquí -->
                <div class="formulario__campo">
                    <label for="imagen" class="formulario__label">Imagen</label>
                    <input 
                        type="file"
                        class="formulario__input formulario__input--file" 
                        name="imagen" 
                        id="imagen" >
                </div>
        
                <?php if(isset($usuario->imagen_actual)) { ?>
                    <p class="formulario__texto">Imagen Actual</p>
                    <div class="formulario__imagen">
                        <picture>
                            <source srcset="<?php echo $_ENV['HOST'] . '/build/img/usuarios/' . $usuario->imagen; ?>.webp" type="image/webp">
                            <source srcset="<?php echo $_ENV['HOST'] . '/build/img/usuarios/' . $usuario->imagen; ?>.png" type="image/png">
                            <img src="<?php echo $_ENV['HOST'] . '/build/img/usuarios/' . $usuario->imagen; ?>.png" alt="Imagen Jugador">
                        </picture>
                    </div>
                <?php } ?>
            <?php endif; ?>
</fieldset>


<?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <!-- Campos exclusivos para administradores aquí -->
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>

        <div class="formulario__campo">
                <label for="tags_input" class="formulario__label">Atributos del Jugador (separadas por coma)</label>
                <input 
                    type="text"
                    class="formulario__input" 
                    id="tags_input"
                    placeholder="Ej. MCO, Cadete, Zurdo, ES, Medio Centro Completo"
                    >

                <div id="tags" class="formulario__listado"></div>
                <input type="hidden" name="tags" value="<?php echo $usuario->tags ?? ''; ?>">
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
                        name="redes[youtube]" 
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
<?php endif; ?>

<script>
   function validarDNI(dni) {
    var numero;
    var letr;
    var letra;
    var expresion_regular_dni;
    
    expresion_regular_dni = /^\d{8}[a-zA-Z]$/; // Expresión regular para DNI
    var expresion_regular_nie = /^[XYZ]\d{7}[a-zA-Z]$/; // Expresión regular para NIE
    
    dni = dni.toUpperCase();

    if(expresion_regular_dni.test(dni) || expresion_regular_nie.test(dni)) {
        if(expresion_regular_nie.test(dni)) {
            dni = dni.replace('X', '0')
                     .replace('Y', '1')
                     .replace('Z', '2');
        }
        
        numero = dni.substr(0, dni.length - 1);
        numero = parseInt(numero);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);

        if (letra != letr) {
            return false; // La letra no coincide con el número
        } else {
            return true; // DNI válido
        }
    } else {
        return false; // Formato no válido
    }
}

document.getElementById('dni').addEventListener('input', function(e) {
    var mensajeError = document.getElementById('dni-error');
    var valido = validarDNI(e.target.value);
    
    mensajeError.style.display = valido ? 'none' : 'block'; // Cambia la visibilidad del mensaje de error
});

</script>
