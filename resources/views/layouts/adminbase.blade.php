@extends('layouts.app')

@section('content')
<style>

    .sidebar {
        height: 100%;
        width: 10%;
        position: fixed;
        z-index: 0;
        top: 0;
        left: 0;
        background-color: #f1f3f4e0;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidebar a {

        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #2c3fb1;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: #2c3fb19e;
        text-shadow: -1px 0 #21252975, 0 1px #21252975, 1px 0 #21252975, 0 -1px #21252975;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #2c3fb1;
        color: white;
        padding: 10px 15px;
        border: none;
        transition: 0.5s;
    }

    .openbtn:hover {
        background-color: #444;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
        position: fixed;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidebar {padding-top: 15px;}
        .sidebar a {font-size: 18px;}
    }
</style>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "10%";
        document.getElementById("main").style.marginLeft = "10%";
        document.getElementsByClassName("openbtn")[0].style.display = "none";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.getElementsByClassName("openbtn")[0].style.display = "inline-block";

    }
</script>
<div id="mySidebar" class="sidebar">
    <div style=" margin-top: 76px;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style=" margin-top: 76px;" >×</a>
    <a href="#"><i class="far fa-user" ></i> Users</a>
    <a href="#"><i class="far fa-book" ></i> Subjects</a>
    <a href="#"><i class="far fa-users"></i> Classes</a>
    <a href="#"><i class="far fa-phone"></i> Contact</a>
    </div>
</div>
<div id="main">
    <button class="openbtn" style="display: none; border-radius: 6px;" onclick="openNav()">☰</button>
</div>
@yield('content2')
@endsection





