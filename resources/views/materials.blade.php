@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>{{Auth::user()->username}}的Kolb學習風格指數</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">標題</th>
                    <th scope="col">描述</th>
                    <th scope="col">教材連結</th>
                    <th scope="col">檢視</th>
                </tr>
                </thead>
                <tbody>
                @foreach($materials as $material)
                    <tr>
                        <th scope="row">{{$material['id']}}</th>
                        <td>{{$material['title']}}</td>
                        <td>{{$material['describe']}}</td>
                        <td><a href="{{$material['resource_url']}}" target="_blank">連結</a></td>
                        <td><a href="./{{$material['id']}}">更多</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
