@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>使用者最後登入紀錄</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <table class="table">
                <thead>
                <tr>
                    <th>使用者ID</th>
                    <th>日期</th>
                    <th>時間</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{$record['username']}}</td>
                        <td>{{date("Y-m-d", strtotime($record['create_at']))}}</td>
                        <td>{{date("H:i:s", strtotime($record['create_at']))}}</td>
                        <td><a href='{{$record['username']}}'>更多</a></td>
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