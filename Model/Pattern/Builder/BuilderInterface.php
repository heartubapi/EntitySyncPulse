<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Model\Pattern\Builder;

interface BuilderInterface
{
    /**
     * Builds a request body for API consumption
     *
     * @return array
     */
    public function build(): array;
}
