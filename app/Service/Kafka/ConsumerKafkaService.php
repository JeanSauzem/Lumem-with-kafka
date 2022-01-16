<?php

namespace App\Service\Kafka;

class ConsumerKafkaService extends AbstractKafkaService
{
    public function consumer($topic)
    {
        return $this->getConnectionConsumer()
                    ->setTopicConsumer($topic)
                    ->consume();
    }
}