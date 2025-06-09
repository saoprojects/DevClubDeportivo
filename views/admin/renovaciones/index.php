<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">

<?php if(!empty($renovacionesPendientes)): ?>
    
    <table class="table">
        <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">ID Renovación</th>
                <th scope="col" class="table__th">Usuario</th>
                <th scope="col" class="table__th">Fecha de Solicitud</th>
                <th scope="col" class="table__th">Acciones</th>
            </tr>
        </thead>

        <tbody class="table__tbody">
            <?php foreach($renovacionesPendientes as $renovacion): ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo htmlspecialchars($renovacion->usuario_id); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($renovacion->usuario->nombre) . ' ' . htmlspecialchars($renovacion->usuario->apellido1); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($renovacion->fecha_solicitud); ?>
                    </td>
                   
                    <td class="table__td--acciones">

                        <form method="POST" action="/admin/renovaciones/aceptar">
                            <input type="hidden" name="id" value="<?php echo $renovacion->id; ?>">
                            <!-- Botón Aceptar -->
                            <button class="table__accion table__accion--editar" type="submit">
                                <i class="fa-solid fa-user-pen"></i> Aceptar
                            </button>
                        </form>

                        <form method="POST" action="/admin/renovaciones/rechazar">
                            <input type="hidden" name="id" value="<?php echo $renovacion->id; ?>">
                            <!-- Botón Rechazar -->
                            <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i> Rechazar
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">No hay renovaciones pendientes</p>
<?php endif; ?>
</div>

<?php
    echo $paginacion;
?>
