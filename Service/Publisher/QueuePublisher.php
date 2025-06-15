<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Service\Publisher;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Heartub\EntitySyncPulse\Helper\SyncPulseLogger as Logger;

class QueuePublisher
{

    /**
     * @param PublisherInterface $publisher
     * @param JsonSerializer|null $serializer
     * @param Logger $logger
     */
    public function __construct(
        private readonly PublisherInterface $publisher,
        private readonly ?JsonSerializer $serializer,
        private readonly Logger $logger
    ) {
    }

    /**
     * Method for publishing messages
     *
     * @param string|null $topic
     * @param mixed $data
     * @return void
     */
    public function publish(?string $topic, mixed $data): void
    {
        try {
            $this->publisher->publish($topic, $this->serializer->serialize($data));
        } catch (\Exception $e) {
            $this->logger->log($e->getMessage(), Logger::ERROR, $data ?? []);
        }
    }
}
