<?php 

namespace App\Traits;

use Exception;

trait ConnectKafkaConsumerTrait
{
    protected $consumer;

    public function getConnectionConsumer()
    {
        $conf = new \RdKafka\Conf();
        $conf->set('metadata.broker.list', env('KAFKA_URL'));
        $conf->set('auto.offset.reset', 'earliest');
        $conf->set('group.id', 'group');

        $this->consumer = new \RdKafka\KafkaConsumer($conf);
      
        return $this;
    }

    public function setTopicConsumer($topic)
    {
        $this->consumer->subscribe([$topic]);
        return $this;
    }

    public function consume()
    {
        set_time_limit(300);   

        while (true) {
            $mess = $this->consumer->consume(5000);
            echo $mess->payload;
          
        }        
    }
}