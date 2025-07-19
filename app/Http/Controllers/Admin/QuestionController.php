<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() {
        $questions = Questions::with('user')->paginate(15);

        return view('admin.questions.index', compact('questions'));
    }

    public function ban(Questions $question) {
        $question->banned = !$question->banned;
        $question->save();

        return redirect()->route('admin.questions.index')->with('status', 'Status pitanja ažurirano!');
    }

    public function delete(Questions $question) {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('status', 'Pitanje obrisano!');
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'questionText' => 'required',
            'type' => 'required|in:multipleChoice,open',
            'options' => 'nullable|array',
            'correctAnswer' => 'nullable|string',
        ]);

        $question = new Questions();
        $question->user_id = auth()->id(); // nastavnik koji unosi pitanje
        $question->type = $validated['type'];
        $question->questionText = $validated['questionText'];
        $question->options = $validated['type'] === 'multipleChoice' ? json_encode($validated['options']) : null;
        $question->correctAnswer = $validated['type'] === 'multipleChoice' ? $validated['correctAnswer'] : null;
        $question->banned = false;
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', 'Pitanje uspešno dodato!');;
    }

    public function edit(Questions $question) {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Questions $question): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'questionText' => 'required',
            'type' => 'required|in:multipleChoice,open',
            'options' => 'nullable|array',
            'correctAnswer' => 'nullable|string',
        ]);

        $question->type = $validated['type'];
        $question->questionText = $validated['questionText'];
        $question->options = $validated['type'] === 'multipleChoice' ? json_encode($validated['options']) : null;
        $question->correctAnswer = $validated['type'] === 'multipleChoice' ? $validated['correctAnswer'] : null;
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', 'Pitanje uspešno izmenjeno!');
    }
}
