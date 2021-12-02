@extends('layouts.app')

@section('title','Edit Task')

@section('content')
    <div class="px-10">
        <h1 class="font-bold text-3xl">Edit Task</h1>
        <form action="/tasks/{{$task->id}}" method="POST">
            @method('PUT')
            @csrf
            <label class="block" for="title">Title</label>
            <input class="border border-gray-500 w-full @error('title') border border-red-700 @enderror" type="text" name="title" id="title" value="{{old('title')?old('title'):$task->title}}" required><br/>
            @error('title')
                <small class="text-red-700">{{ $message }}</small>
            @enderror

            <label class="block" for="body">Body</label>
            <textarea class="block border border-gray-500 w-full @error('body') border border-red-700 @enderror" name="body" id="body" cols="30" rows="10" required value="{{old('body')?old('body'):''}}">{{$task->body}}</textarea>

            @error('body')
                <small class="text-red-700">{{ $message }}</small>
            @enderror

            <button class="bg-blue-500 text-white px-1.5 m-1 float-right">Submit</button>
        </form>
    </div>
@endsection
