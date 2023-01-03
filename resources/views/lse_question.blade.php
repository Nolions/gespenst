<div class="p-6">
    <div class="flex items-center">
        <i class="bi bi-book" style="font-size: 2rem; "></i>
        <div class="ml-4 text-lg leading-7 font-semibold">
            <div class="text-gray-900">
                {{$question['question'] }}
            </div>
        </div>
    </div>

    <div class="ml-12">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
            @foreach($question['option'] as $i => $option)
                <div>
                    <input type="radio" id="que{{$question['id']}}_op{{$i}}"
                           name="{{$question['id']}}"
                           value="{{$option['id']}}"
                           @if($i == 0) checked @endif >
                    <label for="que{{$question['id']}}_op{{$i}}">{{$option['option']}}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
