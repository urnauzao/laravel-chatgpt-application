<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use OpenAI;

class OpenAIController extends Controller
{
    private const MODEL_AI_DEFAUTL = "text-davinci-003";

    public function index(Request $request): View
    {
        $client = OpenAI::client(env('OPEN_AI_KEY'));
        $key = "{self::class}_models";
        if(cache()->has($key)){
            $models = cache()->get($key);
            if(empty($models)){
                throw new Exception("OAIC20 :: Error listing models");
            }
        }else{
            $response = $client->models()->list();
            $array = $response->toArray();
            if(empty($array)){
                throw new Exception("OAIC26 :: Error listing models");
            }
            $models = array_map( 
                fn($m) => [
                    "id" => $m['id'],
                    "value" => $m['id'],
                ],
                $array['data']
            );
            cache()->add($key, $models, now()->endOfDay());
        }   
        $models = collect($models);

        if($request->search){
            $model = $request->get('model', self::MODEL_AI_DEFAUTL);
            if($models->where('id', $model)->first()){
                $key_search = "{$key}_{$model}_{$request->search}";
                if(cache()->has($key_search)){
                    $info = ["Info in cached"];
                    $result = cache()->get($key_search, "Cache is empty");
                }else{
                    $response = $client->completions()->create([
                        'model' => $model,//modelo da ia
                        'prompt' => $request->search,//termo da busca
                        'max_tokens' => 50,//0-4000 máximo de tokens(palavras) a ser retornado
                        'temperature' => 0,//0-1 randomizar respostas
                    ]);
                    $completions = $response->toArray();
                    
                    $info = [
                        'promptTokens' => "Tokens sended: ".$response->usage->promptTokens,
                        'completionTokens' => "Tokens response: ".$response->usage->completionTokens,
                        'totalTokens' => "Tokens total: ".$response->usage->totalTokens, 
                    ];
                    
                    $result = $completions['choices'][0]['text'];
                    cache()->add($key_search, $result, now()->endOfDay());
                }
                
                return view('openai.index', [
                    'models' => $models,
                    'result' => $result,
                    'info' => $info
                ]);
            }
            throw new Exception("OAIC51 :: Error selected model not exists");
        }
        return view('openai.index', ["models" => $models]);
    }
}
