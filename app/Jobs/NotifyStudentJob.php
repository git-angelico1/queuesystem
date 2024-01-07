<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Illuminate\Support\Facades\Log;
use App\Models\Registrar; 

class NotifyStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {

            $registrationNumber = $this->data['reg_generate'];
            $student = Registrar::where('reg_generate', $registrationNumber)->first();

            if ($student) {
                $textToSpeechClient = new TextToSpeechClient();

                $inputText = 'Now serving: ' . $student->reg_generate;
               
                $voice = (new VoiceSelectionParams())
                    ->setLanguageCode('en-US')
                    ->setName('en-US-Wavenet-D');

                
                $audioConfig = (new AudioConfig())
                    ->setAudioEncoding('LINEAR16');

              
                $synthesisInput = (new SynthesisInput())->setText($inputText);
                $response = $textToSpeechClient->synthesizeSpeech($synthesisInput, $voice, $audioConfig);

                
                echo $response->getAudioContent();

                $textToSpeechClient->close();
            } else {
                Log::error('Student not found for registration number: ' . $registrationNumber);
            }
        
        } catch (\Exception $e) {
            Log::error('Text-to-speech error: ' . $e->getMessage());
        }
    }
}

