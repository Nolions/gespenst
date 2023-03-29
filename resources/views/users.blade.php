@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>學習者學習風格結果列表</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="ml-4 border-gray-200">
                <form action="{{ url("/users") }}" method="get">
                    <div class="m-2 ">
                        <label class="d-inline">學習風格：</label>
                        <select name="style" class="form-select w-25 p-3 d-inline">
                            <option value="" {{$selected == ''?'selected':''}}>All</option>
                            <option value="ce" {{$selected == 'ce'?'selected':''}}>分散者</option>
                            <option value="ro" {{$selected == 'ro'?'selected':''}}>同化者</option>
                            <option value="ac" {{$selected == 'ac'?'selected':''}}>收斂者</option>
                            <option value="ae" {{$selected == 'ae'?'selected':''}}>調適者</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-lg d-inline ">
                            Search
                        </button>
                    </div>
                </form>

                <div class="m-2 ">
                    <label class="d-inline">筆數：{{count($users)}}</label>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">學號</th>
                    <th scope="col">具體的經驗</th>
                    <th scope="col">省思的觀察</th>
                    <th scope="col">抽象的概念</th>
                    <th scope="col">主動的實驗</th>
                    <th scope="col">學習風格面向</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user['user_id']}}</th>
                        <td>{{$user['ce_score']}}</td>
                        <td>{{$user['ro_score']}}</td>
                        <td>{{$user['ac_score']}}</td>
                        <td>{{$user['ae_score']}}</td>
                        <td>{{$user['style']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 ">
                {{ $paginate->links() }}
            </div>
            <div class="m-2">
                <i class="fa-home"></i>
                <a class="btn btn-danger btn" href="{{url("/")}}" role="button">回首頁</a>
            </div>
        </div>
    </div>
@endsection
