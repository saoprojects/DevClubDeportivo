<main class="pagina">
    <h2 class="pagina__heading"><?php echo "Área Privada de " . $usuario->nombre . " " . $usuario->apellido1; ?></h2>
    <p class="pagina__descripcion">Aquí puedes revisar tus datos y tu boleto. Recuerda mantener tus datos actualizados.</p>

    <!-- Sección del Boleto -->
    <div class="boleto-virtual">
        <div class="boleto boleto--<?php echo strtolower($registro->paquete->nombre); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;/Club Deportivo/></h4>
                <p class="boleto__plan"><?php echo $registro->paquete->nombre; ?></p>
                <p class="boleto__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido1; ?></p>
            </div>
            <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>
        </div>
    </div>
<!-- area_privada.php -->

    <h1>Área Privada</h1>
    <div>
        <h2>Información del Usuario</h2>
        <p>Nombre: <?php echo $usuario->nombre; ?></p>
        <!-- Más información del usuario -->
    </div>
    <?php if ($registro): ?>
        <div>
            <h2>Información del Registro</h2>
            <p>Paquete: <?php echo $paquete->nombre; ?></p>
            <p>Token de Boleto: <?php echo $registro->token; ?></p>
            <!-- Más información del registro -->
        </div>
    <?php else: ?>
        <p>No hay información de registro disponible.</p>
    <?php endif; ?>


</main>