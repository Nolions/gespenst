@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <i class="bi bi-pencil" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg  leading-7 font-semibold">
                            <a href="{{url("/lse")}}" class="underline text-gray-900">填寫LSE問卷</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                    <div class="flex items-center">
                        <i class="bi bi-person-vcard" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="{{url("/style")}}" class="underline text-gray-900">Kolb 學習風格</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <i class="bi bi-book" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="{{url("/material/recommend")}}" class="underline text-gray-900">開始學習</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t md:border-l">
                    <div class="flex items-center">
                        <i class="bi bi-person-vcard" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="{{url("/material/list")}}" class="underline text-gray-900">教材管理</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <i class="bi bi-book" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="{{url("/record")}}" class="underline text-gray-900">登入紀錄</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t md:border-l">
                    <div class="flex items-center">
                        <i class="bi bi-person-vcard" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="{{url("/record/users")}}" class="underline text-gray-900">所有使用者登入紀錄</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                    <div class="flex items-center">
                        <i class="bi bi-power" style="font-size: 2rem; "></i>
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900">
                            <a href="{{url("/logout")}}" class="underline text-gray-900">登出</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t md:border-l">
                    <div class="flex items-center">

                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
