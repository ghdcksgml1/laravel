# 📘 Laravel

## 🧩 Route

web.php 에서 Route를 통해 아래의 다양한 동작을 할 수 있다.

Route Name은 관용적으로 사용하는 네이밍이니 아래의 표에 맞게 잘 설정하자.

<img width="645" alt="스크린샷 2021-11-30 오전 1 26 32" src="https://user-images.githubusercontent.com/79779676/143905222-7ab848ba-8c6d-4890-b57d-46ffa4311440.png">

```php
// web.php
Route::get('/hello', view('hello'));
```

<br/><br/>

## 🧩 @yield와 @section

laravel의 강력한 기능인 @yield와 @section이다.
    
```
resources/views/ 폴더의 블레이드 파일에서 @yield('변수명') 을 써주면 해당 부분에 들어갈 코드를 다른 파일에서 지정할 수 있다.

예를 들어, 똑같은 내용이지만 제목만 다른 파일 100개가 있다고했을때 100개의 모든 파일에 똑같은 코드를 입력하게된다면, 만약 내용에

수정사항이 생길때 100개의 파일을 전부 고쳐야한다. 따라서, 이 @yield를 이용해 바꿔야하는 부분을 표시해주고 중복되는 부분은 layout.blade.php 따로두어서

layout을 만들어놓고 각각의 100개의 파일에서는 @yield부분에 들어갈 내용만 설정해주면 된다.
```

@yield로 지정된 부분은 @section @endsection을 통해 넣어줄 수 있다.

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Laravel')</title>
        <link rel="stylesheet" href="{{mix('css/tailwind.css')}}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
    <div class="container mx-auto">
        @yield('content')
    </div>

    </body>
</html>
```

```php
@extends('layout')

@section('title')
    Hello
@endsection

@section('content','hello') // 이 방법도 가능
```

<br/><br/>

## 🧩 Views로 데이터 보내기

web.php에서 Route::get을 이용하면 view를 화면에 띄울 수 있다.

여기서 view의 두번째 매개변수에 객체를 넣어주면 해당 뷰가 매개변수로 넣어준 객체에 접근할 수 있다.

```php
// web.php
Route::get('/hello', function(){
    $hi = 'hello';
    return view('hello', [
        'hi' => $hi
]});
```

위 예제를 보면, /hello가 호출될때 view의 hello 블레이드를 실행시키고, 이때 'hello'가 담긴 변수 $hi를 변수명 'hi'로 넘긴다.

```php
// resources/views/hello
@extends('layout')

@section('title')
    $hi
@endsection

@section('content','hello')
```

블레이드에서 $hi로 바로 전달받은 객체를 접근할 수 있다.

## 🧩 Controller

컨트롤러는 어떤 일을 처리할지 결정해주는 클래스이고, view에게 전달할 정보를 처리하는 역할을 한다.

컨트롤러 생성 방법

```
$php artisan make:controller [객체이름]Controller // ex) TaskController
```

위 명령어를 입력하면 app/Http/Controllers 폴더에 해당 컨트롤러가 생성된다.

기존에 web.php에서 Route::get('/hello', view('hello')); 와 같이 view에게 전달할 정보까지 같이 처리했지만,

이제는 이 과정을 컨트롤러에서 처리할것이다.

```php
// app/Http/Controllers/HomeControllers.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
            $books = [
                'Harry Potter',
                'Laravel'
            ];
            return view('welcome',['books' => $books]);
    }
}
```

위 코드와 같이 index() 메소드를 통해 행위를 정의한다.

web.php에서 위 메소드를 사용하기 위해서 다음과 같이 코드를 구현해주면 된다.

```php
// web.php
Route::get('/hello', 'HelloController@index');
```

'HelloController의 index 메소드를 실행하라'라는 뜻이다.

이처럼 컨트롤러의 사용을 통해 더욱 객체지향적인 프로그래밍을 할 수 있다.

<br/><br/>

## 🧩 모델 생성과 데이터베이스 사용법

데이터베이스를 통해 테이블을 만든다고해도 곧바로 사용할 수 없고, 모델을 정의해줘야한다.

<br/>

- 모델만들기 명령어

```
$php artisan make:model 모델명
```

다음 명령어를 입력하면 app폴더의 하위폴더에 모델명.php 파일이 생긴다.

다시 routes의 web.php 폴더에 가서 Route::get('/모델명', '모델명Controller@index'); 를 통해 호출해보는 과정을 실습해보자.

우선 모델명의 Controller를 만들기 위해 아래의 명령어를 입력

- 컨트롤러만들기 명령어

```
$php artisan make:controller 모델명Controller
```

명령어를 실행했으면 app\Http\Controllers\ 폴더에 모델명Controller.php가 생성된다.

아래와 같이 App\모델명::all() 을 통해 모델의 모든 요소를 가져온 뒤 view 함수를 통해 해당 블레이더 파일로 객체를 넘긴다.

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = \App\Project::all();

        return view('projects.index',[
            'projects' => $projects
        ]);
    }
}
```

블레이드 파일에서는 가져온 객체를 화살표기호(->) 를 이용하여 데이터베이스에 접근한다.

```php
@extends('layout')

@section('content')
    <h1>Project List</h1>
    @foreach($projects as $project)
        Title : {{$project->title}}<br/>
        Description : {{$project->description}}<br/>
    @endforeach
@endsection
```

<br/>

### Web에서 동작 순서 (모델명 Project 기준)

