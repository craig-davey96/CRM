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

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addTaskModal">Add Task</button>

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
                                            <th width="10%">Status</th>
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

    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="{{ url('tasks/create') }}" method="post" id="needs-validation" novalidate>

                {{ csrf_field() }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Task Title *</label>
                            <input type="text" name="task_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Task Description *</label>
                            <textarea name="task_description" class="form-control" required rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Task Assignees *</label>
                            <select class="form-control" name="assignees[]" multiple>
                                @foreach($users as $key => $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Tasks</label>
                            <div class="subTasks">

                                    <div class="input-group mb-1">
                                        <input type="text" name="sub[0][desc]" class="form-control">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onClick="addSubTask()"><i class="ion-md-add"></i></button>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

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
                    footer: '{{ date('d/m/Y H:i' , strtotime($task->task_created)) }}',
                },
            @endforeach
            ]
        });

        function addSubTask(e){

            var container = $('.subTasks');
            var count = container.find('div.input-group').lenth;

            var item =  '<div class="input-group mb-1">';
                item +=      '<input type="text" name="sub['+count+'][desc]" class="form-control">';
                item +=      '<div class="input-group-btn">';
                item +=          ' <button type="button" class="btn btn-danger" onClick="removeSubTask(this)"><i class="ion-md-remove"></i></button>';
                item +=      '</div>';
                item +=   '</div>';

            container.append(item);

        }

        function removeSubTask(element){
            $(element).parents('.input-group').remove();
        }

    </script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax: '{{ url('tasks/getdata') }}',
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
                    },
                    {
                    text: 'Reload',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                        }
                    }
                ],
                columns: [
                    {data: 'task_id', name: 'task_id'},
                    {data: 'task_title', name: 'task_title'},
                    {data: 'task_description', name: 'task_description'},
                    {data: 'assignees', name: 'assignees'},
                    {data: 'status', name: 'status' , html: true}
                ]
            });
        });
    </script>

@endsection