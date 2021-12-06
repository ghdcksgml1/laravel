@extends('layout')

@section('title')
    Welcome
@endsection

@section('content')
    Welcome
    <ul>
        @foreach($books as $book)
        <li><?php echo $book?></li>
        @endforeach
    </ul>
@endsection
