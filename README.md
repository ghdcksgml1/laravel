# ๐ Laravel (๋ณต์ต์ ์ํ ์ ๋ฆฌ)

## ๐งฉ Laravel ํ๊ฒฝ์ธํ

๊ธฐ๋ณธ์ ์ผ๋ก php7.x ๋ฒ์ ๊ณผ mysql5.x ๋ฒ์ ์ด ํ์ํ๋ค.

```
$brew install php@7.3
$brew install mysql@5.7
```

<br/>

composer๊ฐ ์ค์น๋์ด ์์ด์ผํ๋ค. (composer install ๋ง ๊ตฌ๊ธ๋งํด๋ ๋์ด.)

- ๋ผ๋ผ๋ฒจ ์ค์น

```
$composer create-project laravel/laravel project "5.8.*"
```

<br/>

- ํ๋ก์ ํธ ์์ฑ๋ฐฉ๋ฒ

```
$composer create-project laravel/laravel="5.8.*" [ํ๋ก์ ํธ ์ด๋ฆ]
```

<br/>

- ํ๋ก์ ํธ๊น์ง ์์ฑ๋์ผ๋ฉด, ํด๋น ํด๋๋ก ๋ค์ด๊ฐ ์๋ฒ๋ฅผ ์ผ๋ณธ๋ค.

```
$php artisan serve
```

<br/><br/>

## ๐งฉ Route

web.php ์์ Route๋ฅผ ํตํด ์๋์ ๋ค์ํ ๋์์ ํ  ์ ์๋ค.

Route Name์ ๊ด์ฉ์ ์ผ๋ก ์ฌ์ฉํ๋ ๋ค์ด๋ฐ์ด๋ ์๋์ ํ์ ๋ง๊ฒ ์ ์ค์ ํ์.

<img width="645" alt="แแณแแณแแตแซแแฃแบ 2021-11-30 แแฉแแฅแซ 1 26 32" src="https://user-images.githubusercontent.com/79779676/143905222-7ab848ba-8c6d-4890-b57d-46ffa4311440.png">

```php
// web.php
Route::get('/hello', view('hello'));
```

<br/><br/>

## ๐งฉ @yield์ @section

laravel์ ๊ฐ๋ ฅํ ๊ธฐ๋ฅ์ธ @yield์ @section์ด๋ค.
    
```
resources/views/ ํด๋์ ๋ธ๋ ์ด๋ ํ์ผ์์ @yield('๋ณ์๋ช') ์ ์จ์ฃผ๋ฉด ํด๋น ๋ถ๋ถ์ ๋ค์ด๊ฐ ์ฝ๋๋ฅผ ๋ค๋ฅธ ํ์ผ์์ ์ง์ ํ  ์ ์๋ค.

์๋ฅผ ๋ค์ด, ๋๊ฐ์ ๋ด์ฉ์ด์ง๋ง ์ ๋ชฉ๋ง ๋ค๋ฅธ ํ์ผ 100๊ฐ๊ฐ ์๋ค๊ณ ํ์๋ 100๊ฐ์ ๋ชจ๋  ํ์ผ์ ๋๊ฐ์ ์ฝ๋๋ฅผ ์๋ ฅํ๊ฒ๋๋ค๋ฉด, ๋ง์ฝ ๋ด์ฉ์

์์ ์ฌํญ์ด ์๊ธธ๋ 100๊ฐ์ ํ์ผ์ ์ ๋ถ ๊ณ ์ณ์ผํ๋ค. ๋ฐ๋ผ์, ์ด @yield๋ฅผ ์ด์ฉํด ๋ฐ๊ฟ์ผํ๋ ๋ถ๋ถ์ ํ์ํด์ฃผ๊ณ  ์ค๋ณต๋๋ ๋ถ๋ถ์ layout.blade.php ๋ฐ๋ก๋์ด์

layout์ ๋ง๋ค์ด๋๊ณ  ๊ฐ๊ฐ์ 100๊ฐ์ ํ์ผ์์๋ @yield๋ถ๋ถ์ ๋ค์ด๊ฐ ๋ด์ฉ๋ง ์ค์ ํด์ฃผ๋ฉด ๋๋ค.
```

@yield๋ก ์ง์ ๋ ๋ถ๋ถ์ @section @endsection์ ํตํด ๋ฃ์ด์ค ์ ์๋ค.

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

