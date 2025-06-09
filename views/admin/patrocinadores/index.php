<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/patrocinadores/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Patrocinador
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($patrocinadores)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Patrocinador</th>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th">Rango</th>
                    <th scope="col" class="table__th">Logo</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            
            <tbody class="table__tbody">
                <?php foreach($patrocinadores as $patrocinador) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $patrocinador->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $patrocinador->descripcion; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $patrocinador->rango->nombre; ?>
                        </td>
                        <td class="table__td" style="width: 20%;">
                            <img src="../build/img/logos/<?php echo $patrocinador->logo; ?>" alt="Logo">
                        </td>
                        
                        <td class="table__td--acciones">
                            <div class="table__td">
                           <a class="table__accion table__accion--editar" href="/admin/patrocinadores/editar?id=<?php echo $patrocinador->id; ?>">
                            <i class="fa-solid fa-pencil"></i>    
                            Editar
                            </a>
                            <br><br>
                            <form method="POST" action="/admin/patrocinadores/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $patrocinador->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                            </div>
                        </td>    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Patrocinadores Aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>
