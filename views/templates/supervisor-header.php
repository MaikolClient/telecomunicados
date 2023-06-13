<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="/supervisor/dashboard">
            <h2 class="dashboard__logo">
                Telecomunicados INC
            </h2>
        </a>


        <nav class="dashboard__nav">
            <a href="/supervisor/perfil" class="dashboard__submit--perfil">
                Bienvenido, <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ;?>
            </a>
            <form method="POST" action="/logout" class="dashboard__form">
                <button class="dashboard__submit--logout" type="submit" onclick="return logout()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </div>
</header>