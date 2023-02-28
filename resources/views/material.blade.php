@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 ">
        <div class="text-white">
            <h3>教材 {{$material['title']}}</h3>
        </div>

        <div class="mt-8  bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="col-md-7 m-3 col-lg-8">
                <form action="{{ url("/material/{$material['id']}") }}" method="post" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">標題</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder=""
                                   value="{{$material['title']}}" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">描述</label>
                            <input type="text" class="form-control" id="describe" name="describe"
                                   value="{{$material['describe']}}">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">資源連結</label>
                            <input type="text" class="form-control" id="resourceUrl" name="resource_url"
                                   value="{{$material['resource_url']}}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Kolb 學習風格</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="ce" name="styles[]" value="ce" type="checkbox" class="form-check-input"
                                {{in_array('ce', $material['styles'])?'checked':''}}>
                            <label class="form-check-label" for="ce">具體的經驗</label>
                        </div>
                        <div class="form-check">
                            <input id="ro" name="styles[]" value="ro" type="checkbox" class="form-check-input"
                                {{in_array('ro', $material['styles'])?'checked':''}}>
                            <label class="form-check-label" for="ro">省思的觀察</label>
                        </div>
                        <div class="form-check">
                            <input id="ac" name="styles[]" value="ac" type="checkbox" class="form-check-input"
                                {{in_array('ac', $material['styles'])?'checked':''}}>
                            <label class="form-check-label" for="ac">抽象的概念</label>
                        </div>
                        <div class="form-check">
                            <input id="ae" name="styles[]" value="ae" type="checkbox" class="form-check-input"
                                {{in_array('ae', $material['styles'])?'checked':''}}>
                            <label class="form-check-label" for="ae">主動的實驗</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">教材標籤</h4>
                    <div class="my-3">
                        @foreach($tags as $tag)
                            <div class="form-check">
                                <input id="tag{{$tag['id']}}}" name="tags[]" type="checkbox" class="form-check-input"
                                       value="{{$tag['id']}}" {{in_array($tag['id'], $material['tags'])?'checked': ''}}>
                                <label class="form-check-label" for="tag{{$tag['id']}}}">{{$tag['name']}}</label>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <button class="btn btn-primary btn-lg" type="submit">Save</button>
                    <a class="btn btn-danger btn-lg" href="{{url("/material/list")}}" role="button">Cancel</a>
                </form>

            </div>
        </div>

    </div>
@endsection
