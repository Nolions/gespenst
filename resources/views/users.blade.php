@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>學習者學習風格結果列表</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
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
            <div class="m-2">
                <i class="fa-home"></i>
                <a class="btn btn-danger btn" href="{{url("/")}}" role="button">回首頁</a>
            </div>
        </div>
    </div>
@endsection
