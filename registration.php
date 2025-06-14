<?php
/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Heartub_EntitySyncPulse',
    __DIR__
);