@section('content','hello') // ์ด ๋ฐฉ๋ฒ๋ ๊ฐ๋ฅ
```

<br/><br/>

## ๐งฉ Views๋ก ๋ฐ์ดํฐ ๋ณด๋ด๊ธฐ

web.php์์ Route::get์ ์ด์ฉํ๋ฉด view๋ฅผ ํ๋ฉด์ ๋์ธ ์ ์๋ค.

์ฌ๊ธฐ์ view์ ๋๋ฒ์งธ ๋งค๊ฐ๋ณ์์ ๊ฐ์ฒด๋ฅผ ๋ฃ์ด์ฃผ๋ฉด ํด๋น ๋ทฐ๊ฐ ๋งค๊ฐ๋ณ์๋ก ๋ฃ์ด์ค ๊ฐ์ฒด์ ์ ๊ทผํ  ์ ์๋ค.

```php
// web.php
Route::get('/hello', function(){
    $hi = 'hello';
    return view('hello', [
        'hi' => $hi
]});
```

์ ์์ ๋ฅผ ๋ณด๋ฉด, /hello๊ฐ ํธ์ถ๋ ๋ view์ hello ๋ธ๋ ์ด๋๋ฅผ ์คํ์ํค๊ณ , ์ด๋ 'hello'๊ฐ ๋ด๊ธด ๋ณ์ $hi๋ฅผ ๋ณ์๋ช 'hi'๋ก ๋๊ธด๋ค.

```php
// resources/views/hello
@extends('layout')

@section('title')
    $hi
@endsection

@section('content','hello')
```

๋ธ๋ ์ด๋์์ $hi๋ก ๋ฐ๋ก ์ ๋ฌ๋ฐ์ ๊ฐ์ฒด๋ฅผ ์ ๊ทผํ  ์ ์๋ค.

<br/><br/>

## ๐งฉ Controller

์ปจํธ๋กค๋ฌ๋ ์ด๋ค ์ผ์ ์ฒ๋ฆฌํ ์ง ๊ฒฐ์ ํด์ฃผ๋ ํด๋์ค์ด๊ณ , view์๊ฒ ์ ๋ฌํ  ์ ๋ณด๋ฅผ ์ฒ๋ฆฌํ๋ ์ญํ ์ ํ๋ค.

์ปจํธ๋กค๋ฌ ์์ฑ ๋ฐฉ๋ฒ

```
$php artisan make:controller [๊ฐ์ฒด์ด๋ฆ]Controller // ex) TaskController
```

์ ๋ช๋ น์ด๋ฅผ ์๋ ฅํ๋ฉด app/Http/Controllers ํด๋์ ํด๋น ์ปจํธ๋กค๋ฌ๊ฐ ์์ฑ๋๋ค.

๊ธฐ์กด์ web.php์์ Route::get('/hello', view('hello')); ์ ๊ฐ์ด view์๊ฒ ์ ๋ฌํ  ์ ๋ณด๊น์ง ๊ฐ์ด ์ฒ๋ฆฌํ์ง๋ง,

์ด์ ๋ ์ด ๊ณผ์ ์ ์ปจํธ๋กค๋ฌ์์ ์ฒ๋ฆฌํ ๊ฒ์ด๋ค.

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

์ ์ฝ๋์ ๊ฐ์ด index() ๋ฉ์๋๋ฅผ ํตํด ํ์๋ฅผ ์ ์ํ๋ค.

web.php์์ ์ ๋ฉ์๋๋ฅผ ์ฌ์ฉํ๊ธฐ ์ํด์ ๋ค์๊ณผ ๊ฐ์ด ์ฝ๋๋ฅผ ๊ตฌํํด์ฃผ๋ฉด ๋๋ค.

```php
// web.php
Route::get('/hello', 'HelloController@index');
```

'HelloController์ index ๋ฉ์๋๋ฅผ ์คํํ๋ผ'๋ผ๋ ๋ป์ด๋ค.

์ด์ฒ๋ผ ์ปจํธ๋กค๋ฌ์ ์ฌ์ฉ์ ํตํด ๋์ฑ ๊ฐ์ฒด์งํฅ์ ์ธ ํ๋ก๊ทธ๋๋ฐ์ ํ  ์ ์๋ค.

<br/><br/>

## ๐งฉ ๋ชจ๋ธ ์์ฑ๊ณผ ๋ฐ์ดํฐ๋ฒ ์ด์ค ์ฌ์ฉ๋ฒ

๋ฐ์ดํฐ๋ฒ ์ด์ค๋ฅผ ํตํด ํ์ด๋ธ์ ๋ง๋ ๋ค๊ณ ํด๋ ๊ณง๋ฐ๋ก ์ฌ์ฉํ  ์ ์๊ณ , ๋ชจ๋ธ์ ์ ์ํด์ค์ผํ๋ค.

<br/>

- ๋ชจ๋ธ๋ง๋ค๊ธฐ ๋ช๋ น์ด

```
$php artisan make:model ๋ชจ๋ธ๋ช
```

๋ค์ ๋ช๋ น์ด๋ฅผ ์๋ ฅํ๋ฉด appํด๋์ ํ์ํด๋์ ๋ชจ๋ธ๋ช.php ํ์ผ์ด ์๊ธด๋ค.

๋ค์ routes์ web.php ํด๋์ ๊ฐ์ Route::get('/๋ชจ๋ธ๋ช', '๋ชจ๋ธ๋ชController@index'); ๋ฅผ ํตํด ํธ์ถํด๋ณด๋ ๊ณผ์ ์ ์ค์ตํด๋ณด์.

์ฐ์  ๋ชจ๋ธ๋ช์ Controller๋ฅผ ๋ง๋ค๊ธฐ ์ํด ์๋์ ๋ช๋ น์ด๋ฅผ ์๋ ฅ

- ์ปจํธ๋กค๋ฌ๋ง๋ค๊ธฐ ๋ช๋ น์ด

```
$php artisan make:controller ๋ชจ๋ธ๋ชController
```

๋ช๋ น์ด๋ฅผ ์คํํ์ผ๋ฉด app\Http\Controllers\ ํด๋์ ๋ชจ๋ธ๋ชController.php๊ฐ ์์ฑ๋๋ค.

์๋์ ๊ฐ์ด App\๋ชจ๋ธ๋ช::all() ์ ํตํด ๋ชจ๋ธ์ ๋ชจ๋  ์์๋ฅผ ๊ฐ์ ธ์จ ๋ค view ํจ์๋ฅผ ํตํด ํด๋น ๋ธ๋ ์ด๋ ํ์ผ๋ก ๊ฐ์ฒด๋ฅผ ๋๊ธด๋ค.

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

๋ธ๋ ์ด๋ ํ์ผ์์๋ ๊ฐ์ ธ์จ ๊ฐ์ฒด๋ฅผ ํ์ดํ๊ธฐํธ(->) ๋ฅผ ์ด์ฉํ์ฌ ๋ฐ์ดํฐ๋ฒ ์ด์ค์ ์ ๊ทผํ๋ค.

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

### Web์์ ๋์ ์์ (๋ชจ๋ธ๋ช Project ๊ธฐ์ค)

127.0.0.1:8000/projects ๋ฅผ ์๋ ฅํ๊ฒ๋๋ฉด

- routes\web.php ์์ Route::get('/projects','ProjectController@index'); ์คํ
- app\Http\Controllers\ProjectController.php(์ปจํธ๋กค๋ฌ) ํ์ผ์ index ๋ฉ์๋ ํธ์ถ
- index ๋ฉ์๋์์ app\Project.php(๋ชจ๋ธ) ์ ํตํด ๋ฐ์ดํฐ๋ฒ ์ด์ค ํ์ผ์ ๋ชจ๋ ๊ฐ์ง๊ณ ์ด
- view ํจ์๋ฅผ ํตํด resources\views\projects\index.blade.php(๋ทฐ)๋ฅผ ์น ํ๋ฉด์ ๋์ฐ๊ธฐ ์ ์ ๋ฐ์ดํฐ๋ฒ ์ด์ค๋ฅผ ๋ด์๋์๋ projects ๋ณ์๋ฅผ ๋ฃ์ด์ฃผ๊ณ  ์น ํ๋ฉด์ ๋์์ค
- ์ปจํธ๋กค๋ฌ์ index ๋ฉ์๋๊ฐ ์ข๋ฃ๋จ.

<br/><br/>

## ๐งฉ tailwindcss ํ๊ฒฝ์ค์  (node.js๊ฐ ์ค์น๋์ด์์ด์ผํจ.)

์ค์น ๊ฐ์ด๋ : https://tailwindcss.com/docs/installation

- phpStorm์ผ๋ก ๋์๊ฐ์ ํฐ๋ฏธ๋์ ํจ๋ค.

```
$npm install
```

```
$npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
```

- npm install์ด ๋๋๋ฉด node_modules ๋ผ๋ ํด๋๊ฐ ์๊ธฐ๋ ๊ฒ์ ํ์ธํ  ์ ์๋ค.

- resources ํด๋์ ๋ค์ด๊ฐ cssํด๋๋ฅผ ๋ง๋ค๊ณ , tailwind.css ํ์ผ์ ์์ฑํ๋ค.

```css
/* resources/css/tailwind.css */
@tailwind base;
@tailwind components;
@tailwind utilities;
```

- ์ ์ฝ๋๋ฅผ ์๋ ฅํ๋ค.

- webpack.mix.js ํ์ผ์ ๋ค์ด๊ฐ์ ์๋์ ๊ฐ์ด ๋ฐ๊ฟ์ค๋ค.

```javascript
// webpack.mix.js
mix.js("resources/js/app.js", "public/js")
    .sass('resources/sass/app.scss', 'public/css')
    .postCss("resources/css/tailwind.css", "public/css", [
        require("tailwindcss"),
    ]);
```

- ์๋ ๋ช๋ น์ด๋ฅผ ์คํ์ํจ๋ค.

```
$npm run dev
```

### ๐ด ์ด๋ postCSS8 Error๊ฐ ๋ฐ์ํ  ์ ์๋ค. ํธํ์ฑ๋ฌธ์ ์ด๋ฏ๋ก postCSS7๋ก ๋ฐ๊ฟ์ฃผ๋ฉด ๋๋ค.

```
$npm uninstall tailwindcss postcss autoprefixer
$npm install -D tailwindcss@npm:@tailwindcss/postcss7-compat postcss@^7 autoprefixer@^9
```

<br/>

์ ์๋ฃ๊ฐ ๋์์ผ๋ฉด public/css/tailwind.css ๊ฐ ์์ฑ๋์์ ๊ฒ์ด๋ค.

<br/>

### Tailwind ์ฌ์ฉ๋ฐฉ๋ฒ

๋ธ๋ ์ด๋ ํ์ผ์ head ํ๊ทธ๋ถ๋ถ์์
    
```html
<link rel="stylesheet" href=""{{ mix('css/tailwind.css') }}">
```
                                                            
๋ค์์ ์ถ๊ฐํด์ฃผ๋ฉด ๋๋ค.

<br/><br/>
                                  
## ๐งฉ POST ์ฌ์ฉ๋ฐฉ๋ฒ

POST์ ๋ค์ด๋ฐ ๊ท์น

<img width="647" alt="แแณแแณแแตแซแแฃแบ 2021-11-30 แแฉแแฅแซ 1 21 57" src="https://user-images.githubusercontent.com/79779676/143904588-2697c092-a140-4354-8feb-4de12bf1902c.png">

```
$php artisan make:model Task -c -m
```

์ ๋ช๋ น์ด๋ฅผ ์๋ ฅํ๋ฉด ํ๋ฒ์ ๋ชจ๋ธ๊ณผ ์ปจํธ๋กค๋ฌ ๋ง์ด๊ทธ๋์ด์์ ์์ฑํ  ์ ์๋ค.

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
public function store(Request $request){ // Request๋ฅผ ํตํด POST๋ก ๋์ด์จ ๋ฐ์ดํฐ ์ ๊ทผ ๊ฐ๋ฅ

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
    protected $fillable = ['title','body']; // title ๊ณผ body์ ๋ณ๊ฒฝ์ ํ์ฉํ๋ค.
}
```

### ๊ทธ๋ฅ ์ด๋ ๊ฒํด์ ์คํ์ ํด๋ณด๋ฉด 491 ERROR๊ฐ ๋ฐ์ํ๋ค.

URL : https://laravel.com/docs/8.x/csrf

CSRF Protection์ ์ํด ๋ผ๋ผ๋ฒจ์์ ๋์์ ๋ฉ์ถ๋ค.

๋ฐ๋ผ์, ํด๋น ์ฝ๋๋ฅผ head ํ๊ทธ์ ์ถ๊ฐํด์ค์ผํ๋ค.

```
<meta name="csrf-token" content="{{ csrf_token() }}">
```

๊ทธ ๋ค์ formํ๊ทธ์๋ @csrf ๋ฅผ ์ถ๊ฐํด์ฃผ๋ฉด ๋๋ค.

<br/><br/>

## ๐งฉ GET์ show๋ฐฉ์

GET์ show ๋ฐฉ์์ ํด๋น ์ ๋ณด์ ๋ง๋ url์ ์ค์ ํ  ์ ์๋ค. ex) id = 1, 127.0.0.1:8000/tasks/1

