<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;

class TeacherQuestionController extends Controller
{
    public function index() {
        $questions = Questions::where('banned', false)->paginate(15);
        return view('teacher.questions.index', compact('questions'));
    }

    public function create() {
        return view('teacher.questions.create');
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'questionText' => 'required',
            'type' => 'required|in:multipleChoice,open',
            'options' => 'nullable|array',
            'correctAnswer' => 'nullable|string',
        ]);

        if ($validated['type'] === 'multipleChoice') {
            if (!in_array($validated['correctAnswer'], $validated['options'] ?? [])) {
                return back()
                    ->withErrors(['correctAnswer' => 'Tačan odgovor mora biti jedna od ponuđenih opcija.'])
                    ->withInput();
            }
        }

        $options = $validated['options'] ?? [];
        if(count($options) !== count(array_unique($options))) {
            return back()->withErrors(['options' => 'Više puta se javlja isti ponudjeni odgovor.'])->withInput();
        }

        $question = new Questions();
        $question->user_id = auth()->id();
        $question->type = $validated['type'];
        $question->questionText = $validated['questionText'];

        if($validated['type'] === 'multipleChoice') {
            $question->options = $validated['options'];
            $question->correctAnswer = $validated['correctAnswer'];
        } else {
            $question->options = null;
            $question->correctAnswer = null;
        }
        $question->banned = false;

        $question->save();

        return redirect()->route('teacher.questions.index')->with('success', 'Pitanje je uspešno kreirano!');
    }

    public function edit(Questions $question) {
        if($question->user_id !== auth()->id()) {
            abort(403, 'Neamte pravo da uredjujete tudja pitanja!');
        }

        return view('teacher.questions.edit', compact('question'));
    }

    public function update(Request $request, Questions $question) {
        if($question->user_id !== auth()->id()) {
            abort(403, 'Nemate pravo da uredjujete tudja pitanja!');
        }

        $validated = $request->validate([
            'questionText' => 'required',
            'type' => 'required|in:multipleChoice,open',
            'options' => 'nullable|array',
            'correctAnswer' => 'nullable|string',
        ]);

        if ($validated['type'] === 'multipleChoice') {
            if (!in_array($validated['correctAnswer'], $validated['options'] ?? [])) {
                return back()
                    ->withErrors(['correctAnswer' => 'Tačan odgovor mora biti jedna od ponuđenih opcija.'])
                    ->withInput();
            }
        }

        $options = $validated['options'] ?? [];
        if(count($options) !== count(array_unique($options))) {
            return back()->withErrors(['options' => 'Više puta se javlja isti ponudjeni odgovor.'])->withInput();
        }

        $question->type = $validated['type'];
        $question->questionText = $validated['questionText'];
        if($validated['type'] === 'multipleChoice') {
            $question->options = $validated['options'];
            $question->correctAnswer = $validated['correctAnswer'];
        } else {
            $question->options = null;
            $question->correctAnswer = null;
        }
        $question->banned = false;
        $question->save();

        return redirect()->route('teacher.questions.index')->with('success', 'Pitanje je uspešno izmenjeno!');
    }
}
