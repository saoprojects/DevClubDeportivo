<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/registrados/crear">
            <i class="fa-solid fa-circle-plus"></i>
            Añadir Jugador
        </a>
    </div>

    <div class="dashboard__contenedor">

        <h2 class="speakers__descripcion">Conoce a de nuestro equipo en &lt;ClubDeportivo</h2>
        
        <div class="speakers__grid">
            <?php foreach ($registros as $registro) { ?>
                 <div <?php aos_animacion(); ?> class="speaker">
                    <?php if (isset($registro->usuario->imagen) && !empty($registro->usuario->imagen)) { ?>
                        <picture>
                            <source srcset="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.webp" type="image/webp">
                            <source srcset="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.png" type="image/png">
                            <img class="speaker__imagen" loading="lazy" width="200" height="300" src="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.png" alt="Imagen del usuario <?php echo $registro->usuario->nombre; ?>">
                        </picture>
                    <?php } // cierra if ?>

                    <div class="speaker__informacion">
                        <h4 class="speaker__nombre">
                            <?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido1; ?>
                        </h4>
                        <p class="speaker__ubicacion">
                            <?php echo $registro->usuario->ciudad . ', ' . $registro->usuario->pais; ?>
                        </p>

                        <!-- Sección de redes sociales -->
                        <nav class="speaker-sociales">
                            <?php 
                                $redes = json_decode($registro->usuario->redes);
                            ?>
                        <?php if(!empty($redes->facebook)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                <span class="speaker-sociales__ocultar">Facebook</span>
                            </a> 
                        <?php } ?>

                        <?php if(!empty($redes->twitter)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                <span class="speaker-sociales__ocultar">Twitter</span>
                            </a> 
                        <?php } ?> 

                        <?php if(!empty($redes->youtube)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                                <span class="speaker-sociales__ocultar">YouTube</span>
                            </a> 
                        <?php } ?> 

                        <?php if(!empty($redes->instagram)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                <span class="speaker-sociales__ocultar">Instagram</span>
                            </a> 
                        <?php } ?> 

                        <?php if(!empty($redes->tiktok)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                                <span class="speaker-sociales__ocultar">Tiktok</span>
                            </a> 
                        <?php } ?> 

                        <?php if(!empty($redes->github)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                                <span class="speaker-sociales__ocultar">Github</span>
                            </a>
                        <?php } ?> 
                    </nav>
                

                    <ul class="speaker__listado-skills">
                        <?php 
                            $tags = explode(',', $registro->usuario->tags);
                            foreach($tags as $tag) { 
                        ?>
                            <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php } ?>
                    </ul>

                        <!-- Acciones de editar y eliminar -->
                        <ul class="table__td--acciones">
                            <li class="table__td--acciones">
                                <a class="table__accion table__accion--editar" href="/admin/registrados/editar?id=<?php echo $registro->usuario->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                            </li>
                            <li class="table__td--acciones">
                                <form method="POST" action="/admin/registrados/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $registro->usuario->id; ?>">
                                     <button class="table__accion table__accion--eliminar" type="submit">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Eliminar
                                        </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } // cierra foreach ?>
        </div>
</div>
<?php
    echo $paginacion;
?>

