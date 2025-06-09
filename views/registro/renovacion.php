<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <?php if($renovacionExitosa): ?>
        <p class="pagina__descripcion">Tu solicitud de renovación ha sido enviada correctamente y está en proceso de revisión.</p>
    <?php elseif($huboError): ?>
        <p class="pagina__descripcion"><?php echo $mensajeError; ?></p>
    <?php else: ?>
        <!-- Formulario de solicitud de renovación -->
    <?php endif; ?>
</main>
