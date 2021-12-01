<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks.index',[
            'tasks' => $tasks
        ]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){ // 데이터 접근 가능

        $task = Task::create([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        return redirect('/tasks/'.$task->id);
    }

    public function show(Task $task){ // laravel에서 모델자료형을 앞에 붙여주면 알아서 $task에 맞는 열을 찾아 $task변수에 넣어준다.

        return view('tasks.show',[
            'task' => $task
        ]);
    }

    public function edit(Task $task){
        return view('tasks.edit',[
            'task'=> $task
        ]);
    }

    public function update(Task $task){
        request('title');
        $task->update([
            'title' => request('title'),
            'body' => request('body')
        ]);
        return redirect('/tasks/'.$task->id);
    }
}
