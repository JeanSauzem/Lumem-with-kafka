<?php 

namespace App\Traits;

use Exception;

trait ConnectKafkaProducerTrait
{
    protected $producer, $topic;

    public function getConnectionProducer() 
    {
        $conf = new \RdKafka\Conf();
        $conf->set('metadata.broker.list', env('KAFKA_URL'));
        $this->producer = new \RdKafka\Producer($conf);
 
        return $this;
    }

    public function setTopicProducer($topic = "test")
    {
        $this->topic = $this->producer->newTopic($topic);

        if (!$this->producer->getMetadata(false, $this->topic, 2000)) {
            throw new Exception('Falha ao adicionar o Brokers', 500);
        }

        return $this;
    }

    public function produce($params)
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, $params);
        $this->producer->flush(5000);
        return $this;
    }
}