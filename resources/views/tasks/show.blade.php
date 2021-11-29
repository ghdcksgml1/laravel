@extends('layout')

@section('title','Task')

@section('content')
    <div class="px-10">
        <h1 class="font-bold text-3xl"><a href="/tasks/">Task</a></h1><br/>
        <h1 class="font-bold text-2xl">Title: {{ $task -> title }} <small class="float-right text-sm text-gray-500 font-normal">{{$task->created_at}}</small></h1><br/>
        <h2 class="font-bold text-xl">Body</h2>
        <div class="border p-3">{{{$task -> body}}}</div>
    </div>
@endsection
