<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Document;
use App\Models\Feedback;
use App\Models\Freelancer;
use App\Models\Message;
use App\Models\PersonalData;
use App\Models\Purchaser;
use App\Models\Task;
use App\Models\TaskData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    function index(Request $request){
        if(Auth::user()->is_admin){
            switch ($request->model) {
                case 'user':
                    return view('dashboard',
                    ['content' => User::all()->toArray()]);
                case 'pdata':
                    return view('dashboard',
                    ['content' => PersonalData::all()->toArray()]);
                case 'docs':
                    return view('dashboard',
                    ['content' => Document::all()->toArray()]);
                case 'certs':
                    return view('dashboard',
                    ['content' => Certificate::all()->toArray()]);
                case 'frs':
                    return view('dashboard',
                    ['content' => Freelancer::all()->toArray()]);
                case 'prs':
                    return view('dashboard',
                    ['content' => Purchaser::all()->toArray()]);
                case 'tasks':
                    $tds = [];
                    foreach (Task::all() as $feedback) {
                        array_push($tds, TaskData::where('id', $feedback->task_data)->toArray());
                    }
                    return view('dashboard',
                    ['content' => array_merge(Task::all()->toArray(), $tds)]);
                case 'fdbs':
                    $tds = [];
                    foreach (Feedback::all() as $feedback) {
                        array_push($tds, TaskData::where('id', $feedback->task_data)->toArray());
                    }
                    return view('dashboard',
                    ['content' => array_merge(Feedback::all()->toArray(), $tds)]);
                case 'messages':
                    return view('dashboard',
                    ['content' => Message::all()->toArray()]);
                default:
                    return view('dashboard', ['content' => null]);
            }
        }
        return redirect('index');
    }

    function store(Request $request){
        if(Auth::user()->is_admin){
            switch ($request->model) {
                case 'user':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            User::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    User::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'pdata':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            PersonalData::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    PersonalData::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'docs':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Document::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Document::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'certs':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Certificate::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Certificate::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'frs':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Freelancer::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Freelancer::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'prs':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Purchaser::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Purchaser::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'tasks':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Task::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Task::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'fdbs':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Feedback::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Feedback::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                case 'messages':
                    if($request->flag){
                        foreach (explode(',', $request->flag) as $flag) {
                            Message::where('id', $flag)->update(['flagged' => 1]);
                        }
                    }
                    Message::create(['email' => $request->email, 'phone' => $request->phone, 'name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic]);
                default:
                    return view('dashboard', ['content' => null]);
            }
        }
        return redirect('index');
    }

    function update(Request $request){
        if(Auth::user()->is_admin){
            switch ($request->model) {
                case 'user':
                    return view('dashboard', ['content' => User::all()]);
                default:
                    return view('dashboard');
            }
        }
        return redirect('index');
    }

    function destroy(Request $request){
        if(Auth::user()->is_admin){
            switch ($request->model) {
                case 'user':
                    return view('dashboard', ['content' => User::all()]);
                default:
                    return view('dashboard');
            }
        }
        return redirect('index');
    }

    function flag(Request $request){
        if(Auth::user()->is_admin){
            switch ($request->model) {
                case 'user':
                    return view('dashboard', ['content' => User::all()]);
                default:
                    return view('dashboard');
            }
        }
        return redirect('index');
    }
}
