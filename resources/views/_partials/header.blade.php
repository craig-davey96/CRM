<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 02/11/2017
 * Time: 19:52
 */
?>
<html>
<head>
    <title>{{ env('SITE_TITLE') }} | {{ $title }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('css/kanban.css') }}">

</head>
<body>
