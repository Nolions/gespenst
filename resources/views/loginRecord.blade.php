@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>{{$username}}的登入紀錄</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <table class="table">
                <thead>
                <tr>
                    <th>日期</th>
                    <th>時間</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{date("Y-m-d", strtotime($record['create_at']))}}</td>
                        <td>{{date("H:i:s", strtotime($record['create_at']))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 ">
                <div class="m-2 d-inline">
                    <i class="fa-home"></i>
                    <a class="btn btn-danger btn" href="{{url("/")}}" role="button">回首頁</a>
                </div>
                @if($allowBack)
                    <div class="m-2 d-inline">
                        <i class="fa-backward"></i>
                        <a class="btn btn-dark" href="{{url("/record/users")}}" role="button">回上一頁</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
