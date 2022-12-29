@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <form action="{{ url("/reply") }}" method="post">
                {{ csrf_field() }}
                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach($questions as $key => $question)
                        @include('question', ['question' => $question])
                    @endforeach
                </div>
                <div class="container">
                    <input class="btn btn-primary" type="submit" value="提交">
                </div>
            </form>
        </div>
    </div>
@endsection
