<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>
        <a href="/admin/usuarios" class="dashboard__enlace <?php echo pagina_actual('/usuarios') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Usuarios
            </span>
        </a>
        <a href="/admin/anexos" class="dashboard__enlace <?php echo pagina_actual('/anexos') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-phone dashboard__icono"></i>
        <span class="dashboard__menu-texto">
                Anexos
            </span>
        </a>
        <a href="/admin/bloqueados" class="dashboard__enlace <?php echo pagina_actual('/bloqueados') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-lock"></i>
        <span class="dashboard__menu-texto">
                Bloqueados
            </span>
        </a>
        <a href="/admin/troncales" class="dashboard__enlace <?php echo pagina_actual('/troncales') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-building"></i>
        <span class="dashboard__menu-texto">
                Troncales
            </span>
        </a>

        <a  href="/admin/llamadas" class="dashboard__enlace <?php echo pagina_actual('/asterisk') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-asterisk"></i>
        <span class="dashboard__menu-texto">
                Logs Asterisk
            </span>
        </a>
        
        <a href="/admin/logs" class="dashboard__enlace <?php echo pagina_actual('/logs') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid fa-note-sticky"></i>
        <span class="dashboard__menu-texto">
                Visualizador del sistema
            </span>
        </a>
    </nav>
</aside>