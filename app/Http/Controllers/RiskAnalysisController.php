<?php

namespace App\Http\Controllers;

use App\Models\question;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;
use Spatie\Ignition\Solutions\OpenAi\OpenAiSolution;

class RiskAnalysisController extends Controller
{
    //
    public function show(Request $request)
    {
        $question = question::where('id',$request->id)->first();
        $prompt = 'Answer the follwing Question,' . $question->questions; 
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 0.7,
            'max_tokens' => 200,
        ]);
        $answer = OpenAi::embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => [
                trim($result['choices'][0]['text']),
            ]
        ]);
        $prompt = OpenAi::embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => [
                $request->prompt,
            ]
        ]);
        $similarity = $this->cosineSimilarity($answer->embeddings[0]->embedding,$prompt->embeddings[0]->embedding);
        if($similarity >= 0.9)
        {
            return 'Good To Go!';  
            
        }
        else
        {
            return 'The Suggestion to improve your answer is ' .  trim($result['choices'][0]['text']);
        }
    }
    public function cosineSimilarity($u, $v)
    {
        $dotProduct = 0;
        $uLength = 0;
        $vLength = 0;
        for ($i = 0; $i < count($u); $i++) {
            $dotProduct += $u[$i] * $v[$i];
            $uLength += $u[$i] * $u[$i];
            $vLength += $v[$i] * $v[$i];
        }
        $uLength = sqrt($uLength);
        $vLength = sqrt($vLength);
        return $dotProduct / ($uLength * $vLength);
    }

}
