<!DOCTYPE html>
<html>

<head>
    <title>Slambook Step</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }

        .form-container {
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-group input {
            width: auto;
            margin-right: 5px;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 4px;
            height: 20px;
            margin-bottom: 20px;
        }

        .progress-bar {
            background-color: #007bff;
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Slambook Form</h2>
        <p>Hello, {{ Auth::user()->name}}, please fill out your slambook!</p>

        <div class="progress">
            <div class="progress-bar" style="width: {{ ($step / 6) * 100 }}%"></div>
        </div>
        <p>Step {{ $step }} of 6</p>

        @if($errors->any())
        <div style="color:red; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('slambook.process') }}">
            @csrf
            <input type="hidden" name="step" value="{{ $step }}">

            @if($step == 1)
            <div class="form-group">
                <label for="age">What is your age?</label>
                <input type="number" id="age" name="age" value="{{ old('age', $data['age'] ?? '') }}" min="1" max="120"
                    required>
            </div>
            @endif

            @if($step == 2)
            <div class="form-group">
                <label for="zodiac_sign">What is your zodiac sign?</label>
                <select name="zodiac_sign" id="zodiac_sign" required>
                    <option value="">Select your zodiac sign</option>
                    <option value="Aries" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Aries' ? 'selected' : ''
                        }}>Aries</option>
                    <option value="Taurus" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Taurus' ? 'selected'
                        : '' }}>Taurus</option>
                    <option value="Gemini" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Gemini' ? 'selected'
                        : '' }}>Gemini</option>
                    <option value="Cancer" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Cancer' ? 'selected'
                        : '' }}>Cancer</option>
                    <option value="Leo" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Leo' ? 'selected' : '' }}>
                        Leo</option>
                    <option value="Virgo" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Virgo' ? 'selected' : ''
                        }}>Virgo</option>
                    <option value="Libra" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Libra' ? 'selected' : ''
                        }}>Libra</option>
                    <option value="Scorpio" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Scorpio' ? 'selected'
                        : '' }}>Scorpio</option>
                    <option value="Sagittarius" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Sagittarius'
                        ? 'selected' : '' }}>Sagittarius</option>
                    <option value="Capricorn" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Capricorn'
                        ? 'selected' : '' }}>Capricorn</option>
                    <option value="Aquarius" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Aquarius' ? 'selected'
                        : '' }}>Aquarius</option>
                    <option value="Pisces" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '' )=='Pisces' ? 'selected'
                        : '' }}>Pisces</option>
                </select>
            </div>
            @endif

            @if($step == 3)
            <div class="form-group">
                <label>Are you in a relationship?</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="in_relationship" value="yes" {{ old('in_relationship',
                            $data['in_relationship'] ?? '' )=='yes' ? 'checked' : '' }} required>
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="in_relationship" value="no" {{ old('in_relationship',
                            $data['in_relationship'] ?? '' )=='no' ? 'checked' : '' }} required>
                        No
                    </label>
                </div>
            </div>
            @endif

            @if($step == 4)
            <div class="form-group">
                <label for="dream_job">What is your dream job?</label>
                <input type="text" name="dream_job" id="dream_job"
                    value="{{ old('dream_job', $data['dream_job'] ?? '') }}" required>
            </div>
            @endif

            @if($step == 5)
            <div class="form-group">
                <label for="motto">What is your motto in life?</label>
                <textarea name="motto" id="motto" rows="4" cols="30"
                    required>{{ old('motto', $data['motto'] ?? '') }}</textarea>
            </div>
            @endif

            @if($step == 6)
            <div class="form-group">
                <label for="three_words">Describe yourself in 3 words:</label>
                <textarea name="three_words" id="three_words" rows="4" cols="30"
                    required>{{ old('three_words', $data['three_words'] ?? '') }}</textarea>
            </div>
            @endif

            <div class="navigation">
                <div>
                    @if($step > 1)
                    <button type="submit" name="previous" class="btn-secondary">Previous</button>
                    @endif
                </div>
                <div>
                    @if($step < 6) <button type="submit" name="next" class="btn-primary">Next</button>
                        @else
                        <button type="submit" name="submit" class="btn-success">Submit Slambook</button>
                        @endif
                </div>
            </div>
        </form>
    </div>
</body>

</html>