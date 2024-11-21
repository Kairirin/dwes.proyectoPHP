<?php use proyecto\app\utils\Utils;?>
<body>
    
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->
 

<!-- Navbar & Hero Start -->
<div class="container-fluid header position-relative overflow-hidden p-0">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
            <h1 class="display-6 text-primary m-0"><i class="fas fa-gamepad me-3"></i>CommentJuegos</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="/" class="nav-item nav-link <?php if(Utils::esOpcionMenuActiva('/index') || Utils::esOpcionMenuActiva('/')) echo 'active'; ?>">Home</a>
                <a href="/about" class="nav-item nav-link <?php if(Utils::esOpcionMenuActiva('/about')) echo 'active'; ?>">Sobre nosotros</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?php if(Utils::esOpcionMenuActiva('/videojuegos') || Utils::esOpcionMenuActiva('/videojuegos/playstation') || Utils::esOpcionMenuActiva('/videojuegos/xbox') || Utils::esOpcionMenuActiva('/videojuegos/nintendo') || Utils::esOpcionMenuActiva('/videojuegos/retro')) echo 'active'; ?>" data-bs-toggle="dropdown">Videojuegos</a>
                    <div class="dropdown-menu m-0">
                        <a href="/videojuegos" class="dropdown-item">Ver todo</a>
                        <a href="/playstation" class="dropdown-item">Playstation</a>
                        <a href="/xbox" class="dropdown-item">Xbox</a>
                        <a href="/nintendo" class="dropdown-item">Nintendo</a>
                        <a href="/retro" class="dropdown-item">Retro</a>
                    </div>
                </div>
                <a href="/contacto" class="nav-item nav-link <?php if(Utils::esOpcionMenuActiva('/contacto')) echo 'active'; ?>">Contacta</a>
            </div>
            <a href="login" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a>
            <a href="registro" class="btn btn-primary rounded-pill text-white py-2 px-4">Sign Up</a>
        </div>
    </nav>