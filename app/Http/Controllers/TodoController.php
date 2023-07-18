<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function findAll()
    {
        return Todo::all();
    }

    public function findOne(int $id)
    {
       return $this->findOrFail($id);
    }

    public function create(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3'
        ]);


        if ($validated->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validated->errors()
            ], 400);
        }

        $todo = new Todo();

        $todo->name = $request->name;
        $todo->description = $request->description;

        $todo->save();

        return $todo;
    }

    public function update(Request $request, int $id)
    {
        $todo = $this->findOrFail($id);

        $todo->name = $request->name;
        $todo->description = $request->description;

        $todo->save();

        return $todo;
    }


    private function findOrFail(int $id)
    {
        $todo =  Todo::find($id);

        if (!$todo) {
            throw new NotFoundException(
                'Todo with id ' . $id . ' not found'
            );
        }

        return $todo;
    }
}
