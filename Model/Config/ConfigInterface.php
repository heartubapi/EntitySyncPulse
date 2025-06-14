<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <rballesteros.widook@distelsa.com.gt>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Model\Config;

interface ConfigInterface
{
    /**
     * Retrieve information from admin configuration
     *
     * @param string|null $field
     * @param int|null $storeId
     *
     * @return mixed
     */
    public function getValue(?string $field, ?int $storeId = null): mixed;

    /**
     * Sets group code
     *
     * @param string|null $groupCode
     * @return void
     */
    public function setGroupCode(?string $groupCode): void;

    /**
     * Sets path pattern
     *
     * @param string|null $pathPattern
     * @return void
     */
    public function setPathPattern(?string $pathPattern): void;
}
