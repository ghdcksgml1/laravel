@extends('layouts.app')

@section('title','Task')

@section('content')
    <div class="px-10 mt-10">
        <div class="flex">
            <h1 class="font-bold text-3xl flex-1"><a href="/tasks/">Task</a></h1>
            <div class="flex-initial">
                <a href="/tasks/{{$task->id}}/edit">
                    <button class="bg-green-500 px-4 py-1 m-1 text-white hover:bg-green-700">Edit</button>
                </a>
                <form class="float-right" action="/tasks/{{$task->id}}" method="POST">
                    @method('DELETE') <!-- html에서 DELETE를 보낼 수 없으므로 -->
                    @csrf
                    <button class="bg-red-500 px-4 py-1 m-1 text-white hover:bg-red-700">Delete</button>
                </form>
            </div>

        </div>
        <br/>
        <h1 class="font-bold text-2xl">Title: {{ $task -> title }} <small class="float-right text-sm text-gray-500 font-normal">
                <?php $date = $task->created_at==$task->updated_at?"Created at ".$task->created_at:"Updated at ".$task->updated_at; echo $date; ?></small></h1><br/>
        <h2 class="font-bold text-xl">Body</h2>
        <div class="border p-3">{{{$task -> body}}}</div>
    </div>
@endsection