๋ค์ด๋ฐ ๊ท์น์ ์๋์ ๊ฐ๋ค.

<img width="646" alt="แแณแแณแแตแซแแฃแบ 2021-11-30 แแฉแแฅแซ 1 14 03" src="https://user-images.githubusercontent.com/79779676/143903182-2941fd1a-4ebb-4318-8f9d-1ad289bba54a.png">

```php
// web.php
Route::get('/tasks/{task}','TaskController@show');
```

```php
// app/Http/Controllers/TaskController.php
public function show(Task $task){ 
// laravel์์ ๋งค๊ฐ๋ณ์์ ๋ชจ๋ธ์๋ฃํ์ ์์ ๋ถ์ฌ์ฃผ๋ฉด ์์์ $task id์ ๋ง๋ ์ด์ ์ฐพ์ $task๋ณ์์ ๋ฃ์ด์ค๋ค.
        return view('tasks.show',[
            'task' => $task
        ]);
    }
```

๋ธ๋ ์ด๋ ํ์ผ์์๋ Controller์์ task๋ก ๋ฐ์ดํฐ๋ฒ ์ด์ค ์ ๋ณด๋ฅผ ๋๊ฒจ์คฌ๊ธฐ๋๋ฌธ์

$task ๊ฐ์ฒด๋ฅผ ์ ๊ทผํด์ ์ํ๋ ์ ๋ณด๋ฅผ ๋นผ๋ด๋ฉด ๋๋ค. ex) id๋ฅผ ์ํ๋ฉด, $task -> id

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

