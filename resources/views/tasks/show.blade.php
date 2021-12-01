@extends('layout')

@section('title','Task')

@section('content')
    <div class="px-10 mt-10">
        <div class="flex">
            <h1 class="font-bold text-3xl flex-1"><a href="/tasks/">Task</a></h1>
            <a href="/tasks/{{$task->id}}/edit">
                <button class="flex-initial bg-green-500 px-4 py-1 m-1 text-white hover:bg-green-700">Edit</button>
            </a>
        </div>
        <br/>
        <h1 class="font-bold text-2xl">Title: {{ $task -> title }} <small class="float-right text-sm text-gray-500 font-normal">
                <?php $date = $task->created_at==$task->updated_at?"Created at ".$task->created_at:"Updated at ".$task->updated_at; echo $date; ?></small></h1><br/>
        <h2 class="font-bold text-xl">Body</h2>
        <div class="border p-3">{{{$task -> body}}}</div>
    </div>
@endsection
