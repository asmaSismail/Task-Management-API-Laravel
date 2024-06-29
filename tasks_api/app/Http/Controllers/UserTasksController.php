<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TasksResources;

class UserTasksController extends Controller
{
    use HttpResponses; 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        return TasksResources::collection(Task::where('user_id', $user->id)->get());
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
        $authUserId = Auth::id();

        $task = Task::where('id', $id)->where('user_id', $authUserId)->first(); 
    
        if ($task) {
            return new TasksResources($task);
        } else {
            return $this->error('', 'Task not found or it does not belong to the authenticated user.',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                $authUserId = Auth::id();

                $task = Task::where('id', $id)->where('user_id', $authUserId)->first();
        
                if ($task) {
                    $task->update($request->all());
                    return new TasksResources($task);
                } else {
                    
                    return $this->error('','Task not found or it does not belong to the authenticated user.', 404);
                }

    }
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $authUserId = Auth::id();

        $task = Task::where('id', $id)->where('user_id', $authUserId)->first(); 
    
        if ($task) {
            $task->delete();
            return $this.success('', 'Task soft deleted successfully.', 200);

        } else {
            return $this->error('', 'Task not found or it does not belong to the authenticated user.',404);
        }
    }
}
