<?php

use App\Console\Commands\ImportQuestions;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('questions:import-mc {file}', function () {
    $file = $this->argument('file');
    $this->call(ImportQuestions::class, ['file' => $file]);
})->describe('Importuje multiple choice pitanja iz CSV fajla');
