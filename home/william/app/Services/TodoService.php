<?php

namespace App\Services;

use App\Models\TodoModel;
use Illuminate\Http\Request;

class TodoService
{
    public function listeForUser($userId)
    {
        return response()->json(TodoModel::where('user_id', $userId)->get());
    }

    public function getElementByID($request)
    {
        if (!TodoModel::where('id', $request['id'])->where('user_id', $request['info']['id'])->first()) {
            return response()->json(['error' => 'Todo not found'], 404);
        }
        return response()->json(TodoModel::where('id', $request['id'])->where('user_id', $request['info']['id'])->first());
    }

    public function getElementByName($request)
    {
        if (!TodoModel::where('name', $request['name'])->where('user_id', $request['info']['id'])->first()) {
            return response()->json(['error' => 'Todo not found'], 404);
        }
        return response()->json(TodoModel::where('name', $request['name'])->where('user_id', $request['info']['id'])->first());
    }

    public function modifElement($request) {

        $todo = TodoModel::where('name', $request->name)->first();
        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }
        if (!$this->is_exist($request)) {
            return response()->json(['error' => 'Todo is not exist or does not belong to you'], 400);
        }

        $toUpdate = [
            'content'=> ($request->content != $todo->content) ? $request->content : $todo->content,
            'valid'=> ($request->valid != $todo->valid) ? $request->valid : $todo->valid,
        ];
        TodoModel::where('name', $request->name)->update($toUpdate);

        return response()->json(['success' => 'Todo updated']);
    }

    public function is_exist($request) {
        if (!TodoModel::where('name', $request->name)->where('user_id', $request->info['id'])->first()) {
            return false;
        }
        return true;
    }

    public function supprElement($request) {
        if (!$this->is_exist($request)) {
            return response()->json(['error' => 'Todo is not exist or does not belong to you'], 400);
        }
        TodoModel::where('name', $request->name)->where('user_id', $request->info['id'])->delete();
        return response()->json(['success' => 'Todo deleted']);
    }

    public function addElement($request) {
        if ($this->is_exist($request)) {
            return response()->json(['error' => 'Todo is already exist'], 400);
        }
        $table = new TodoModel;
        $table->name = $request->name;
        $table->content = $request->content;
        $table->user_id = $request->info['id'];
        $table->save();
        return response()->json(['success' => 'Todo added']);
    }
}
