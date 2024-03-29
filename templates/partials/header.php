<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mermaid's song</title>
    <?php
        require_once('../_inc/functions.php');
        add_stylesheets();
    ?>
</head>
<body class="background">
    <div class="container-fluid background p-0">
        <header>
            <nav class="navbar bg-white">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center justify-content-center gap-2" href="home.php">
                         <img class="p-2" src="../assets/img/logo.jpg" alt="Mermaid's song logo" width="50">
                         <h3>
                        Mermaid's song
                    </h3>
                    </a>
                    <!-- Nav Links -->
                    <div class="d-none d-sm-flex">
                    <ul class="navbar-nav flex-row gap-3 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                    <div class="cart d-flex align-items-center justify-content-center px-3 py-1">
                        <div>100 € | 1 <i class="bi bi-cart"></i></div>
                    </div>
                </div>
                <!-- Toggle button -->
                <button class="navbar-toggler  d-sm-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Side Menu -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="cart d-flex align-items-center justify-content-center px-3 py-1">
                        <div>100 € | 1 <i class="bi bi-cart"></i></div>
                    </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </nav>
        </header>