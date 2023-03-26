@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>為你推薦以下教材</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="ml-4 border-gray-200">
                <form action="{{ url("/material/recommend") }}" method="get">
                    <div class="m-2 ">
                        <label class="d-inline">學習標地：</label>
                        <select name="tag" class="form-select w-25 p-3 d-inline">
                            <option value="0" {{$selected == 0?'selected':''}}>All</option>
                            @foreach($tags as $tag)
                                <option value="{{$tag['id']}}" {{$selected == $tag['id']?'selected':''}}>
                                    {{$tag['name']}}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary btn-lg d-inline ">
                            Search
                        </button>
                    </div>
                </form>

                <div class="m-2 ">
                    <label class="d-inline">筆數：{{count($materials)}}</label>
                </div>
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
