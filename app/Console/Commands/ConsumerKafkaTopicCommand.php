<?php

namespace App\Console\Commands;

use App\Service\Kafka\ConsumerKafkaService;
use Illuminate\Console\Command;

class ConsumerKafkaTopicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ConsumerTopic {topic}';

    protected $serviceConsumer;

    public function __construct(
        ConsumerKafkaService $serviceConsumer
    ){
        parent::__construct();
        $this->serviceConsumer = $serviceConsumer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->serviceConsumer->consumer($this->argument('topic'));
    }
}