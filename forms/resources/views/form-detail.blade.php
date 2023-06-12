<x-app-layout>
    <div class="d-flex justify-content-center mb-4">
        <div class="card w-75">
            <div class="card-header fs-4">
                {{ $form->title }}
            </div>
        </div>
    </div>

    @if ($form->question)
        @foreach ($form->question as $question)
            <div class="d-flex justify-content-center mb-4">
                <div class="card w-75">
                    <div class="card-header fs-5">
                        {{ $question->title }}
                    </div>
                    @if ($question->answers)
                        @if ($question->type == 'CHECKBOX')
                            <div class="form-check">
                                <ul class="list-group list-group-flush">
                                    @foreach ($question->answers as $answer)
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="checkbox" value="{{ $answer->id }}"
                                                id="flexCheckChecked{{ $loop->iteration }}">
                                            <label class="form-check-label"
                                                for="flexCheckChecked{{ $loop->iteration }}">
                                                {{ $answer->value }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($question->answers as  $answer)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                                id="flexRadioDefault{{ $answer->id.$question->id }}">
                                            <label class="form-check-label"
                                                for="flexRadioDefault{{ $answer->id.$question->id}}">
                                                {{ $answer->value }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
