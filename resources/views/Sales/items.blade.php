<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/11/2017
 * Time: 18:40
 */
?>
@extends('_layouts.master')

@section('content')

    <nav aria-label="breadcrumb" role="navigation" class="br-0">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item" aria-current="page">Sales</li>
            <li class="breadcrumb-item active" aria-current="page">Items</li>
        </ol>
    </nav>

    <section class="rightcolumn">


        @if(Session::has('success'))
            <div class="alert alert-success"><em> {!! session('success') !!}</em></div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newItemModal">Create Item</button>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#newItemModal">Item Groups</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Items List</strong>
                        <hr>
                        <table class="table table-bordered datatable cell-border" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Item Price (&pound;)</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- *** MODAL *** -->

    <div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('sales/items/post') }}" method="post" id="needs-validation" novalidate>
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newItemModalLabel">Create Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="item_name">Item Name *</label>
                            <input type="text" id="item_name" required name="item_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="item_desc">Item Description *</label>
                            <textarea name="item_desc" id="item_desc" required rows="8" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="item_price">Item Price *</label>
                            <div class="input-group">
                                <div class="input-group-addon">&pound;</div>
                                <input type="number" id="item_price" required name="item_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_price">Search Tags</label>
                        </div>
                        <div class="form-group">
                            <label for="item_group">Item Group *</label>
                            <select name="item_group" required id="item_group" class="form-control">
                                <option selected disabled>Please Select</option>
                            </select>
                        </div>
                        <small>(*) Required Fields</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax: '{{ url('sales/items/getdata') }}',
                buttons: [
                    { extend: 'pageLength', },
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                        ]
                    }
                ],
                columns: [
                    {data: 'sales_item_name', name: 'sales_item_name'},
                    {data: 'sales_item_description', name: 'sales_item_description'},
                    {data: 'sales_item_price', name: 'sales_item_price'},
                    {data: 'sales_item_id', name: 'sales_item_id'},
                    {data: 'action', name: 'action' , searchable: false , sortable: false}
                ]
            });
        });
    </script>

@endsection
