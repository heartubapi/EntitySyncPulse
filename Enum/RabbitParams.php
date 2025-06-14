<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <rballesteros.widook@distelsa.com.gt>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Enum;

enum RabbitParams: string
{
    case EVENT_NAME = 'eventName';
    case EVENT_TYPE = 'eventType';
    case EVENT_VERSION = 'eventVersion';
    case EVENT_REFERENCE = 'eventReference';
    case EVENT_SOURCE = 'eventSource';
    case SOURCE_EVENT_TIME = 'sourceEventTime';
    case INFORMATION = 'information';
    case ECOMMERCE_PRODUCT_CREATED = 'heartub.product.created';
    case ECOMMERCE_PRODUCT_MODIFIED = 'heartub.product.modified';
    case EVENT_TYPE_PRODUCT = 'product';
    case EVENT_VERSION_SET = '1.0';
    case EVENT_SOURCE_MAGENTO = 'HEARTUB';
    case EVENT_EXCHANGE = 'heartub.events-exchange';
}
