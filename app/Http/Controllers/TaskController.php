<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::latest()->where('user_id',auth()->id())->get();
        return view('tasks.index',[
            'tasks' => $tasks
        ]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){ // 데이터 접근 가능
        request()->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $values = request(['title','body']);

        // auth()->id() 라라벨에서 제공하는 로그인한 사람의 아이디를 알려주는 함수
        $values['user_id'] = auth()->id();

        $task = Task::create($values);

        return redirect('/tasks/'.$task->id);
    }

    public function show(Task $task){ // laravel에서 모델자료형을 앞에 붙여주면 알아서 $task에 맞는 열을 찾아 $task변수에 넣어준다.
//        if(auth()->id() != $task->user_id){
//            abort(403);
//        }
//        abort_if(auth()->id != $task->user_id, 403);
//
//        abort_if(!auth()->user()->owns($task),403);
        abort_unless(auth()->user()->owns($task),403);
        // auth()->user() 는 User::find 와 같다.
        return view('tasks.show',[
            'task' => $task
        ]);
    }

    public function edit(Task $task){
        abort_unless(auth()->user()->owns($task),403);
        return view('tasks.edit',[
            'task'=> $task
        ]);
    }

    public function update(Task $task){
        request()->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $task->update(request(['title','body']));
        return redirect('/tasks/'.$task->id);
    }

    public function destroy(Task $task){
        abort_unless(auth()->user()->owns($task),403);
        $task->delete();
        return redirect('/tasks');
    }
}
