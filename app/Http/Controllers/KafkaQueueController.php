<?php

namespace App\Http\Controllers;

use App\Service\Kafka\ConsumerKafkaService;
use App\Service\Kafka\ProducerKafkaService;
use Illuminate\Http\Request;

class KafkaQueueController extends Controller
{
    protected $serviceProducer;

    public function __construct(
        ProducerKafkaService $serviceProducer
    )
    {
        $this->serviceProducer = $serviceProducer;
    }

    public function producer(Request $request)
    {
        try {
            
            $this->validate($request,[
                'topic' => 'required',
                'payload' => 'required'
            ],
            [
                'topic.required' => 'Obrigatório Informar o topico',
                'payload.required' => 'Obrigatório Informar o payload',
            ]);
            
            $results = $this->serviceProducer->producer($request->input('topic'), $request->input('payload'));

            return response()->json($results, 200);
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

}