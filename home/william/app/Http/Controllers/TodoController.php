<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoModel;
use App\Services\TodoService;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function listTodo(Request $request) {

        $request->validate([
            'token' => 'required',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->listeForUser($request['info']['id'])]);
    }

    public function get_one_by_id(Request $request) {

        $request->validate([
            'id' => 'integer',
            'token' => 'required',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->getElementByID($request)]);
    }

    public function get_one_by_name(Request $request) {

        $request->validate([
            'name' => 'string',
            'token' => 'required',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->getElementByName($request)]);
    }

    public function modif(Request $request) {

        $request->validate([
            'token' => 'required',
            'name'=> 'string|required',
            'content'=> 'string',
            'valid'=> 'boolean',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->modifElement($request)]);
    }

    public function suppr(Request $request) {

        $request->validate([
            'name' => 'string',
            'token' => 'required',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->supprElement($request)]);
    }

    public function add_todo(Request $request) {

        $request->validate([
            'token' => 'required',
            'name'=> 'string|required|unique:todo',
            'content'=> 'string|required',
            'info.id' => 'integer',
        ]);

        return response()->json([$this->todoService->addElement($request)]);
    }
}
