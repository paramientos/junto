<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://metroui.org.ua/themes/pandora/vendors/metro4/css/metro-all.css">
    <link rel="stylesheet" href="https://metroui.org.ua/themes/pandora/css/index.css">
    <link rel="stylesheet" href="<?php echo get_app_url('/Public/css/greed.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Pandora - Admin template build with Metro 4</title>

    <script>
        window.on_page_functions = [];
    </script>
</head>
<body class="m4-cloak h-vh-100">
<div data-role="navview" data-toggle="#paneToggle" data-expanded="xl" data-compact="lg" data-active-state="true">
    <div class="navview-pane">
        <div class="bg-cyan d-flex flex-align-center">
            <button class="pull-button m-0 bg-darkCyan-hover">
                <span class="mif-menu fg-white"></span>
            </button>
            <h2 class="text-light m-0 fg-white pl-7" style="line-height: 52px">RMX</h2>
        </div>

        <div class="suggest-box">
            <div class="data-box">
                <img src="images/jek_vorobey.jpg" class="avatar">
                <div class="ml-4 avatar-title flex-column">
                    <a href="#" class="d-block fg-white text-medium no-decor"><span class="reduce-1">Jack Sparrow</span></a>
                    <p class="m-0"><span class="fg-green mr-2">&#x25cf;</span><span class="text-small">online</span></p>
                </div>
            </div>
            <img src="images/jek_vorobey.jpg" class="avatar holder ml-2">
        </div>

        <div class="suggest-box">
            <input type="text" data-role="input" data-clear-button="false" data-search-button="true">
            <button class="holder">
                <span class="mif-search fg-white"></span>
            </button>
        </div>

        <ul class="navview-menu mt-4" id="side-menu">
            <li class="item-header">MAIN NAVIGATION</li>
            <li>
                <a href="#dashboard">
                    <span class="icon"><span class="mif-meter"></span></span>
                    <span class="caption">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#widgets">
                    <span class="icon"><span class="mif-widgets"></span></span>
                    <span class="caption">Widgets</span>
                </a>
            </li>

            <li>
                <a href="#" class="dropdown-toggle">
                    <span class="icon"><span class="mif-devices"></span></span>
                    <span class="caption">Configuration</span>
                </a>
                <ul class="navview-menu stay-open" data-role="dropdown">
                    <li><a href="<?php echo make_url('servers'); ?>">
                            <span class="icon"><span class="mif-spinner2"></span></span>
                            <span class="caption">Servers</span>
                        </a></li>
                    <li><a href="#forms-extended">
                            <span class="icon"><span class="mif-spinner2"></span></span>
                            <span class="caption">Storages</span>
                        </a></li>
                    <li><a href="#forms-layouts">
                            <span class="icon"><span class="mif-spinner2"></span></span>
                            <span class="caption">Databases</span>
                        </a></li>
                </ul>
            </li>


            <li class="item-header">Documentation</li>

        </ul>

        <div class="w-100 text-center text-small data-box p-2 border-top bd-grayMouse"
             style="position: absolute; bottom: 0">
            <div>&copy; 2019 <a href="mailto:sergey@pimenov.com.ua" class="text-muted fg-white-hover no-decor">Sergey
                    Pimenov</a></div>
            <div>Created with <a href="https://metroui.org.ua" class="text-muted fg-white-hover no-decor">Metro 4</a>
            </div>
        </div>
    </div>

    <div class="navview-content h-100">
        <div data-role="appbar" class="pos-absolute bg-darkCyan fg-white">

            <a href="#" class="app-bar-item d-block d-none-lg" id="paneToggle"><span class="mif-menu"></span></a>

            <div class="app-bar-container ml-auto">
                <a href="#" class="app-bar-item">
                    <span class="mif-envelop"></span>
                    <span class="badge bg-green fg-white mt-2 mr-1">4</span>
                </a>
                <a href="#" class="app-bar-item">
                    <span class="mif-bell"></span>
                    <span class="badge bg-orange fg-white mt-2 mr-1">10</span>
                </a>
                <a href="#" class="app-bar-item">
                    <span class="mif-flag"></span>
                    <span class="badge bg-red fg-white mt-2 mr-1">9</span>
                </a>
                <div class="app-bar-container">
                    <a href="#" class="app-bar-item">
                        <img src="images/jek_vorobey.jpg" class="avatar">
                        <span class="ml-2 app-bar-name">Jack Sparrow</span>
                    </a>
                    <div class="user-block shadow-1" data-role="collapse" data-collapsed="true">
                        <div class="bg-darkCyan fg-white p-2 text-center">
                            <img src="images/jek_vorobey.jpg" class="avatar">
                            <div class="h4 mb-0">Jack Sparrow</div>
                            <div>Pirate captain</div>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2">
                            <button class="button flat-button">Followers</button>
                            <button class="button flat-button">Sales</button>
                            <button class="button flat-button">Friends</button>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                            <button class="button mr-1">Profile</button>
                            <button class="button ml-1">Sign out</button>
                        </div>
                    </div>
                </div>
                <a href="#" class="app-bar-item">
                    <span class="mif-cogs"></span>
                </a>
            </div>
        </div>


