<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param string|null $groupCode
     * @param string|null $pathPattern
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private ?string $groupCode = null,
        private ?string $pathPattern = null
    ) {
    }

    /**
     * Retrieve information from custom configuration
     *
     * @param string|null $field
     * @param int|null $storeId
     *
     * @return mixed
     */
    public function getValue(?string $field, ?int $storeId = null): mixed
    {
        if ($this->groupCode === null || $this->pathPattern === null) {
            return null;
        }

        return $this->scopeConfig->getValue(
            sprintf($this->pathPattern, $this->groupCode, $field),
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Sets group code
     *
     * @param string|null $groupCode
     * @return void
     */
    public function setGroupCode(?string $groupCode): void
    {
        $this->groupCode = $groupCode;
    }

    /**
     * Sets path pattern
     *
     * @param string|null $pathPattern
     * @return void
     */
    public function setPathPattern(?string $pathPattern): void
    {
        $this->pathPattern = $pathPattern;
    }
}
