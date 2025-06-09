<main class="auth">
    <h2 class="auth__heading"> <?php echo $titulo; ?> </h2>
    <p class="auth__texto">Solicitar registro en &lt;ClubDeportivo/></p>

    <?php
        require_once __DIR__ . '../../templates/alertas.php';
    ?>

    <div class="dashboard__formulario">
            <?php 
                include_once __DIR__ . '../../templates/alertas.php';
            ?>

            <form method="POST" enctype="multipart/form-data" class="formulario">

                <?php include_once __DIR__ . '../../admin/panel/formulario.php'; ?>

            <input type="submit" class="formulario__submit" value="Solicitar Inscripción" />
            
            </form>

            <div class="acciones">
                <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesion</a>
                <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Pasword?</a>
            </div>
    </div>
</main>

<!-- <main class="auth">
    <form method="POST" action="/registro" class="formulario">

    <div class="formulario__campo">
            <label for="dni" class="formulario__label">D.N.I.</label>
                <input 
                    type="text" 
                    class="formulario__input"
                    id="dni" 
                    name="dni"
                    placeholder="Ej:37663995Z" maxlength="9"
                    title="DNI incorrecto o formato incorrecto"
                    value="<?php echo $usuario->dni ?? ''; ?>"
                    />
        </div>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text"
            class="formulario__input"
            placeholder="Tu Nombre"
            id="nombre"
            name="nombre"
            placeholder="Nombre Jugador"
            value="<?php echo $usuario->nombre ?? ''; ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="apellido1" class="formulario__label">Primer Apellido</label>
        <input 
            type="text"
            class="formulario__input" 
            name="apellido1" 
            id="apellido1"
            placeholder="Primer Apellido Jugador"
            value="<?php echo $usuario->apellido1 ?? ''; ?>"
            >
        </div>
        <div class="formulario__campo">
            <label for="apellido2" class="formulario__label">Segundo Apellido</label>
            <input 
                type="text"
                class="formulario__input" 
                name="apellido2" 
                id="apellido2"
                placeholder="Segundo Apellido Jugador"
                value="<?php echo $usuario->apellido2 ?? ''; ?>"
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
            value="<?php echo $usuario->email ?? ''; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Password</label>
        <input 
            type="password"
            class="formulario__input"
            placeholder="Tu Password"
            id="password"
            name="password"
        />
    </div>
    <div class="formulario__campo">
        <label for="password2" class="formulario__label">Repetir Password</label>
        <input 
            type="password"
            class="formulario__input"
            placeholder="Repetir Password"
            id="password2"
            name="password2"
        />
    </div>

    <div class="formulario__campo">
            <label for="padre" class="formulario__label">Padre o Tutor</label>
            <input 
                type="text"
                class="formulario__input" 
                name="padre" 
                id="padre"
                placeholder="Nombre del Padre"
                value="<?php echo $usuario->padre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="madre" class="formulario__label">Madre o Tutora</label>
            <input 
                type="text"
                class="formulario__input" 
                name="madre" 
                id="madre"
                placeholder="Nombre de la Madre"
                value="<?php echo $usuario->madre ?? ''; ?>"
                >
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Teléfono del Padre o de la Madre</label>
            <input 
                type="tel"
                class="formulario__input"
                placeholder="Ingrese un teléfono"
                id="telefono"
                name="telefono"
                value="<?php echo $usuario->telefono ?? ''; ?>"
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
                            placeholder="Ej: C/Madrid 22 4D" required title="Sin comas o puntos"
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
                        placeholder="Ej: 29900" min="1" max="99999" required title="Solo 5 dígitos númericos"
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

    <input type="submit" class="formulario__submit" value="Crear Cuenta" />
    
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesion</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Pasword?</a>
    </div>
    
</main> -->

