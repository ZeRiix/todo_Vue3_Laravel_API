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

    public function modif(Request $req) {

        $req->validate([
            'name'=> 'string|required',
            'content'=> 'string',
            'valid'=> 'boolean',
        ]);

        if ($req->name) {
            if ($req->content) {
               TodoModel::where('name', $req->name)->update(['content' => $req->content]);
               response()->json(['success' => 'Todo content updated']);
            } else {
                return response()->json(['error' => 'Todo content error'], 400);
            }
            if ($req->valid) {
                TodoModel::where('name', $req->name)->update(['valid' => $req->valid]);
                response()->json(['success' => 'Todo valid updated']);
            } else {
                return response()->json(['error' => 'Todo valid error'], 400);
            }
            return response()->json(['success' => 'Todo updated']);
        } else {
            return response()->json(['error' => 'Todo not found'], 404);
        }
    }

    public function suppr(Request $req) {
        $req->validate(['name'=> 'string']);
        TodoModel::where('name', $req->name)->delete();

        return response()->json('delete');
    }

    public function add_todo(Request $req) {

        $req->validate([
            'name'=> 'string|required',
            'content'=> 'string|required'
        ]);

        if ($this->is_exist($req->name) == true) {
            return response()->json('error, is exist');
        }
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
