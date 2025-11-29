@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ Vite::asset('resources/css/slambook-new.css') }}">
<div class="container">
    <div class="slambook-form-container">
        <h1>{{ isset($slambook) ? 'Edit Your Slambook' : 'Create Your Slambook' }}</h1>

        <form id="slambookForm" method="POST" action="{{ route('slambook.store') }}">
            @csrf

            @foreach($sections as $index => $section)
            <div class="section-container" id="section-{{ $section->id }}"
                style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                <div class="section-header">
                    <h2>{{ $section->section_name }}</h2>
                    <p class="section-description">{{ $section->description }}</p>
                </div>

                <div class="questions-wrapper">
                    @foreach($section->questions as $question)
                    <div class="form-group">
                        <label for="question_{{ $question->id }}">
                            {{ $question->question_text }}
                            <span class="required">*</span>
                        </label>

                        @switch($question->question_type)
                        @case('number')
                        <input type="number" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}"
                            class="form-control"
                            value="{{ old('answers.' . $question->id, isset($slambook) ? $slambook->answers[$question->id] ?? '' : '') }}"
                            required min="1" max="120">
                        @break

                        @case('short_answer')
                        <input type="text" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}"
                            class="form-control"
                            value="{{ old('answers.' . $question->id, isset($slambook) ? $slambook->answers[$question->id] ?? '' : '') }}"
                            required maxlength="255">
                        @break

                        @case('long_answer')
                        <textarea name="answers[{{ $question->id }}]" id="question_{{ $question->id }}"
                            class="form-control" rows="4"
                            required>{{ old('answers.' . $question->id, isset($slambook) ? $slambook->answers[$question->id] ?? '' : '') }}</textarea>
                        @break

                        @case('yes_no')
                        <div class="radio-group">
                            @php
                            // Extract options from question text (e.g., "Coffee or Tea?")
                            $parts = explode(' or ', str_replace('?', '', $question->question_text));
                            $option1 = trim($parts[0] ?? 'Yes');
                            $option2 = trim($parts[1] ?? 'No');
                            $savedValue = old('answers.' . $question->id, isset($slambook) ?
                            $slambook->answers[$question->id] ?? '' : '');
                            @endphp

                            <label class="radio-label">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option1 }}" {{
                                    $savedValue===$option1 ? 'checked' : '' }} required>
                                <span>{{ $option1 }}</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option2 }}" {{
                                    $savedValue===$option2 ? 'checked' : '' }} required>
                                <span>{{ $option2 }}</span>
                            </label>
                        </div>
                        @break

                        @case('true_false')
                        <div class="radio-group">
                            @php
                            $savedValue = old('answers.' . $question->id, isset($slambook) ?
                            $slambook->answers[$question->id] ?? '' : '');
                            @endphp

                            <label class="radio-label">
                                <input type="radio" name="answers[{{ $question->id }}]" value="Yes" {{
                                    $savedValue==='Yes' ? 'checked' : '' }} required>
                                <span>Yes</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="answers[{{ $question->id }}]" value="No" {{ $savedValue==='No'
                                    ? 'checked' : '' }} required>
                                <span>No</span>
                            </label>
                        </div>
                        @break

                        @case('multiple_choice')
                        <div class="select-wrapper">
                            <select name="answers[{{ $question->id }}]" id="question_{{ $question->id }}"
                                class="form-control" required>
                                <option value="">Select an option</option>
                                @php
                                $options = json_decode($question->options, true) ?? [];
                                $savedValue = old('answers.' . $question->id, isset($slambook) ?
                                $slambook->answers[$question->id] ?? '' : '');
                                @endphp
                                @foreach($options as $option)
                                <option value="{{ $option }}" {{ $savedValue===$option ? 'selected' : '' }}>
                                    &#9733; {{ $option }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @break

                        @default
                        <input type="text" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}"
                            class="form-control"
                            value="{{ old('answers.' . $question->id, isset($slambook) ? $slambook->answers[$question->id] ?? '' : '') }}"
                            required>
                        @endswitch

                        @error('answers.' . $question->id)
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @endforeach
                </div>

                <div class="form-navigation">
                    @if($index > 0)
                    <button type="button" class="btn btn-secondary prev-btn" data-current="{{ $section->id }}"
                        data-prev="{{ $sections[$index - 1]->id }}">
                        Previous
                    </button>
                    @endif

                    @if($index < count($sections) - 1) <button type="button" class="btn btn-primary next-btn"
                        data-current="{{ $section->id }}" data-next="{{ $sections[$index + 1]->id }}">
                        Next
                        </button>
                        @else
                        <button type="submit" class="btn btn-success">
                            {{ isset($slambook) ? 'Update Slambook' : 'Submit Slambook' }}
                        </button>
                        @endif
                </div>

                <div class="progress-indicator">
                    Section {{ $index + 1 }} of {{ count($sections) }}
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>

<script type="module" src="{{ Vite::asset('resources/js/slambook.js') }}"></script>
@endsection