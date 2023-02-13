@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 ">
        <div class="text-white">
            <h3>教材 {{$material['title']}}</h3>
        </div>

        <div class="mt-8  bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="col-md-7 m-3 col-lg-8">
                <form class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">標題</label>
                            <input type="text" class="form-control" id="firstName" placeholder=""
                                   value="{{$material['title']}}" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">描述</label>
                            <input type="text" class="form-control" id="email" value="{{$material['describe']}}">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">資源連結</label>
                            <input type="text" class="form-control" id="address" value="{{$material['resource_url']}}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Kolb 學習風格</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="checkbox" class="form-check-input" checked
                                   required>
                            <label class="form-check-label" for="credit">具體的經驗</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="checkbox" class="form-check-input" required>
                            <label class="form-check-label" for="debit">省思的觀察</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" type="checkbox" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">抽象的概念</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" type="checkbox" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">主動的實驗</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">教材標籤</h4>

                    <div class="my-3">
                        @foreach($material['tags'] as $tag)
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="checkbox" class="form-check-input"
                                       value="{{$tag['name']}}" checked>
                                <label class="form-check-label" for="credit">{{$tag['name']}}</label>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

{{--                    <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>--}}
                </form>
            </div>
        </div>

    </div>
    </div>
@endsection
