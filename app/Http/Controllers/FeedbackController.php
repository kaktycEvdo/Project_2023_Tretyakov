<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\TaskData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("task.forms.feedback");
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
        Feedback::create(['task_data' => $td->id, 'freelancer' => Auth::user()->id]);
        return redirect('burse');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        return view('task.forms.feedback', ['feedback' => $feedback]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback->update($request->all());
        return redirect('burse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $task = $feedback->task_data->task;
        $feedback->delete();
        return redirect('task');
    }
}
