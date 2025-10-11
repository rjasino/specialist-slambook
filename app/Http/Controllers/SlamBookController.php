<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlamBook;
use Illuminate\Support\Facades\Auth;

class SlamBookController extends Controller
{
    public function index($action)
    {
        return $this->showStep(1, $action);
    }

    public function showStep($step, $action)
    {
        $data = session('slambook_data', []);
        $data['step'] = $step;
        $data['action'] = $action;

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
            ['step' => $step, 'data' => $data, 'action' => $action]
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
            return $this->submit($action);
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

    public function submit($action)
    {
        $data = session('slambook_data', []);

        // Save to database
        if ($action === 'edit') {
            $slambook = SlamBook::where('user_id', Auth::id())->first();
            if ($slambook) {
                $slambook->update([
                    'age' => $data['age'],
                    'zodiac_sign' => $data['zodiac_sign'],
                    'in_relationship' => $data['in_relationship'] === 'yes',
                    'dream_job' => $data['dream_job'],
                    'motto' => $data['motto'],
                    'three_words' => $data['three_words'],
                ]);
            }
        }
        if ($action === 'create') {
            SlamBook::create([
                'user_id' => Auth::id(),
                'age' => $data['age'],
                'zodiac_sign' => $data['zodiac_sign'],
                'in_relationship' => $data['in_relationship'] === 'yes',
                'dream_job' => $data['dream_job'],
                'motto' => $data['motto'],
                'three_words' => $data['three_words'],
            ]);
        }

        // Clear session data
        session()->forget('slambook_data');

        return redirect('/');
    }
}
