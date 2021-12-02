@extends('layouts.app')

@section('title')
    Tasks
@endsection

@section('content')
    <div class="px-10 mt-10">
        <div class="flex">
            <h1 class="flex-1 font-bold text-3xl">Tasks List</h1>
            <a class="flex-initial bg-blue-400 text-white p-2 mx-2 hover:bg-blue-500" href="/tasks/create">Create</a>
        </div>
        <ul>
            @foreach($tasks as $task)
                <a href="/tasks/{{$task->id}}">
                <li class="border my-3 p-3">Title: {{$task->title}} <small class="float-right text-gray-500">Created at: {{$task->created_at}}</small></li>
                </a>
            @endforeach
        </ul>
    </div>
@endsection
