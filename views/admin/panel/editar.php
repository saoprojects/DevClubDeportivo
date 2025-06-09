<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/panel">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php 
        include_once __DIR__ . '../../../templates/alertas.php';
    ?>

    <form method="POST" enctype="multipart/form-data" class="formulario">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" class="formulario__submit" value="Actualizar Cuenta" />
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesion</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Pasword?</a>
    </div>
</div>