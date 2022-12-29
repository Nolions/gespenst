@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">具體的經驗</th>
                    <th scope="col">省思的觀察</th>
                    <th scope="col">抽象的概念</th>
                    <th scope="col">主動的實驗</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"></th>
                    @foreach($kolbStyleScores as $score)
                        <td>{{$score}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
