# 📘 Laravel

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
