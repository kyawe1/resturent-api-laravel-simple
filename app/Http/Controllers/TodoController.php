<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function all()
    {
        $temp = request()->query("search_string");
        if ($temp != null) {
            return TodoResource::collection(Todo::where("todo_name", "LIKE", "{$temp}%")->get());
        }
        return TodoResource::collection(Todo::all());
    }
    public function get_todo(int $id)
    {
        return new TodoResource(Todo::find($id));
    }
    public function compelete_todo(int $id)
    {
        $todo = Todo::find($id);
        $todo->compeleted = true;
        $todo->save();
        return true;
    }
    public function add_todo()
    {
        $validate = request()->validate([
            'todo_name' => 'string|required',
            'compeleted' => 'bool|required'
        ]);
        $todo = Todo::create(
            $validate
        );
        $todo->save();
        return true;
    }
    public function delete_todo(int $id)
    {
        $todo = Todo::where('id', $id);
        $todo->delete();
        return true;
    }
}
