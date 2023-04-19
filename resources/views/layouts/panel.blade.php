<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DEI | Admin</title>
    <link rel="icon" href="{{ asset('img/temp.png') }}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet"
    >

    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}" defer></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        outline: 0;
        appearance: none;
        border: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
        color: rgb(255 255 255 / var(--tw-text-opacity));
        --tw-text-opacity: 1;
    }

    body {
        margin: 0;
        overflow-x: hidden;
    }

    .contained {
        display: grid;
        grid-template-columns: 14rem auto;
    }

    aside {
        height: 100vh;
        /* background-color: red; */
    }

    aside .top {
        /* background: white; */
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1.4rem;
    }

    aside .close {
        display: none;
    }

    aside .sidebar {
        /* background: red; */
        height: 86.5vh;
    }

    aside .sidebar a {
        display: flex;
        gap: 1rem;
        align-items: center;
        position: relative;
        height: 3.7rem;
        transition: all 300ms ease;
    }

    aside .sidebar a span {
        font-size: 1.6rem;
        transition: all 300ms ease;
    }

    aside .sidebar .exit-sidebar-btn {
        position: absolute;
        bottom: 2rem;
        width: 100%;
    }

    aside .sidebar a.active {
        background-color: rgb(22 78 99 / var(--tw-bg-opacity));
        margin-left: 0;
    }

    aside .sidebar a.active:before {
        content: '';
        width: 6px;
        height: 100%;
        --tw-bg-opacity: 1;
        background-color: rgb(165 243 252 / var(--tw-bg-opacity));
    }

    aside .sidebar a.active h3 {
        --tw-bg-opacity: 1;
        color: rgb(165 243 252 / var(--tw-bg-opacity));
    }

    aside .sidebar a.active span {
        --tw-bg-opacity: 1;
        color: rgb(165 243 252 / var(--tw-bg-opacity));
        margin-left: calc(1rem - 3px);
    }

    aside .sidebar a:hover span {
        color: rgb(165 243 252 / var(--tw-bg-opacity));
        margin-left: 1rem;
    }

    aside .sidebar a:hover, aside .sidebar a:hover h3 {
        color: rgb(165 243 252 / var(--tw-bg-opacity));
    }

    aside .sidebar a:hover span {
        margin-left: 1rem;
    }

    button#hamburger-btn {
        display: none;
    }

    /* TABLE */
    main .table-list {
        margin-top: 2rem;
    }

    main .table-list h2 {
        margin-bottom: 0.8rem;
    }

    main table {
        width: 100%;
        border-radius: 1rem;
        text-align: center;
        background-color: rgb(8 145 178 / var(--tw-bg-opacity));
    }

    table td, table th {
        padding: .5em;
    }

    table tbody > tr {
        border-top: 1px solid ghostwhite;
    }

    main table tbody tr:last-child td {
        border: none;
    }

    main table tbody td a {
        font-weight: bold;
        --tw-bg-opacity: 1;
        color: rgb(165 243 252 / var(--tw-bg-opacity));
    }

    #dropdown {
        display: none;
        align-items: center;
        margin-left: 40px;
        margin-bottom: 30px;
    }

    #dropdown h3 {
        display: flex;
        align-items: center;
    }

    #dropdown h3 span {
        margin-right: 0.5rem;
    }

    /* MEDIA QUERIES - SMALL LAPTOP & TABLETS*/

    @media screen and (max-width: 1200px) {
        .contained {
            width: 94%;
            grid-template-columns: 7rem auto;
        }

        aside .logo h2 {
            display: none;
        }

        aside .sidebar h3 {
            display: none;
        }

        aside .sidebar a {
            widows: 5.6rem;
        }

        /* aside .sidebar a:last-child{
            position: relative;
            margin-top: 1.8rem;
        } */
        main .insights {
            grid-template-columns: 1fr;
            gap: 0;
        }

        main: .table-list {
            width: 88%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            margin: 2rem 0 0 8.8rem;
        }

        main .table-list table {
            width: 82vw;
        }

        /*main table tbody tr td:nth-last-child(2),*/
        /*main table tbody tr td:first-child {*/
        /*    display: none;*/
        /*}*/
        /*main table thead tr th:nth-last-child(2),*/
        /*main table thead tr th:first-child {*/
        /*    display: none;*/
        /*}*/
    }

    /* MEDIA QUERIES - Phones*/
    @media screen and (max-width: 768px) {
        .contained {
            width: 100%;
            grid-template-columns: 1fr;
        }

        aside {
            position: fixed;
            left: 0;
            --tw-bg-opacity: 1;
            background-color: rgb(14 116 144 / var(--tw-bg-opacity));
            width: 18rem;
            z-index: 3;
            box-shadow: 1rem 3rem 4rem black;
            height: 100vh;
            padding-right: 2em;
            display: none;
            animation: showMenu 400ms ease forwards;
        }

        @keyframes showMenu {
            to {
                left: 0;
            }
        }
        aside .logo {
            margin-left: 0;
        }

        aside .logo h2 {
            display: inline;
        }

        aside .sidebar h3 {
            display: inline;
        }

        aside .sidebar a {
            width: 100%;
            height: 3.4rem;
        }

        aside .close {
            display: inline-block;
            cursor: pointer;
        }

        main {
            margin-top: 8rem;
            padding: 0 1rem;
        }

        main .table-list {
            position: relative;
            margin: 5rem 0 0 0;
            width: 100%;
        }

        main .table-list table {
            width: 100%;
            margin: 0;
        }

        .top-bar {
            align-items: center;
        }

        button#hamburger-btn {
            display: inline-block;
            height: 24px;
        }
    }