<br/><br/>

## ๐งฉ ๋ฐ์ดํฐ๋ฒ ์ด์ค๋ฅผ ์์ ํ๊ธฐ (PUT)

์๋์ ๊ทธ๋ฆผ๊ณผ ๊ฐ์ด ๋ฐ์ดํฐ๋ฅผ ์์ ํ๋ ํญ์ /tasks/{{task}}/edit ์ผ๋ก ํ๋ค.

<img width="647" alt="แแณแแณแแตแซแแฃแบ 2021-12-01 แแฉแแฎ 8 39 37" src="https://user-images.githubusercontent.com/79779676/144228200-02160e36-a52d-46b6-a108-12b1120979ce.png">

```php
// web.php
Route::get('/tasks/{task}/get', 'TaskController@edit');
```

```php
// app/Http/Controllers/TaskController.php

public function edit(Task $task){
    
    return view('tasks.edit',[
        'task' => $task
    ]);
}
```

์ดํ edit.blade.php๋ฅผ ์์ฑํด์ค๋ค.

- edit.blade.php์์ form ํ๊ทธ

```php
<form action="/tasks/{{$task->id}}" method="POST">
            @method('PUT') // ๋ธ๋ ์ด๋์์๋ PUT,PATCH๋ฅผ ์ฌ์ฉํ  ์ ์์ผ๋ฏ๋ก, ํด๋น ์ฝ๋๋ฅผ ๋ฃ์ด์ค๋ค.
            @csrf
            <label class="block" for="title">Title</label>
            <input class="border border-gray-500 w-full" type="text" name="title" id="title" value="{{$task->title}}"><br/>

            <label for="body">Body</label>
            <textarea class="block border border-gray-500 w-full" name="body" id="body" cols="30" rows="10">{{$task->body}}</textarea>

            <button class="bg-blue-500 text-white px-1.5 m-1 float-right">Submit</button>
        </form>
```

