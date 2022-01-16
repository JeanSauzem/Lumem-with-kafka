<?php

namespace App\Service\Kafka;

class ProducerKafkaService extends AbstractKafkaService
{
    public function producer($topic, $payload)
    {
        $message = is_array($payload) ? json_encode($payload) : $payload;
        
        $this->getConnectionProducer()
              ->setTopicProducer($topic)
              ->produce($message);

        return [
            'mensagem' => "Criado a mensagem no topico $topic"
        ];
    }
}