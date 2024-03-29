@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <form action="{{ url("/reply") }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="username" value="{{Auth::user()->username}}">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item mb-3">
                        @include('lse_stage', ['title' => '第一部分：具體的經驗', 'filterType'=> 1,'questions' => $questions])
                        @include('lse_stage', ['title' => '第二部分：省思的觀察', 'filterType'=> 2,'questions' => $questions])
                        @include('lse_stage', ['title' => '第三部分：抽象的概念', 'filterType'=> 3,'questions' => $questions])
                        @include('lse_stage', ['title' => '第四部分：主動的實驗', 'filterType'=> 4,'questions' => $questions])
                    </div>
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-book"></i>
                        提交
                    </button>
                    <div class="m-2">
                        <a class="btn btn-danger btn-lg" href="{{url("/")}}" role="button">回首頁</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
