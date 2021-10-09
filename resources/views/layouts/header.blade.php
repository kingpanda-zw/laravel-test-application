<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="iHx8ABMlr0f3A22AhAIHviccAVZqjGiunzyvefC5u9U" />
    <title>Laravel Test Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none;
        }

        .owl-nav {
            display: block !important;
            color: white;
            text-align: right !important;
            padding-right: 40px;
        }

        .owl-prev,
        .owl-next {
            width: 55px !important;
            height: 55px !important;
            border: 1px solid white !important;
            font-size: 25.5pt !important;
            border-radius: 27.5px !important;
        }

        body {
            overflow-x: hidden;
        }

        .cycle-tab-container {
            margin: 30px auto;
            width: 800px;
            padding: 20px;
            box-shadow: 0 0 10px 2px #ddd;
        }

        .cycle-tab-container a {
            color: #173649;
            font-size: 16px;
            font-family: roboto;
            text-align: center;
        }

        .tab-pane {
            text-align: center;
            height: 100px !important;
            margin: 30px auto;
            width: 500px;
            max-width: 100%;
        }

        .fade {
            opacity: 0;
            transition: opacity 4s ease-in-out;
        }

        .fade.active {
            opacity: 1;
        }

        .cycle-tab-item {
            width: 180px;
        }

        .cycle-tab-item:after {
            display: block;
            content: '';
            border-bottom: solid 3px orange;
            transform: scaleX(0);
            transition: transform 0ms ease-out;
        }

        .cycle-tab-item.active:after {
            transform: scaleX(1);
            transform-origin: 0% 50%;
            transition: transform 5000ms ease-in;
        }


        .nav-link:focus,
        .nav-link:hover,
        .cycle-tab-item.active a {
            border-color: transparent !important;
            color: orange;
        }

        .owl-nav {
            display: block !important;
            color: white;
            text-align: right !important;
            padding-right: 40px;
        }

        .owl-prev,
        .owl-next {
            width: 55px !important;
            height: 55px !important;
            border: 1px solid white !important;
            font-size: 25.5pt !important;
            border-radius: 27.5px !important;
        }

        .modal a.close-modal[class*="icon-"] {
            top: -10px;
            right: -10px;
            width: 20px;
            height: 20px;
            color: #fff;
            line-height: 1.25;
            text-align: center;
            text-decoration: none;
            text-indent: 0;
            background: red;
            border: 2px solid #fff;
            -webkit-border-radius: 26px;
            -moz-border-radius: 26px;
            -o-border-radius: 26px;
            -ms-border-radius: 26px;
            -moz-box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            -webkit-box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .modal {
            max-width: 60vw;
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .modal {
                max-width: 85vw !important;
            }
        }

        #viewer {
            width: 100vw;
            height: 50vh;
        }

        #product_viewer {
            max-width: 75%;
            margin: 50px auto;
        }

        #product_viewer img {
            display: block;
            width: 100%;
        }

    </style>

    <style>
        #checkbox:checked+label .switch-ball {
            background-color: white;
            transform: translateX(20px);
            transition: transform 0.3s linear;
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
</head>
