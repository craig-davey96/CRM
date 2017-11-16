<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 02/11/2017
 * Time: 19:50
 */
?>

@extends('_layouts.master')

@section('content')

    <nav aria-label="breadcrumb" role="navigation" class="br-0">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <section class="rightcolumn">

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Revenue By Month</strong>
                        <hr>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Activity Log</strong>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Tasks</strong>
                        <hr>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Bookings</strong>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Support Tickets</strong>
                        <hr>
                    </div>
                </div>
            </div>

        </div>



    </section>

@endsection