Submit ๋ฒํผ์ด ๋๋ฆฌ๋ฉด ๋ฐ์ดํฐ๋ฒ ์ด์ค๋ฅผ ์๋ฐ์ดํธ ํด์ค์ผํ๋ค.

```php
// web.php
Route::put('/tasks/{task}', 'TaskController@update');
```

```php
// app/Http/Controllers/TaskController.php
public function update(Task $task){
    $task->update([
        'title' => request('title'),
        'body' => request('body')
    ]);
    return redirect('/tasks/'.$task->id);
}
```

<br/><br/>

## ๐งฉ ๋ฐ์ดํฐ๋ฒ ์ด์ค ์ญ์ ํ๊ธฐ (DELETE)

๋ง์ง๋ง์ผ๋ก, ๋ฐ์ดํฐ๋ฒ ์ด์ค๋ฅผ ์ญ์ ํ๋ ๋ฐฉ๋ฒ์ด๋ค.

<img width="649" alt="แแณแแณแแตแซแแฃแบ 2021-12-01 แแฉแแฎ 11 07 08" src="https://user-images.githubusercontent.com/79779676/144248751-f0c3a5f0-9c23-47cd-8fdd-cdd5777bda8f.png">

์ ๊ทธ๋ฆผ๊ณผ ๊ฐ์ด ๋ค์ด๋ฐ ์ฒ๋ฆฌ๋ฅผ ํ๋ค.

