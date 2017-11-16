<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 02/11/2017
 * Time: 19:58
 */
?>

<aside id="menu" class="sidebar">

    <div class="col-12">
        <form action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Search...">
                <div class="input-group-btn">
                    <button class="btn btn-primary">GO</button>
                </div>
            </div>
        </form>
    </div>

    <ul class="menu_ul">
        <li class="menu_item"><a href=""><i class="ion-md-grid"></i> Dashboard</a></li>
        <li class="menu_item"><a href=""><i class="ion-md-people"></i> Customers</a></li>
        <li class="menu_item">
            <a href="" class="dropdown"><i class="ion-md-pricetag"></i> Sales</a>
            <ul class="dropdown">
                <li><a href="{{ url('sales/proposals') }}"><i class="ion-md-arrow-dropright"></i> Proposals</a></li>
                <li><a href="{{ url('sales/estimates') }}"><i class="ion-md-arrow-dropright"></i> Estimates</a></li>
                <li><a href="{{ url('sales/invoices') }}"><i class="ion-md-arrow-dropright"></i> Invoices</a></li>
                <li><a href="{{ url('sales/items') }}"><i class="ion-md-arrow-dropright"></i> Items</a></li>
            </ul>
        </li>
        <li class="menu_item"><a href=""><i class="ion-md-calendar"></i> Events</a></li>
        <li class="menu_item"><a href=""><i class="ion-md-chatboxes"></i> Support</a></li>
        <li class="menu_item"><a href="{{ url('tasks') }}"><i class="ion-md-checkbox"></i> Tasks</a></li>
        <li class="menu_item">
            <a href="" class="dropdown"><i class="ion-md-stats"></i> Reports</a>
            <ul class="dropdown">
                <li><a href=""><i class="ion-md-arrow-dropright"></i> Sales</a></li>
            </ul>
        </li>
    </ul>

</aside>
