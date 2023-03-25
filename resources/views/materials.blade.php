@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>教材列表</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="m-2">
                <a class="btn btn-primary" href="{{url("/material")}}" role="button">建立教材</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">標題</th>
                    <th scope="col">描述</th>
                    <th scope="col">學習風格</th>
                    <th scope="col">標籤</th>
                    <th scope="col">教材連結</th>
                    <th scope="col">編輯</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($materials as $material)
                    <tr>
                        <th scope="row">{{$material['id']}}</th>
                        <td>{{$material['title']}}</td>
                        <td>{{$material['describe']}}</td>
                        <td><!-- 教材學習風格 -->
                            @for ($i = 0; $i < count($material['styles']); $i++)
                                {{$i >0?'、':''}}
                                {{$material['styles'][$i]['kolb_style']}}
                                @if ($i >=1)
                                    ...
                                    @break
                                @endif
                            @endfor
                        </td>
                        <td> <!-- 教材標籤 -->
                            @for ($i = 0; $i < count($material['tags']); $i++)
                                {{$i >0?'、':''}}
                                {{$material['tags'][$i]['name']}}
                                @if ($i >=3)
                                    ...
                                    @break
                                @endif
                            @endfor
                        </td>
                        <td><a href="{{$material['resource_url']}}" target="_blank">連結</a></td>
                        <td><a href="./{{$material['id']}}">編輯</a></td>
                        <td>
                            <form action="{{ url("/material/{$material['id']}/delete") }}" method="post">
                                <button type="submit" class="btn btn-info d-inline ">
                                    刪除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 ">
                <div class="m-2 d-inline">
                    <i class="fa-home"></i>
                    <a class="btn btn-danger btn" href="{{url("/")}}" role="button">回首頁</a>
                </div>
            </div>
        </div>
    </div>
@endsection
