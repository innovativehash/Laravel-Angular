<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Hash;
use Input;
use Validator;
use DB;

use App\Models\TodoList;
use App\Http\Traits\CustomTrait;

class TodosController extends Controller
{
    use CustomTrait;

    public function getIndex(Request $request)
    {
        $project_id = $request['id'];
        $todoList = Todolist::with('tasks','tasks.department','tasks.contributor','tasks.file')->where('project_id','=',$project_id)->get();
        return response()->success($todoList);
    }

    public function postStore(Request $request)
    {
        $project_id = $request['project_id'];
        $newTodoList = new Todolist();
        $newTodoList->title = $request['title'];
        $newTodoList->description = $request['description'];
        $newTodoList->project_id = $request['project_id'];
        $newTodoList->pm_id = $request['pm_id'];
        $result = 'success';
        if(!$newTodoList->save())
            $result = 'false';
        $todoList = Todolist::with('tasks')->where('project_id','=',$project_id)->get();
        return response()->success($todoList);
    }
    public function deleteTodos(Request $request){
        $project_id = $request['id'];
        $todos = Todolist::find($project_id);
        $todos->delete();
        $todoList = Todolist::with('tasks')->where('project_id','=',$project_id)->get();
        return response()->success($todoList);
    }
}
