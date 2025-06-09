<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    
<?php if(!empty($usuariosPendientes)): ?>
        
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre y Apellido</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($usuariosPendientes as $usuario): ?>
                    
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo htmlspecialchars($usuario->nombre) . ' ' . htmlspecialchars($usuario->apellido1); ?>
                        </td>
                       
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/panel/editar?id=<?php echo $usuario->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>    
                                    Editar
                                    </a>

                        <form method="POST" action="/admin/panel/usuarios/aceptar">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <!-- Botón Aceptar -->
                                <button class="table__accion table__accion--editar" type="submit">
                                    <i class="fa-solid fa-user-pen"></i> Aceptar
                                </button>
                            </form>
                        <form method="POST" action="/admin/panel/usuarios/rechazar">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
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
        <p class="text-center">No hay usuarios pendientes</p>
    <?php endif; ?>
</div>

<?php
    echo $paginacion;
?>