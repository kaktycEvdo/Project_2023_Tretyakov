<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\PersonalData;
use App\Models\Task;
use App\Models\TaskData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.burse', ['tasks' => Task::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.forms.task');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $td = TaskData::create([
            'deadline'=> $request->deadline,
            'payment_method'=> $request->payment_method,
            'reward'=> $request->reward,
            'text'=> $request->text,
        ]);
        Task::create(['task_data' => $td->id, 'purchaser' => Auth::user()->id]);
        return redirect('burse');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $task = Task::where('id', $request->id)->first();
        $feedbacks = [];
        foreach(Feedback::all()->where('task', $request->id) as $feedback) {
            $freelancer = $feedback->freelancer;
            if($task->purchaser != $feedback->freelancer) array_push($feedbacks, ['fd' => TaskData::where('id', $feedback->task_data)->first(), 'user' => PersonalData::where('email', User::where('id', $freelancer)->first()->email)->first()]);
        }
        $id = $task->purchaser;
        $email = User::where('id', $id)->first('email')->email;
        $purchaser = PersonalData::where('email', $email)->first(['name', 'surname', 'patronymic']);
        return view('task.task', ['tags' => explode(', ', $task->tags),
        'task_data' => TaskData::where('id', $task->task_data)->first(),
        'feedbacks' => $feedbacks,
        'purchaser' => $purchaser,
        'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.forms.task', ['task_data' => TaskData::find($task->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        TaskData::where($task->task_data)->update([
            'deadline'=> $request->deadline,
            'payment_method'=> $request->payment_method,
            'reward'=> $request->reward,
            'text'=> $request->text,
        ]);
        $task->update(['tags' => $request->tags]);
        return redirect('profile.edit');
    }

    public function accept(Request $request){
        $task = Task::where('id', $request->id)->first();
        $task->update(['freelancer' => $request->freelancer, 'is_official' => 1]);
        $feedbacks = Feedback::all()->where('task', $task->id);
        foreach ($feedbacks as $feedback) {
            TaskData::where('id', $feedback->task_data)->delete();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        TaskData::where($task->task_data)->delete();
        return redirect('profile.edit');
    }
}