```php
// web.php
Route::delete('/tasks/{task}','TaskController@destroy');
```

```php
// app/Http/Controllers/TaskController.php
public function destroy(Task $task){
    $task -> delete();
    return redirect('/tasks');
}
```

๋ธ๋ ์ด๋๋ ๋ค์๊ณผ ๊ฐ์ด ์์ฑํ๋ค.

```php
<form action="/tasks" method="POST">
    @method('DELETE') // html์์๋ DELETE๋ฅผ ์ฒ๋ฆฌ๋ชปํ๊ธฐ ๋๋ฌธ์ ๋ค์๊ณผ ๊ฐ์ด ๋ช์ํด์ค์ผํ๋ค.
    @nsrf
    ...
</form
```

### ์๋์ ์ฝ๋๋ฅผ ์๋ ฅํ๋ฉด ์ปค๋ฉ๋์์์ ๋ฐ์ดํฐ ๋ฒ ์ด์ค๋ฅผ ์๋ฎฌ๋ ์ด์ ํด๋ณผ ์ ์๋ค.

```
$php artisan tinker
```

- ๋ชจ๋  ๋ฐ์ดํฐ๋ฒ ์ด์ค ๊ฐ์ ธ์ค๊ธฐ

```
App/Task::all()
```

- ๋ชจ๋  ๋ฐ์ดํฐ๋ฒ ์ด์ค ์ต์ ์์ผ๋ก ๊ฐ์ ธ์ค๊ธฐ

```
App/Task::latest()->get()
```

<br/><br/>

## ๐งฉ Validation (๋ฐ์ดํฐ ๊ฒ์ฆ)

๊ธฐ๋ณธ์ ์ผ๋ก POST๋ฅผ ์ฌ์ฉํ ๋ ๋น๊ฐ์ ๋ณด๋ด๊ฒ ๋๋ฉด, ์๋ฌ๊ฐ ๋๊ฒ ๋๋ค.

์ด๋ฅผ ๋ง์์ฃผ๋๊ฒ์ด Validation์ด๋ค.

1. JavaScript required ์ด์ฉ

```html
<input class="border border-gray-500 w-full @error('title') border border-red-700 @enderror" type="text" name="title" id="title" value="{{old('title')?old('title'):$task->title}}" required><br/>
```

์์ ๊ฐ์ด ํ๊ทธ ๋ท๋ถ๋ถ์ required๋ฅผ ๋ถ์ด๋ฉด, ๋น ๊ฐ์ ์ ์ถํ๋ ๊ฒ์ ๋ง์์ค ์ ์๋ค.

ํ์ง๋ง, ์ด ๋ฐฉ๋ฒ์ ๊ฐ๋ฐ์ ๋๊ตฌ๋ฅผ ํตํด required๋ฅผ ์ ๊ฑฐํ  ์ ์๊ธฐ ๋๋ฌธ์ 2์ค์ผ๋ก ์๋ฒ์์ ๋ง์์ฃผ๋ ๊ฒ์ด ํ์ํ๋ค.

2. Controller์์ validate() ์ฌ์ฉ

```php
// app/Http/Controllers/TaskController.php

public function store(){
    request->validate([
        'title'=>'required',
        'body'=>'required'
    ]);
    $task = Task::create(request(['title','body']));
    return redirect('/tasks/'.$task->id);
}
```

