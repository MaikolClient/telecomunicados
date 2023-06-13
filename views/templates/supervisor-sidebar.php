<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/supervisor/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>
        <a href="/supervisor/usuarios" class="dashboard__enlace <?php echo pagina_actual('/usuarios') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Usuarios
            </span>
        </a>
        <a href="/supervisor/anexos" class="dashboard__enlace <?php echo pagina_actual('/anexos') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-phone dashboard__icono"></i>
        <span class="dashboard__menu-texto">
                Anexos
            </span>
        </a>
        <a href="/supervisor/bloqueados" class="dashboard__enlace <?php echo pagina_actual('/bloqueados') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-lock"></i>
        <span class="dashboard__menu-texto">
                Bloqueados
            </span>
        </a>
        <a  href="/supervisor/llamadas" class="dashboard__enlace <?php echo pagina_actual('/asterisk') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-asterisk"></i>
        <span class="dashboard__menu-texto">
                Logs Asterisk
            </span>
        </a>
        <a href="/supervisor/logs" class="dashboard__enlace <?php echo pagina_actual('/logs') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-note-sticky"></i>
        <span class="dashboard__menu-texto">
                Logs
            </span>
        </a>
    </nav>
</aside>