<table class="table">
                    <thead class="table__thead">
                        <tr>
                            <th colspan="2" scope="col" class="table__th">
                            DATOS DEL JUGADOR
                            </th>

                            <tr class="table__tr">
                                <th colspan="2" scope="col" class="table__th">
                                    <nav class="speaker-sociales" style="display: flex; justify-content: center;">
                                            <?php $redes = json_decode($registro->usuario->redes); ?>
                                            
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
                                </th>
                            </tr>    
                        </tr>
                    </thead>
                    <tbody class="table__tbody">
                        <tr class="table__tr"> 
                            <th colspan="2" scope="col" class="table__th">
                                <ul class="speaker__listado-skills" style="display: flex; justify-content: center;">
                                    <?php 
                                        $tags = explode(',', $registro->usuario->tags);
                                        foreach($tags as $tag) { 
                                    ?>
                                        <li class="speaker__skill"><?php echo $tag; ?></li>
                                    <?php } ?>
                                </ul>

                            </th> 
                        </tr>
                            
                            <tr class="table__tr">
                                <td class="table__td">
                                <button id="toggleDetails" class="toggle-button formulario__submit">Ver Detalles</button>
                                </td>
                            </tr>
                    </tbody>

                    <tbody id="playerDetails" class="table__tbody" style="display: none;">
                        <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">DNI: <?php echo $registro->usuario->dni; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Nombre y Apellidos: <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido1 . " " . $registro->usuario->apellido2; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Email: <?php echo $registro->usuario->email; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Estado: <?php echo $registro->usuario->estado; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Teléfono: <?php echo $registro->usuario->telefono; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Género: <?php echo $registro->usuario->genero; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Nombre del Padre: <?php echo $registro->usuario->padre; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Correo del Padre: <?php echo $registro->usuario->correo_padre; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Nombre de la Madre: <?php echo $registro->usuario->madre; ?></p>
                                    </td>
                                </tr>
                                <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Correo de la Madre: <?php echo $registro->usuario->correo_madre; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Fecha de Nacimiento: <?php echo $registro->usuario->fecha_nacimiento; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Dirección: <?php echo $registro->usuario->direccion . ", " . $registro->usuario->ciudad . ", CP: " . $registro->usuario->codigo_postal; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">País: <?php echo $registro->usuario->pais . ", Nacionalidad: " . $registro->usuario->nacionalidad; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Categoría: <?php echo $registro->usuario->categoria . ", Grupo: " . $registro->usuario->grupo . ", Federado: " . $registro->usuario->federado; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Alergias: <?php echo $registro->usuario->alergias; ?></p>
                                    </td>
                                </tr>
                            <tr class="table__tr">
                                    <td class="table__td">
                                    <p class="formulario__campo">Información Adicional: <?php echo $registro->usuario->informacion; ?></p>
                                    </td>
                                </tr>
                    </tbody>
            </table> 
<!-------- FIN DE LA TABLA INFORMACION USUARIO ------->     
