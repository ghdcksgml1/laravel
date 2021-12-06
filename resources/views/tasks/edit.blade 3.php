@extends('layout')

@section('title','Edit Task')

@section('content')
    <div class="px-10">
        <h1 class="font-bold text-3xl">Edit Task</h1>
        <form action="/tasks/{{$task->id}}" method="POST">
            @method('PUT')
            @csrf
            <label class="block" for="title">Title</label>
            <input class="border border-gray-500 w-full" type="text" name="title" id="title" value="{{$task->title}}"><br/>

            <label for="body">Body</label>
            <textarea class="block border border-gray-500 w-full" name="body" id="body" cols="30" rows="10">{{$task->body}}</textarea>

            <button class="bg-blue-500 text-white px-1.5 m-1 float-right">Submit</button>
        </form>
    </div>
@endsection
