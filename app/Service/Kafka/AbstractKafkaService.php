<?php

namespace App\Service\Kafka;

use App\Traits\ConnectKafkaConsumerTrait;
use App\Traits\ConnectKafkaProducerTrait;

abstract class AbstractKafkaService
{
    use ConnectKafkaConsumerTrait, ConnectKafkaProducerTrait;
}
