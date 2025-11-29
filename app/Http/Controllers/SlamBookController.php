<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlamBook;
use App\Models\Section;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class SlamBookController extends Controller
{
    public function index()
    {
        $sections = Section::with('questions')->get();

        // Get existing answers for the current user
        $existingAnswers = SlamBook::where('user_id', Auth::id())
            ->pluck('response', 'question_id')
            ->toArray();

        return view('slambook.index', [
            'sections' => $sections,
            'slambook' => $existingAnswers ? (object)['answers' => $existingAnswers] : null
        ]);
    }

    public function store(Request $request)
    {
        $answers = $request->input('answers', []);

        // Validate that all questions have answers
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required'
        ]);

        // Delete existing answers for this user
        SlamBook::where('user_id', Auth::id())->delete();

        // Store new answers
        foreach ($answers as $questionId => $response) {
            SlamBook::create([
                'user_id' => Auth::id(),
                'question_id' => $questionId,
                'response' => $response
            ]);
        }

        return redirect('/')->with('success', 'SlamBook saved successfully!');
    }

    public function edit(string $id)
    {
        $slambook = SlamBook::findOrFail($id);
        $name = Auth::user()->name;
        return view(
            'slambook.edit',
            ['slambook' => $slambook, 'name' => $name]
        );
    }

    public function update(Request $request, string $id)
    {
        $slambook = SlamBook::findOrFail($id);

        $request->validate([
            'age' => 'required|integer|min:1|max:120',
            'zodiac_sign' => 'required',
            'in_relationship' => 'required',
            'dream_job' => 'required|string|max:255',
            'motto' => 'required|string',
            'three_words' => 'required|string',
        ]);

        $slambook->update([
            'age' => $request->input('age'),
            'zodiac_sign' => $request->input('zodiac_sign'),
            'in_relationship' => $request->input('in_relationship'),
            'dream_job' => $request->input('dream_job'),
            'motto' => $request->input('motto'),
            'three_words' => $request->input('three_words'),
        ]);

        return redirect('/')->with('success', 'SlamBook updated successfully!');
    }

    public function destroy(string $id)
    {
        $slambook = SlamBook::findOrFail($id);
        $slambook->delete();

        return redirect('/')->with('success', 'SlamBook deleted successfully!');
    }

    public function showStep($step)
    {
        $data = session('slambook_data', []);
        $data['step'] = $step;

        $slambook = SlamBook::where('user_id', Auth::id())->first();
        if ($slambook) {    // edit
            $data['age'] = $slambook->age;
            $data['zodiac_sign'] = $slambook->zodiac_sign;
            $data['in_relationship'] = $slambook->in_relationship;
            $data['dream_job'] = $slambook->dream_job;
            $data['motto'] = $slambook->motto;
            $data['three_words'] = $slambook->three_words;
        }

        return view(
            'slambook.step',
            ['step' => $step, 'data' => $data]
        );
    }

    public function processStep(Request $request)
    {
        $step = $request->input('step');
        $action = $request->input('action');
        $data = session('slambook_data', []);

        // Validate input based on step
        $this->validateStep($request, $step);

        // Store data in session
        switch ($step) {
            case 1:
                $data['age'] = $request->input('age');
                break;
            case 2:
                $data['zodiac_sign'] = $request->input('zodiac_sign');
                break;
            case 3:
                $data['in_relationship'] = $request->input('in_relationship');
                break;
            case 4:
                $data['dream_job'] = $request->input('dream_job');
                break;
            case 5:
                $data['motto'] = $request->input('motto');
                break;
            case 6:
                $data['three_words'] = $request->input('three_words');
                break;
        }

        session(['slambook_data' => $data]);

        // handle navigation
        if ($request->has('next')) {
            return redirect()->route('slambook.step', ['step' => $step + 1]);
        } elseif ($request->has('previous')) {
            return redirect()->route('slambook.step', ['step' => $step - 1]);
        } elseif ($request->has('submit')) {
            return $this->submit();
        }
    }

    public function validateStep(Request $request, $step)
    {
        switch ($step) {
            case 1:
                $request->validate(['age' => 'required|integer|min:1|max:120']);
                break;
            case 2:
                $request->validate(['zodiac_sign' => 'required']);
                break;
            case 3:
                $request->validate(['in_relationship' => 'required']);
                break;
            case 4:
                $request->validate(['dream_job' => 'required|string|max:255']);
                break;
            case 5:
                $request->validate(['motto' => 'required|string']);
                break;
            case 6:
                $request->validate(['three_words' => 'required|string']);
                break;
        }
    }

    public function submit()
    {
        $data = session('slambook_data', []);

        // Save to database
        // if ($action === 'edit') {
        //     $slambook = SlamBook::where('user_id', Auth::id())->first();
        //     if ($slambook) {
        //         $slambook->update([
        //             'age' => $data['age'],
        //             'zodiac_sign' => $data['zodiac_sign'],
        //             'in_relationship' => $data['in_relationship'] === 'yes',
        //             'dream_job' => $data['dream_job'],
        //             'motto' => $data['motto'],
        //             'three_words' => $data['three_words'],
        //         ]);
        //     }
        // }
        // if ($action === 'create') {

        // }

        SlamBook::create([
            'user_id' => Auth::id(),
            'age' => $data['age'],
            'zodiac_sign' => $data['zodiac_sign'],
            'in_relationship' => $data['in_relationship'] === 'yes',
            'dream_job' => $data['dream_job'],
            'motto' => $data['motto'],
            'three_words' => $data['three_words'],
        ]);

        // Clear session data
        session()->forget('slambook_data');

        return redirect('/');
    }
}
