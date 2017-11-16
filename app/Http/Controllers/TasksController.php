<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskAssignees;
use App\Tasks;
use App\TaskTypes;

use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    //
    public function index(){

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

}