127.0.0.1:8000/projects 를 입력하게되면

- routes\web.php 에서 Route::get('/projects','ProjectController@index'); 실행
- app\Http\Controllers\ProjectController.php(컨트롤러) 파일의 index 메소드 호출
- index 메소드에서 app\Project.php(모델) 을 통해 데이터베이스 파일을 모두 가지고옴
- view 함수를 통해 resources\views\projects\index.blade.php(뷰)를 웹 화면에 띄우기 전에 데이터베이스를 담아두었던 projects 변수를 넣어주고 웹 화면을 띄워줌
- 컨트롤러의 index 메소드가 종료됨.

<br/><br/>

## 🧩 tailwindcss 환경설정 (node.js가 설치되어있어야함.)

설치 가이드 : https://tailwindcss.com/docs/installation

- phpStorm으로 돌아가서 터미널을 킨다.

```
$npm install
```

```
$npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
```

- npm install이 끝나면 node_modules 라는 폴더가 생기는 것을 확인할 수 있다.

- resources 폴더에 들어가 css폴더를 만들고, tailwind.css 파일을 생성한다.

```css
/* resources/css/tailwind.css */
@tailwind base;
@tailwind components;
@tailwind utilities;
```

- 위 코드를 입력한다.

- webpack.mix.js 파일에 들어가서 아래와 같이 바꿔준다.

```javascript
// webpack.mix.js
mix.js("resources/js/app.js", "public/js")
    .sass('resources/sass/app.scss', 'public/css')
    .postCss("resources/css/tailwind.css", "public/css", [
        require("tailwindcss"),
    ]);
```

- 아래 명령어를 실행시킨다.

```
$npm run dev
```

### 🔴 이때 postCSS8 Error가 발생할 수 있다. 호환성문제이므로 postCSS7로 바꿔주면 된다.

```
$npm uninstall tailwindcss postcss autoprefixer
$npm install -D tailwindcss@npm:@tailwindcss/postcss7-compat postcss@^7 autoprefixer@^9
```

<br/>

잘 완료가 되었으면 public/css/tailwind.css 가 생성되었을 것이다.

<br/>

### Tailwind 사용방법

블레이드 파일의 head 태그부분에서
    
```html
<link rel="stylesheet" href=""{{ mix('css/tailwind.css') }}">
```
                                                            
다음을 추가해주면 된다.
                                  
## 🧩 POST 사용방법

POST의 네이밍 규칙

<img width="647" alt="스크린샷 2021-11-30 오전 1 21 57" src="https://user-images.githubusercontent.com/79779676/143904588-2697c092-a140-4354-8feb-4de12bf1902c.png">

```
$php artisan make:model Task -c -m
```

위 명령어를 입력하면 한번에 모델과 컨트롤러 마이그래이션을 생성할 수 있다.

```php
// resources/views/tasks/create.blade.php
@extends('layout')

@section('title','Create Task')

@section('content')
    <div class="px-10">
        <h1 class="font-bold text-3xl">Create Task</h1>
        <form action="/tasks" method="post">
            @csrf
            <label class="block" for="title">Title</label>
            <input class="border border-gray-500 w-full" type="text" name="title" id="title"><br/>

            <label for="body">Body</label>
            <textarea class="block border border-gray-500 w-full" name="body" id="body" cols="30" rows="10"></textarea>

            <button class="bg-blue-500 text-white px-1.5 m-1 float-right">Submit</button>
        </form>
    </div>
@endsection
```

```php
// web.php
Route::post('/tasks','TaskController@store');
```

```php
// app/Http/Controllers/TaskController.php
public function store(Request $request){ // Request를 통해 POST로 넘어온 데이터 접근 가능

        $task = Task::create([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        return redirect('/tasks');
    }
```

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','body']; // title 과 body의 변경을 허용한다.
}
```

### 그냥 이렇게해서 실행을 해보면 491 ERROR가 발생한다.

URL : https://laravel.com/docs/8.x/csrf

CSRF Protection을 위해 라라벨에서 동작을 멈춘다.

따라서, 해당 코드를 head 태그에 추가해줘야한다.

```
<meta name="csrf-token" content="{{ csrf_token() }}">
```

그 뒤에 form태그에는 @csrf 를 추가해주면 된다.

<br/><br/>

## 🧩 GET의 show방식

GET의 show 방식은 해당 정보에 맞는 url을 설정할 수 있다. ex) id = 1, 127.0.0.1:8000/tasks/1

네이밍 규칙은 아래와 같다.

<img width="646" alt="스크린샷 2021-11-30 오전 1 14 03" src="https://user-images.githubusercontent.com/79779676/143903182-2941fd1a-4ebb-4318-8f9d-1ad289bba54a.png">

```php
// web.php
Route::get('/tasks/{task}','TaskController@show');
```

```php
// app/Http/Controllers/TaskController.php
public function show(Task $task){ 
// laravel에서 매개변수에 모델자료형을 앞에 붙여주면 알아서 $task id에 맞는 열을 찾아 $task변수에 넣어준다.
        return view('tasks.show',[
            'task' => $task
        ]);
    }
```

블레이드 파일에서는 Controller에서 task로 데이터베이스 정보를 넘겨줬기때문에

$task 객체를 접근해서 원하는 정보를 빼내면 된다. ex) id를 원하면, $task -> id

```html
// resources/views/tasks/create.blade.php
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
```
