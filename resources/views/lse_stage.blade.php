<h2 class="accordion-header" id="flush-heading1">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapse{{$filterType}}" aria-expanded="false"
            aria-controls="flush-collapse{{$filterType}}">
        {{$title}}
    </button>
</h2>
<div id="flush-collapse{{$filterType}}" class="accordion-collapse collapse"
     aria-labelledby="flush-heading{{$filterType}}"
     data-bs-parent="#accordionFlush">
    @foreach($questions as $key => $question)
        @if($question['type'] == $filterType)
            @include('lse_question', ['question' => $question])
        @endif
    @endforeach
</div>
