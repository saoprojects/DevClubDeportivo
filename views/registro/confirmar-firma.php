<main class="auth">
    <h2 class="auth__heading"> <?php echo $titulo; ?> </h2>
    <p class="auth__texto">Tu cuenta DevClubDeportivo</p>

    <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
    <?php if (isset($alertas['exito'])) { ?>
        <div class="acciones--centrar">
           
        </div>
    <?php } ?>
    
</main>