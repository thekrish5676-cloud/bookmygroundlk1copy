<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/styledinesh.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/stylekalana.css">
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <!-- Main Header Navigation -->
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">
                <!-- Logo -->
                <a href="<?php echo URLROOT; ?>" class="logo">BookMyGround</a>
                
                <!-- Navigation Menu -->
                <ul class="nav-menu">
                    <li><a href="<?php echo URLROOT; ?>" class="nav-link">Home</a></li>
                    <li><a href="<?php echo URLROOT; ?>/stadiums" class="nav-link">Stadiums</a></li>
                    <li><a href="<?php echo URLROOT; ?>/coach" class="nav-link">Coaches</a></li>
                    <li><a href="<?php echo URLROOT; ?>/sports" class="nav-link">Sports</a></li>
                    <li><a href="<?php echo URLROOT; ?>/rental" class="nav-link">Rental Services</a></li>
                    <!-- Pricing dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" onclick="return false;" aria-haspopup="true" aria-expanded="false">Pricing ▾</a>
                            <ul class="dropdown-menu" aria-label="submenu">
                                <li><a href="<?php echo URLROOT; ?>/pricing" class="dropdown-link">Stadium Owners</a></li>
                                <li><a href="<?php echo URLROOT; ?>/rental_packages" class="dropdown-link">Sports Gear Rental Services</a></li>
                                </ul>
                    </li>

                    <!-- Pages dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" onclick="return false;" aria-haspopup="true" aria-expanded="false">Pages ▾</a>
                            <ul class="dropdown-menu" aria-label="submenu">
                                <li><a href="<?php echo URLROOT; ?>/posts" class="dropdown-link">Blog</a></li>
                                <li><a href="<?php echo URLROOT; ?>/faq" class="dropdown-link">FAQ</a></li>
                                <li><a href="<?php echo URLROOT; ?>/contact" class="dropdown-link">Contact</a></li>
                                </ul>
                    </li>
                </ul>

                <!-- Action Buttons -->
                <div class="nav-actions">
                    <a href="<?php echo URLROOT; ?>/register" class="btn-register">Register</a>
                    <a href="<?php echo URLROOT; ?>/login" class="btn-login">Login</a>
                </div>

                <!-- Mobile Menu Toggle -->
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <script>
    // Small header JS: hamburger toggle + dropdown behavior (works for desktop hover and mobile click)
    document.addEventListener('DOMContentLoaded', function() {
        // Hamburger toggle (mobile)
        var hamburger = document.getElementById('hamburger');
        var navContainer = document.querySelector('.nav-container');
        var navMenu = document.querySelector('.nav-menu');
        if (hamburger && navMenu) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                navMenu.classList.toggle('open'); // toggles mobile menu
            });
        }

        // Dropdown behavior: open on click for mobile, keep hover for desktop via CSS
        var dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                // On small screens, prevent navigation and toggle submenu
                var width = window.innerWidth || document.documentElement.clientWidth;
                if (width <= 900) {
                    e.preventDefault();
                    var parent = toggle.parentElement;
                    parent.classList.toggle('open');
                    var expanded = parent.classList.contains('open');
                    toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
                }
                // On large screens, it's a normal link to /pages (leave default)
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            var target = e.target;
            document.querySelectorAll('.dropdown.open').forEach(function(openDropdown) {
                if (!openDropdown.contains(target)) {
                    openDropdown.classList.remove('open');
                    var t = openDropdown.querySelector('.dropdown-toggle');
                    if (t) t.setAttribute('aria-expanded', 'false');
                }
            });
        });
    });
    </script>