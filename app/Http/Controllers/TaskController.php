<?php
/**
* 
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\User;
use App\Task;

class TaskController extends Controller
{
	//protected $tasks;

	// public function __construct(TaskRepository $tasks)
 //    {
 //        $this->middleware('auth');
 //        $this->tasks = $tasks;
 //    }

	public function display()
    {
        $tasks = Task::all();//orderBy('created_at', 'asc')->get();
        //return view('tasks.index',compact(tasks));
    }

    public function index()
    {
    	 $tasks = Task::all();
    	 return view('tasks.index',compact('tasks'));
    	
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        return redirect('/tasks');
    }

    public function destroy(Request $request,$taskId)
    {   $task = Task::find($taskId);
        //$this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}