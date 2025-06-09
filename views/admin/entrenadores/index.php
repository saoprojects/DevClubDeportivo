

<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/entrenadores/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Entrenador
    </a>
</div>
<div class="dashboard__contenedor">
    
    <h2 class="speakers__descripcion">Conoce a de nuestro equipo en &lt;ClubDeportivo</h2>
   
    <div class="speakers__grid">
        <?php foreach($entrenador as $entrenadores) { ?>
            <div <?php aos_animacion(); ?> class="speaker">
                <?php if (isset($entrenadores->imagen) && !empty($entrenadores->imagen)) { ?>
                    <picture>
                        <source srcset="/build/img/entrenadores/<?php echo $entrenadores->imagen; ?>.webp" type="image/webp">
                        <source srcset="/build/img/entrenadores/<?php echo $entrenadores->imagen; ?>.png" type="image/png">
                        <img class="speaker__imagen" loading="lazy" width="200" height="300" src="/build/img/entrenadores/<?php echo $entrenadores->imagen; ?>.png">
                    </picture>
                    
                <?php } // cierra if ?>

                <div class="speaker__informacion">
                    <h4 class="speaker__nombre">
                        <?php echo $entrenadores->nombre . ' ' . $entrenadores->apellido; ?>
                    </h4>

                    

                    <nav class="speaker-sociales">
                        <?php 
                           
                            // Debe ser el objeto individual obtenido del bucle foreach, por ejemplo, $entrenador.
                            $redes = json_decode($entrenadores->redes);
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
                        

                    <ul class="table__td--acciones">
                        <li class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/entrenadores/editar?id=<?php echo $entrenadores->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>    
                                    Editar</a>
                            </li>
                        <li class="table__td--acciones">
                            <form method="POST" action="/admin/entrenadores/eliminar" class="table__formulario">
                                        <input type="hidden" name="id" value="<?php echo $entrenadores->id; ?>">
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

