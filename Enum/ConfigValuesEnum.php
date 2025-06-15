<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Enum;

enum ConfigValuesEnum: string
{
    case DEFAULT_PATH_PATTERN = 'heartub_rabbitmq_settings/%s/%s';
    case MAIN_GROUP_ID = 'connection';
    case ENABLE = 'enable';
    case HOST = 'host';
    case PORT = 'port';
    case USER = 'user';
    case PASSWORD = 'password';
    case EXCHANGE_NAME = 'exchange_name';
    case ROUTER_KEY = 'router_key';
    case VHOST = 'vhost';
    case SCHEDULE = 'schedule';
}
