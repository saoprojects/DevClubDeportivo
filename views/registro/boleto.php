<main class="areaprivada">
    <h2 class="areaprivada__heading"><?php echo $titulo; ?></h2>
   
    <div <?php aos_animacion(); ?> class="areaprivada__grid">
                    <picture>
                        <source srcset="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.webp" type="image/webp">
                        <source srcset="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.png" type="image/png">
                        <img class="speaker__imagen" loading="lazy" width="200" height="300" src="/build/img/usuarios/<?php echo $registro->usuario->imagen; ?>.png" alt="Imagen del usuario <?php echo $registro->usuario->nombre; ?>">
                    </picture>
                
            <div <?php aos_animacion(); ?>>
                        <div class="boleto-virtual" >
                            <div class="boleto boleto--<?php echo strtolower($registro->paquete->nombre); ?> boleto--acceso">
                                <div class="boleto__contenido">
                                    <h4 class="boleto__logo">&#60;/Club Deportivo/></h4>
                                    <p class="boleto__plan"><?php echo $registro->paquete->nombre; ?></p>
                                    <p class="boleto__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido1; ?></p>
                                    <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>
                                </div>
                            </div>
                        </div>
                <div class="__heading">
                    <p>En cumplimiento de lo previsto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo,
                        de 27
                        de abril
                        de 2016, y dado que el derecho a la propia imagen está reconocido en el artículo 18 de la
                        Constitución y
                        regulado por la
                        Ley 1/1982, de 5 de mayo, sobre el derecho al honor, a la intimidad personal y familiar y a la
                        propia
                        imagen le
                        informamos que las imágenes captadas </p>
                </div>
            </div>
            
            <div <?php aos_animacion(); ?>>
                        <div class="boleto-virtual" >
                            <?php include_once __DIR__ . '/infoUsuario.php';?>
                        </div>

                        <div class="__heading">
                            <form method="post" action="/renovacion" class="formulario">
                            <table class="table">
                                <thead class="table__thead">
                                    <tr> <th colspan="2" scope="col" class="table__th">RENOVACIÓN</th></tr>
                                </thead>
                                <tbody class="table__tbody">
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Puedes solicitar la renovación al final de cada temporada para 
                                                    seguir perteneciendo a nuestro ClubDeportivo/</p>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($registro->usuario->id); ?>">
                                <input type="hidden" name="fecha_solicitud" value="<?php echo date('Y-m-d'); ?>">
                                <input type="submit" value="Solicitar Renovación" class="formulario__submit" style="align-self: center;">
                        </form><!-------- FIN DEL FORMULARIO RENOVACION ------->
                    </div>
            </div><!-------- FIN DEL FORMULARIO RENOVACION ------->

            
            <div <?php aos_animacion(); ?>>

            <?php if ($mensajeFirma): ?>
                <table class="table">
                    <thead class="table__thead">
                        <tr> <th colspan="2" scope="col" class="table__th">TRATAMIENTOS DE DATOS</th> </tr>
                    </thead>
                    
                    <tbody class="table__tbody">
                        <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">ENVÍO DE COMUNICACIONES</th> </tr>
                            
                            <tr class="table__tr">
                                <td class="table__td">
                                    <p><?php echo $mensajeFirma; ?></p>
                                </td>
                            </tr>
                    </tbody>
                </table>
                    
            <?php else: ?>
                        <form class="formulario" action="" method="post">

                            <table class="table">
                                <thead class="table__thead">
                                    <tr> <th colspan="2" scope="col" class="table__th">TRATAMIENTOS DE DATOS</th> </tr>
                                </thead>
                                
                                <tbody class="table__tbody">
                                    <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">ENVÍO DE COMUNICACIONES</th> </tr>
                                        
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Finalidad del Tratamiento:</b> solo se tratarán los datos recogidos con objeto de
                                                    enviar e informar sobre avisos, eventos, o información relacionada con las actividades del club a
                                                    los miembros y jugadores/as vinculados al mismo.</p>
                                                </td>

                                            <td class="table__td">
                                                <select class="formulario__input" id="envioComu" name="envioComu" required>
                                                <option disabled selected value="">Seleccione</option>
                                                    <option value="si">Si autorizo</option>
                                                    <option value="no">No autorizo</option>
                                                </select>
                                            </td>
                                        </tr>

                                    <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">USO DE IMÁGENES EN REDES SOCIALES</th> </tr>
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Finalidad del Tratamiento:</b> las imágenes de los jugadores/as o jugadores/as menores
                                                únicamente se tratarán con la finalidad de ser incluidas en cualquiera de las diversas
                                                fotografías y vídeos que se tomen en las distintas actividades, partidos, fiestas, y eventos
                                                propios del club, durante el tiempo que esté inscrita el jugador/a, pudiendo ser expuestas
                                                en las redes sociales del club. Siempre respetando que no se dañe la intimidad, la dignidad y
                                                el honor del jugador/a o jugador/a menor.</p>
                                                </td>
                                            <td class="table__td">
                                                <select class="formulario__input" id="imgRDS" name="imgRDS" required>
                                                <option disabled selected value="">Seleccione</option>
                                                    <option value="si">Si autorizo</option>
                                                    <option value="no">No autorizo</option>
                                                </select>
                                            </td>
                                        </tr>

                                    <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">USO DE IMÁGENES EN LA PÁGINA WEB DEL CLUB</th> </tr>
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Finalidad del Tratamiento:</b> las imágenes de los jugadores/as o jugadores/as menores
                                                    únicamente se tratarán con la finalidad de ser incluidas en cualquiera de las diversas
                                                    fotografías y vídeos que se tomen en las distintas actividades, partidos, fiestas, y
                                                    eventos propios del club, durante el tiempo que esté inscrito el jugador, pudiendo ser expuestas
                                                    en la página web del club. Siempre respetando que no se dañe la intimidad, la dignidad y el
                                                    honor del menor.</p>
                                                </td>
                                            <td class="table__td">
                                                <select class="formulario__input"" id="imgPWeb" name="imgPWeb" required>
                                                <option disabled selected value="">Seleccione</option>
                                                    <option value="si">Si autorizo</option>
                                                    <option value="no">No autorizo</option>
                                                </select>
                                            </td>
                                        </tr>

                                    <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">USO DE IMÁGENES EN PLATAFORMA DE STREAMING</th> </tr>
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Finalidad del Tratamiento:</b> las imágenes de los jugadores/as y jugadores/as menores
                                                    únicamente se tratarán con la finalidad de ser incluidas en las grabaciones y retrasmisiones
                                                    de los partidos captados por la red de videocámaras del campo. Estas serán subidas
                                                    posteriormente a la plataforma de streaming contratada por el club, a la que únicamente
                                                    tendrán acceso los miembros y jugadores/as del club y sus tutores legales.</p>
                                                </td>
                                            <td class="table__td">
                                                <select class="formulario__input" id="imgStr" name="imgStr" required>
                                                <option disabled selected value="">Seleccione</option>
                                                    <option value="si">Si autorizo</option>
                                                    <option value="no">No autorizo</option>
                                                </select>
                                            </td>
                                        </tr>

                                    <tr class="table__tr"> <th colspan="2" scope="col" class="table__th">INCLUSIÓN EN GRUPO DE WHATS APP</th> </tr>
                                        <tr class="table__tr">
                                            <td class="table__td">
                                                <p><b>Finalidad del Tratamiento:</b> los datos recabados únicamente se tratarán para facilitar las
                                                comunicaciones entre el cuerpo técnico, el club y los jugadores/as y padres o tutores por
                                                medio de la aplicación de WhatsApp, por ello requerimos su consentimiento para añadirle al
                                                grupo creado en dicha plataforma por la organización.</p>
                                                </td>
                                            <td class="table__td"><select class="formulario__input" id="iWHATS" name="iWHATS" required>
                                            <option disabled selected value="">Seleccione</option>
                                                    <option value="si">Si autorizo</option>
                                                    <option value="no">No autorizo</option>
                                                </select>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
                            <input type="submit" value="Firmar" class="formulario__submit formulario__submit--registrar">
                    </form>            
                <?php endif; ?>
<!-------- FIN DEL LA FIRMA ------->
            </div>

      
    </div>  
</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleDetails');
        const playerDetails = document.getElementById('playerDetails');

        toggleButton.addEventListener('click', function() {
            if (playerDetails.style.display === "none") {
                playerDetails.style.display = "";
                toggleButton.textContent = 'Ocultar Detalles';
            } else {
                playerDetails.style.display = "none";
                toggleButton.textContent = 'Ver Detalles';
            }
        });
    });
</script> 