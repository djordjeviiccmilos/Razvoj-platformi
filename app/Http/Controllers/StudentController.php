<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use OpenAI;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\TestResults;

class StudentController extends Controller
{
    public function start() {
        Session::put('test_in_progress', true);

        if(!Session::has('test')) {
            $multipleChoice = Questions::where('type', 'multipleChoice')->where('banned', false)->inRandomOrder()->limit(15)->get()->map(function($item) {
                $options = $item->options;
                shuffle($options);
                $item->shuffled_options = $options;
                return $item;
            });

            $open = Questions::where('type', 'open')->where('banned', false)->inRandomOrder()->limit(3)->get();

            $questions = $multipleChoice->concat($open)->shuffle();

            Session::put('test', $questions);

        } else {
            $questions = Session::get('test');
        }

        return view('student.test.start', compact('questions'));
    }

    public function submit(Request $request) {
        $questions = Session::get('test', []);
        $answers = $request->input('answers', []);

        $score = 0;
        $stats = [];

        foreach($questions as $question) {
            $studentAnswer = $answers[$question->id] ?? null;

            if($question->type === 'multipleChoice') {
                if($studentAnswer === $question->correctAnswer) {
                    $score += 3;
                    $stats[] = [
                        'id' => $question->id,
                        'questionText' => $question->questionText,
                        'studentAnswer' => $studentAnswer,
                        'correctAnswer' => $question->correctAnswer,
                        'type' => $question->type,
                        'points' => 3,
                    ];
                } else {
                    $stats[] = [
                        'id' => $question->id,
                        'questionText' => $question->questionText,
                        'studentAnswer' => $studentAnswer,
                        'correctAnswer' => $question->correctAnswer,
                        'type' => $question->type,
                        'points' => 0,
                    ];
                }

            } else {
                $points = $this->AiEvaluate($question->questionText, $question->correctAnswer, $studentAnswer);
                $score += $points;
                $stats[] = [
                    'id' => $question->id,
                    'questionText' => $question->questionText,
                    'studentAnswer' => $studentAnswer,
                    'type' => $question->type,
                    'points' => $points,
                ];
            }
        }

        TestResults::create([
            'user_id' => auth()->id(),
            'score' => $score,
        ]);

        Session::forget('test');
        Session::forget('test_in_progress');
        Session::put('score', $score);

        return view('student.test.results', compact('stats', 'score'));
    }

    private function AiEvaluate($questionText, $correctAnswer, $studentAnswer) {
        if(!$studentAnswer) {
            return 0;
        }

        $guzzleClient = new GuzzleClient ([
            'verify' => false,
        ]);

        $client = OpenAI::factory()->withApiKey(env('OPENAI_API_KEY'))->withHttpClient($guzzleClient)->make();

        $response = $client->chat()->create([
           'model' => 'gpt-4',
           'messages' => [
               ['role' => 'system', 'content' => 'Student polaže probni prijemni iz informatike. Objektivno oceni ovaj odgovor od 0 do 5.'],
               ['role' => 'user', 'content' => "Pitanje: $questionText \n
                                                Tačan odgovor: $correctAnswer \n
                                                Odgovor studenta: $studentAnswer \n
                                                Koliko poena od 5? Vrati samo broj poena"]


           ]
        ]);

        $points = (int) filter_var($response['choices'][0]['message']['content'], FILTER_SANITIZE_NUMBER_INT);

        return $points;
    }
}
