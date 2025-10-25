<div>
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
    <form method="POST" action="{{ route('slambook.update', $slambook->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" value="{{ old('name', $name) }}" readonly />
        <br />
        <label for="age">Age: </label>
        <input type="text" id="age" name="age" value="{{ old('age', $slambook->age) }}" />
        <br />
        <label for="zodiac_sign">Zodiac Sign: </label>
        <select id="zodiac_sign" name="zodiac_sign">
            @php
            $zodiacSigns = [
            'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
            'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
            ];
            @endphp
            @foreach ($zodiacSigns as $sign)
            <option value="{{ $sign }}" {{ old('zodiac_sign', $slambook->zodiac_sign) == $sign ? 'selected' : '' }}>
                {{ $sign }}</option>
            @endforeach
        </select>
        {{-- <input type="text" id="zodiac_sign" name="zodiac_sign"
            value="{{ old('zodiac_sign', $slambook->zodiac_sign) }}" /> --}}
        <br />
        <label for="in_relationship">In a relationship: </label>
        <input type="radio" id="in_relationship_yes" name="in_relationship" value="1" {{ old('in_relationship',
            $slambook->in_relationship) ? 'checked' : '' }} />
        <label for="in_relationship_yes">Yes</label>
        <input type="radio" id="in_relationship_no" name="in_relationship" value="0" {{ !old('in_relationship',
            $slambook->in_relationship) ? 'checked' : '' }} />
        <label for="in_relationship_no">No</label>
        <br />
        <label for="dream_job">Dream Job: </label>
        <input type="text" id="dream_job" name="dream_job" value="{{ old('dream_job', $slambook->dream_job) }}" />
        <br />
        <label for="motto">Motto in life:</label>
        <input type="text" id="motto" name="motto" value="{{ old('motto', $slambook->motto) }}" />
        <br />
        <label for="three_words">Describe yourself in 3 words: </label>
        <input type="text" id="three_words" name="three_words"
            value="{{ old('three_words', $slambook->three_words) }}" />

        <button type="submit">Save Changes</button>
        <a href="/">Cancel</a>
    </form>
</div>