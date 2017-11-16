<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskAssignees;
use App\Tasks;
use App\TaskTypes;
use DataTables;

use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /** INDEX */

    public function index(){

        $data['users'] = DB::table('users')->select('name','id')->get();

        $data['types'] = TaskTypes::all();
        $tasks = DB::table('tasks')->select('*','tasks.created_at as task_created')->join('task_types', 'tasks.task_type', '=', 'task_types.task_type_id')->get();
        $data['tasks'] = array();

        foreach ($tasks as $key => $task){
            $data['tasks'][$key] = new \stdClass();
            $data['tasks'][$key] = $task;
            $data['tasks'][$key]->assignees = DB::table('task_assignees')->select('task_assignees.*','users.name')->where('task_assignee_task' , $task->task_id)->join('users', 'users.id', '=', 'task_assignees.task_assignee_link_id')->get();
        }

        return $this->_renderpage('tasks.index' , 'Tasks' , $data);

    }

    /** UPDATE TASK TYPE */

    public function updateTaskType(Request $request){

        switch($request->input('block')){
            case 'Pending':
                $type = 4;
                break;
            case 'In Progress':
                $type = 5;
                break;
            case 'Initial Testing':
                $type = 6;
                break;
            case 'Final Testing':
                $type = 7;
                break;
            case 'Complete':
                $type = 8;
                break;
        }

        switch($request->input('type')){
            case 'Kanban':
                DB::table('tasks')->where('task_id' , $request->input('id'))->update(['task_type' => $type]);
                break;
        }

    }

    /** DATATABLES ITEMS */

    public function itemsDT(){

        $tasks = DB::table('tasks')->select('*','tasks.created_at as task_created')->join('task_types', 'tasks.task_type', '=', 'task_types.task_type_id')->get();
        $data['tasks'] = array();

        foreach ($tasks as $key => $task){
            $data['tasks'][$key] = new \stdClass();
            $data['tasks'][$key] = $task;
            $data['tasks'][$key]->assignees = DB::table('task_assignees')->select('task_assignees.*','users.name')->where('task_assignee_task' , $task->task_id)->join('users', 'users.id', '=', 'task_assignees.task_assignee_link_id')->get();
        }

        return Datatables::of($data['tasks'])
            ->addColumn('status', function ($task) {
                switch($task->task_type_name){
                    case 'Pending':
                        return '<button type="button" class="btn btn-sm btn-outline-secondary">'.$task->task_type_name.'</button>';
                        break;
                    case 'In Progress':
                        return '<button type="button" class="btn btn-sm btn-outline-info">'.$task->task_type_name.'</button>';
                        break;
                    case 'Initial Testing':
                        return '<button type="button" class="btn btn-sm btn-outline-danger">'.$task->task_type_name.'</button>';
                        break;
                    case 'Final Testing':
                        return '<button type="button" class="btn btn-sm btn-outline-warning">'.$task->task_type_name.'</button>';
                        break;
                    case 'Complete':
                        return '<button type="button" class="btn btn-sm btn-outline-success">'.$task->task_type_name.'</button>';
                        break;
                }
            })
            ->addColumn('assignees', function ($item) {
                foreach($item->assignees as $assignee){
                    return '<span class="badge badge-info">'.$assignee->name.'</span>';
                }
            })
            ->rawColumns(['status' , 'assignees'])
            ->make(true);

    }

    /** CREATE TASK */

    public function create(Request $request){



    }

}
