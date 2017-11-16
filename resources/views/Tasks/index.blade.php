@extends('_layouts.master')

@section('content')

    <nav aria-label="breadcrumb" role="navigation" class="br-0">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item active" aria-current="page">Tasks</li>
        </ol>
    </nav>

    <section class="rightcolumn">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-info">Add Task</button>

                        <ul class="nav nav-pills pull-right" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#table" role="tab" aria-controls="home" aria-selected="true">List View</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kanban_board" role="tab" aria-controls="profile" aria-selected="false">Kanban View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">

            <div class="tab-pane active" id="table" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered cell-border datatable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Assignees</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-pane" id="kanban_board" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">

                                <div id="kanban"></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('scripts')

    <script>
        $('#kanban').kanban({
            url: '{{ url('tasks/updatetype') }}',
            titles: [
                @foreach($types as $key => $type)
                    '{{ $type->task_type_name }}',
                @endforeach
            ],
            colours: ['#8b8b8b','#0099cb','#bf5329','#cbb956','#2ab27b'],
            items: [
                @foreach($tasks as $key => $task)
                {
                    id: {{ $task->task_id }},
                    title: '{{ $task->task_title }}',
                    block: '{{ $task->task_type_name }}',
                    footer: '{{ date('d/m/Y H:i' , strtotime($task->task_created)) }}'
                },
                @endforeach
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
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
            });
        });
    </script>

@endsection