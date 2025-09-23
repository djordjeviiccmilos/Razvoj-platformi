<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Questions;
use Illuminate\Support\Facades\Storage;

class ImportQuestions extends Command
{
    protected $signature = 'questions:import {file}';

    protected $description = 'Upload pitanja iz CSV-a';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $path = $this->argument('file');

        if(!file_exists($path)) {
            $this->error('File not found');
            return;
        }

        $this->info('File found!');

        $this->info("Ucitavam fajl: $path");

        $file = fopen($path, "r");

        if(!$file) {
            $this->error('Cannot open file');
            return 1;
        }

        $header = fgetcsv($file);

        $counter = 0;

        while(($row = fgetcsv($file)) !== false) {
            if(count($row) < count($header)) {
                $row = array_pad($row, count($header), null);
            }

            $data = array_combine($header, $row);

            $options = [
                $data['a'] ?? null,
                $data['b'] ?? null,
                $data['c'] ?? null,
                $data['d'] ?? null,
                $data['e'] ?? null,
            ];

            $options = array_filter($options, fn($opt) => !is_null($opt) && $opt !== '');

            $correctAns = strtolower($data['tacan_odgovor']);
            $correctAnswer = $data[$correctAns] ?? null;

            Questions::create([
                'type' => 'multipleChoice',
                'questionText' => $data['pitanje'],
                'options' => array_values($options),
                'correctAnswer' => $correctAnswer,
                'user_id' => 1,
                'banned' => false,
            ]);

            $counter++;
        }

        $this->info("Ukupno ubaceno pitanja: $counter");

        fclose($file);
    }
}
