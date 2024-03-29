@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>使用者最後登入紀錄</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="ml-4 border-gray-200">
                <form action="{{ url("/record/users") }}" method="get">
                    <div class="m-2 ">
                        <label class="d-inline">學習風格：</label>
                        <select name="style" class="form-select w-25 p-3 d-inline">
                            <option value="" {{$selected == ''?'selected':''}}>All</option>
                            <option value="ce" {{$selected == 'ce'?'selected':''}}>分散者</option>
                            <option value="ro" {{$selected == 'ro'?'selected':''}}>同化者</option>
                            <option value="ac" {{$selected == 'ac'?'selected':''}}>收斂者</option>
                            <option value="ae" {{$selected == 'ae'?'selected':''}}>調適者</option>
                        </select>
                        <label class="d-inline">Username：</label>
                        <input type="text" class="form-control w-25 p-3 d-inline" placeholder="學號/姓名" name="username" value="{{$username}}">
                        <button type="submit" class="btn btn-primary btn-lg d-inline ">
                            Search
                        </button>
                    </div>
                </form>

                <div class="m-2 ">
                    <label class="d-inline">筆數：{{count($records)}}</label>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>使用者ID</th>
                    <th>日期</th>
                    <th>時間</th>
                    <th>登入次數</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{$record['username']}}</td>
                        <td>{{date("Y-m-d", strtotime($record['create_at']))}}</td>
                        <td>{{date("H:i:s", strtotime($record['create_at']))}}</td>
                        <td>{{$record['count']}}</td>
                        <td><a href='{{$record['username']}}'>更多</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 ">
                {{ $records->links() }}
            </div>
            <div class="m-2">
                <i class="fa-home"></i>
                <a class="btn btn-danger btn" href="{{url("/")}}" role="button">回首頁</a>
            </div>
        </div>
    </div>
@endsection
