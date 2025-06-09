<header class="header">

    <div class="header__contenedor">
        <!-- <nav class="header__navegacion">
            <a href="/registro" class="header__enlace">Registro</a>
            <a href="/login" class="header__enlace">Iniciar Sesion</a>
        </nav> -->
        <nav class="header__navegacion">
            
            <?php if(is_auth()) { ?>
                
                <a href="<?php echo is_admin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__enlace">Administrar</a>
                
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>

            <?php } else { ?>

                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
            
            <?php } ?>
        </nav>
   

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;/Club Deportivo/>
                </h1>
            </a>
            <p class="header__texto"> Octubre 14-15 - 2023</p>
            <p class="header__texto header__texto--modalidad">Presencial - Online</p>
            
            <a href="/registro" class="header__boton">Comprar pase</a>

            </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a  href="/"> 
            <h2 class="barra__logo">
                &#60;/Club Deportivo/>
            </h2> 
        </a>

        <nav class="navegacion">
            <a href="/clubdeportivo" class="navegacion__enlace <?php echo pagina_actual('/clubdeportivo') ? 'navegacion__enlace--actual' : ''; ?>">Club</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : ''; ?>">Paquetes</a>
            <a href="/eventos" class="navegacion__enlace <?php echo pagina_actual('/eventos') ? 'navegacion__enlace--actual' : ''; ?>">Eventos</a>
            <a href="/pruebas" class="navegacion__enlace <?php echo pagina_actual('/pruebas') ? 'navegacion__enlace--actual' : ''; ?>">Pruebas</a>
            <a href="/registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : ''; ?>">Solicitud</a>
        </nav>
    </div>
</div>