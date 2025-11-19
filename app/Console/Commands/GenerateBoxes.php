<?php

namespace App\Console\Commands;

use App\Models\Box;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class GenerateBoxes extends Command
{
    protected $signature = 'boxes:generate';
    protected $description = 'Generate boxes and double the count every minute';

    public function handle()
    {
        $currentCount = Box::count();
        
        $this->info("Current box count: " . $currentCount);
        if ($currentCount >= 16) {
            $this->info("Reached 16 boxes! sending email");
            $this->sendCompletionEmail();
            return;
        }

        $colors = ['red', 'yellow', 'green', 'blue', 'pink', 'grey'];
        $boxesToCreate = $currentCount == 0 ? 1 : $currentCount;

        $this->info("Creating {$boxesToCreate} new boxes");

        for ($i = 0; $i < $boxesToCreate; $i++) {
            Box::create([
                'height' => 40,
                'width' => 100,
                'color' => $colors[array_rand($colors)]
            ]);
        }

        $newCount = Box::count();
        $this->info("Created {$boxesToCreate} new boxes. Total: " . $newCount);
    }

    protected function sendCompletionEmail()
    {
        try {

            Mail::raw('Box generation task has been completed, 16 boxes have been created.', function ($message) {
                $message->to('dawood.ahmed@collaborak.com')
                        ->subject('1st Task Done with Umar Farooq');
            });
            
            $this->info('Email sent successfully');
            
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }
    }
}