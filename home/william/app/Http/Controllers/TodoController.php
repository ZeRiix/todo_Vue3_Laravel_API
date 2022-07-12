<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoModel;

class TodoController extends Controller
{
    public function liste() {
        return response()->json(TodoModel::all());
    }

    public function get_one_by_id($id) {

        $todo = TodoModel::find($id);
        if ($todo) {
            return response()->json($todo);
        } else {
            return response()->json(['error' => 'Todo not found'], 404);
        }
    }

    public function get_one_by_name($name) {

        $todo = TodoModel::where('name', $name)->first();
        if ($todo) {
            return response()->json($todo);
        } else {
            return response()->json(['error' => 'Todo not found'], 404);
        }
    }

    public function modif(Request $req) {

        $req->validate([
            'name'=> 'string|required',
            'content'=> 'string',
            'valid'=> 'boolean',
        ]);
        $todo = TodoModel::where('name', $req->name)->first();

        $toUpdate = [
            'content'=> ($req->content != $todo->content) ? $req->content : $todo->content,
            'valid'=> ($req->valid != $todo->valid) ? $req->valid : $todo->valid,
        ];
       TodoModel::where('name', $req->name)->update($toUpdate);

        return response()->json(['success' => 'Todo updated']);
    }

    public function suppr(Request $req) {
        $req->validate(['name'=> 'string|exists:todo,name']);
        TodoModel::where('name', $req->name)->delete();

        return response()->json('delete');
    }

    public function add_todo(Request $req) {

        $req->validate([
            'name'=> 'string|required|unique:todo',
            'content'=> 'string|required'
        ]);

        $table = new TodoModel;
        $table->name = $req->name;
        $table->content = $req->content;

        $table->save();

        return response()->json('add');
    }

    public function is_exist($var) {
        $table = TodoModel::where('name', $var)->first();
        if ($table == null) {
            return false;
        }
        return true;
    }
}
