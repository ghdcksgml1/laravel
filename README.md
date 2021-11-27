# 📘 Laravel

## 모델 생성과 데이터베이스 사용법

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
