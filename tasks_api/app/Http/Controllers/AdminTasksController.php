<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Http\Resources\TasksResources;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

class AdminTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;

    public function index()
    {
        return TasksResources::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated($request->all());
        $task = Task::create([
            'titre' => $request->titre,
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'date_echeance' => $request->description,
            'statut' => $request->statut,
            'date_Echeance'=>$request->date_Echeance,
        ]);
        return new TasksResources($task);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    { 
        $task = Task::where('id', $id)->first(); 
    
        if ($task) {
            return new TasksResources($task);
        } else {
            return $this->error('', 'Task not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
                $task = Task::where('id', $id)->first();
               
                if ($task) {
                    $task->update($request->all());
                    return new TasksResources($task);
                } else {
                    
                    return $this->error('','Task not found.', 404);
                }
        
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $task = Task::where('id', $id)->first();
 
         if ($task) {
             $task->delete();
             return $this->success('', 'Task soft deleted successfully.', 200);
         } else {
             return $this->error('', 'Task not found.', 404);
         }
     }
    
     public function tasksDeleted()
     {
         $deletedTasks = Task::onlyTrashed()->get();
         
         if ($deletedTasks->isNotEmpty()) {
             return response()->json([
                 'status' => 'success',
                 'message' => 'Deleted tasks retrieved successfully',
                 'data' => TasksResources::collection($deletedTasks)
             ], 200);
         } else {
             return response()->json([
                 'status' => 'error',
                 'message' => 'No deleted tasks found',
                 'data' => []
             ], 404);
         }
     }
}
