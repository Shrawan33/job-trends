<form>
    @php
        $i= 1;
    @endphp

    @forelse($appliedJob->questionnaires as $questionnaire)

    <div class="form-group mb-4">
        <label for="" class="text-black-50">{!! __('label.question') !!} 0{{$i}}</label>
        <input type="text" class="form-control text-black" readonly value="{{$questionnaire->question->title??''}}">
        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..." readonly>{{$questionnaire->answer??''}}</textarea>
    </div>
    @php
    $i++;
    @endphp
     @empty
     <div class="col-12">
        <h6 class="text-center">{!! __('label.no_questions') !!}</h6>
        </div>
    @endforelse

</form>

