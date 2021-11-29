@extends('layout')

@section('title')
    Tasks
@endsection

@section('content')
    <div class="px-10">
        <h1 class="font-bold text-3xl">Tasks List</h1>
        <ul>
            @foreach($tasks as $task)
                <li class="border my-3 p-3">Title: {{$task->title}} <small class="float-right text-gray-500">Created at: {{$task->created_at}}</small></li>
            @endforeach
        </ul>
    </div>
@endsection