</style>
<body class="bg-cyan-700">

<div class="contained gap-4 p-1 md:px-8 bg-cyan-700">
    <aside class="px-4 md:px-0">
        <div class="top bg-cyan-700">
            <div class="logo flex flex-row items-center">
                <a href="{{route('home')}}" class="flex flex-row items-center">
                    <img class="h-10" src="{{ asset('img/temp.png') }}" alt="person">
                    <h2 class="ml-2">DEI-ACOLHIMENTO</h2>
                </a>

            </div>
            <div class="close" id="close-btn">
                    <span class="material-icons-round">
                        close
                    </span>
            </div>
        </div>

        <div class="sidebar flex flex-col relative top-12 ">
            <a class="" href="{{route('dashboard_main', 'default')}}">
                    <span class="material-icons-round">
                        space_dashboard
                        </span>
                <h3>Visão Geral</h3>
            </a>
            <a class="" href="{{route('dashboard', 'users')}}">
                    <span class="material-icons-round">
                        people_alt
                    </span>
                <h3>Utilizadores</h3>
            </a>
            <a class="" href="{{route('dashboard', 'topics')}}">
                    <span class="material-icons-round">
                        category
                        </span>
                <h3>Tópicos</h3>
            </a>
            <a class="" href="{{route('dashboard', 'questions')}}">
                    <span class="material-icons-round">
                        contact_support
                        </span>
                <h3>Questões</h3>
            </a>
            <a class="" href="{{route('dashboard', 'posts')}}">
                    <span class="material-icons-round">
                        article
                        </span>
                <h3>Artigos</h3>
            </a>
            <a id="graph_nav" class="" href="{{route('dashboard', 'graphs')}}">
                <h3><span class="material-icons-round">insights</span> Gráficos</h3>
            </a>
            <div id="dropdown" class="">
                <a href="{{ route('dashboard_graphs', 'users') }}">
                    <h3><span class="material-icons-round">people_alt</span> Utilizadores</h3>
                </a>
                <a href="{{ route('dashboard_graphs', 'topics') }}">
                    <h3><span class="material-icons-round">category</span> Tópicos</h3>
                </a>
                <a href="{{ route('dashboard_graphs', 'questions') }}">
                    <h3><span class="material-icons-round">contact_support</span> Questões</h3>
                </a>
            </div>
            <a class="" href="#">
                    <span class="material-icons-round">
                        settings
                     </span>
                <h3>Settings</h3>
            </a>
            <a class="exit-sidebar-btn" href="{{route('home')}}">
                    <span class="material-icons-round">
                        exit_to_app
                    </span>
                <h3>Exit</h3>
            </a>

        </div>
    </aside>

    <main class="mt-2">
        <div class="top-bar flex justify-between">
            <button id="hamburger-btn">
                <span class="material-icons-sharp">menu</span>
            </button>
            <h1 class="font-extrabold text-3xl flex flex-col justify-center" style="color:white">DashBoard</h1>
            <a class="flex justify-end gap-4" href="#">
                <div class="text-right flex flex-col justify-center">
                    <p class="text-xs"><b>{{Auth::user()->name}}</b></p>
                    <small class="text-xs">Admin</small>
                </div>
                <div class="profile-photo">
                    <img class="h-12" src="{{ asset('img/temp.png') }}" alt="profile-image">
                </div>
            </a>
        </div>
        <script>
            const sideMenu = document.querySelector("aside");
            const menuBtn = document.querySelector("#hamburger-btn");
            const closeBtn = document.querySelector("#close-btn");

            menuBtn.addEventListener('click', () => {
                sideMenu.style.display = 'block';
            })

            closeBtn.addEventListener('click', () => {
                sideMenu.style.display = "none";
            })
        </script>

        @yield('content')


    </main>
</div>

</body>
</html>

<script>
    const graph_nav = document.getElementById('graph_nav');
    if (graph_nav.classList.contains('active')) {
        let dropdown = document.getElementById('dropdown');
        console.log(dropdown);
        dropdown.style.display = "block";
    }
</script>