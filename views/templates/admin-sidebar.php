<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>
        <a href="/admin/panel" class="dashboard__enlace <?php echo pagina_actual('/panel') ? 'panel__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-address-card dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Solicitudes
            </span>
        </a>

        <a href="/admin/renovaciones" class="dashboard__enlace <?php echo pagina_actual('/renovaciones') ? 'panel__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-repeat dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Renovación
            </span>
        </a>

        <a href="/admin/registrados" class="dashboard__enlace <?php echo pagina_actual('/registrados') ? 'resgistrados__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-futbol dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Jugadores
            </span>
        </a>

        <a href="/admin/eventos" class="dashboard__enlace <?php echo pagina_actual('/eventos') ? 'eventos__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-calendar dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Eventos
            </span>
        </a>

        
        <a href="/admin/entrenadores" class="dashboard__enlace <?php echo pagina_actual('/entrenadores') ? 'entrenadores__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Entrenadores
            </span>
        </a>

        <a href="/admin/patrocinadores" class="dashboard__enlace <?php echo pagina_actual('/patrocinadores') ? 'resgistrados__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-handshake dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Patrocinadores
            </span>
        </a>

        <!-- <a href="/admin/equipacion" class="dashboard__enlace <?php echo pagina_actual('/equipacion') ? 'equipacion__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-shirt dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Equipación
            </span>
        </a> -->

    </nav>
</aside>