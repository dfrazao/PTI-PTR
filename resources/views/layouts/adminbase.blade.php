<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layouts.app')
@section('navbar')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100%;
            background: #eee;
        }

    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #2c3fb1; z-index: 2;">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <div>
            <img src="/images/logo1.png" style="width: 150px; height: 50px; z-index: 1000;">
        </div>
    </a>
    <a style="margin:auto;text-align:center;color: white" disabled>Admin</a>


    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
        <ul class="nav navbar-nav navbar-right pr-5 m-2 my-lg-0">

            <li class="nav-item">
                <a class="nav-link " href="#"><i class="fa fa-bell"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#"><i class="fa fa-envelope"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> English</a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="#pt"><span class="flag-icon flag-icon-pt"> </span> Portuguese</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-user"></i> User</a>
            </li>

        </ul>
    </div>
</nav>
<style>

    #sidebar-wrapper {

        top: 0;
        height: 100%; /* Full-height: remove this if you want "auto" height */
        width: 10%; /* Set the width of the sidebar */
        position: fixed; /* Fixed Sidebar (stay in place on scroll) */
        background-color: #0;
        z-index: 1;
    }
    #sidebar{
        margin-top: 50% ;
    }
</style>


<!-- Sidebar -->
<div id = "sidebar-wrapper">
    <nav class="navbar navbar-dark " id="sidebar" style="background-color: #2c3fb1;">

        <!-- Links -->
        <ul class="nav navbar-nav navbar-right s" >
            <li class="nav-item">
                <a class="nav-link" href="dashboard">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tables">DB Tables</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="import_data">Import Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="permissions">Permissions</a>
            </li>
        </ul>

    </nav>
</div>
@yield('content')


</body>
</html>
@endsection