์์๊ฐ์ด ์ค์ ํด์ค ์ ์๋ค.

### old( ) ํจ์

validation์ ์ฌ์ฉํ์๋, ๋น ๊ฐ์ด ์์ผ๋ฉด ํ์ด์ง๊ฐ ๋ฆฌ๋ก๋ฉ๋๋๋ฐ, ์ด๋ ๊ธฐ์กด์ ์๋ ฅํ๋ ๊ฐ๋ค์ด ๋ค ๋ ๋ผ๊ฐ๊ฒ๋๋ค.

์ด๋ฅผ ๋ฐฉ์งํ  ์ ์๋ ์ฝ๋๊ฐ old()์ด๋ค.

```php
<input class="border border-gray-500 w-full @error('title') border border-red-700 @enderror" type="text" name="title" id="title" value="{{old('title')?old('title'):$task->title}}" required><br/>
```

value ๋ถ๋ถ์ if๋ฌธ์ ๋ฃ์ด ๊ธฐ์กด์ ์๋ ฅํ๋ ๊ฐ์ด ์์ผ๋ฉด, ๊ทธ ๊ฐ์ ๋ฃ์ด์ฃผ๊ณ  ์๋๋ฉด, ๋ฐ์ดํฐ๋ฒ ์ด์ค์ ๊ฐ์ ๋ฃ์ด์ค๋ค.

<br/><br/>

## ๐งฉ ๋ก๊ทธ์ธ ๊ตฌํ

laravel์์ ๋ก๊ทธ์ธ ํ์ด์ง ๋ง๋ค๊ธฐ๋ ์งฑ์ฝ๋ค.

```
$php artisan make:auth
```

์ด๋ ๊ฒ ํ๋ฉด ๋ก๊ทธ์ธ ํ์ด์ง๊ฐ ๋ง๋ค์ด์ง๋ค.

<br/><br/>

## ๐งฉ ๊ถํ ์ค์ ํ๊ธฐ

```php
// web.php
Route::prefix('tasks')->middleware('auth')->group(function(){
    Route::get('/','TaskController@index');
    Route::get('/create','TaskController@create');
    Route::post('/','TaskController@store');
    Route::get('/{task}','TaskController@show');
    Route::get('/{task}/edit','TaskController@edit');
    Route::put('/{task}','TaskController@update');
    Route::delete('/{task}','TaskController@destroy');
});
```

์ ์ฝ๋์๊ฐ์ด prefix()๋ฅผ ํตํด url์ ์ค๋ณต์ ์ค์ผ ์ ์๊ณ , middleware('auth')๋ฅผ ํตํด group์์ ๋ด์ฉ๋ค์

๋ก๊ทธ์ธ ์์ด ์ ๊ทผํ์ง ๋ชปํ๊ฒ ์ค์ ํ๋ค.

<br/>

### auth()->id()

auth()->id()๋ฅผ ํตํด ํ์ฌ ๋ก๊ทธ์ธํด์๋ ์์ด๋๋ฅผ ์์๋ผ ์ ์๋ค.

<br/>

### auth()->id()๋ฅผ ํ์ฉํ์ฌ ๋ณธ์ธ์ ๊ฒ์๋ฌผ๋ง ๋ณผ ์ ์๊ฒ ์ค์ ํ๊ธฐ

```php
// app/Http/Controllers/TaskController.php
public function index(){
    $tasks = Task::latest()->where('user_id',auth()->id())->get();
    return view('tasks.index',[
        'tasks' => $tasks
    ]);
}

public function show(Task $task){
    if(auth()->id() != $task->user_id){
        abort(403);
    }
    return view('tasks.show',[
        'task'=>$task
    ]);
}
```

<br/><br/>

## ๐งฉ Route resource

Route::resource ๋ฅผ ์ด์ฉํ๋ฉด "CRUD"๊ฒฝ๋ก๋ฅผ ํ ์ค์ ์ฝ๋๋ก ์ปจํธ๋กค๋ฌ์ ํ ๋นํ  ์ ์๋ค.

<br/><br/>

## ๐งฉ ๋ชจ๋ธ ๊ด๊ณ

Laravel Korea URL: https://laravel.kr/docs/5.7/eloquent-relationships

<br/><br/>
