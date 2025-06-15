<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Heartub\EntitySyncPulse\Enum\ConfigValuesEnum;

class SyncPulseConfig extends Config
{

    /**
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     * @param string|null $groupCode
     * @param string|null $pathPattern
     * @param int|null $storeId
     */
    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        private readonly ScopeConfigInterface $scopeConfig,
        private ?string $groupCode = null,
        private ?string $pathPattern = null,
        private ?int $storeId = null
    ) {
        parent::__construct($scopeConfig, $groupCode, $pathPattern);
    }

    /**
     * Method to retrieve the store ID when the parameter is empty
     *
     * @param int|null $storeId
     * @return int
     * @throws NoSuchEntityException
     */
    public function getStoreIdOnEmpty(?int $storeId): int
    {
        if (empty($storeId)) {
            $storeId = $this->storeManager->getStore()?->getId() ?? 0;
            $this->setStoreId((int)$storeId);
        }

        return (int)$storeId;
    }

    /**
     * Method to Retrieve the required field value
     *
     * @param string|null $field
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getConfigValueByField(?string $field, ?int $storeId = null): ?string
    {
        $customStoreId = $this->getStoreIdOnEmpty($storeId);
        $this->setGroupCode(ConfigValuesEnum::MAIN_GROUP_ID->value);
        return $this->getValue($field, $customStoreId);
    }

    /**
     * Method to get the enabled value by store
     *
     * @param int|null $storeId
     * @return bool|null
     * @throws NoSuchEntityException
     */
    public function isEnabled(?int $storeId = null): ?bool
    {
        return (bool)$this->getConfigValueByField(ConfigValuesEnum::ENABLE->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq host value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getHost(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::HOST->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq port value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getPort(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::PORT->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq user value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getUser(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::USER->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq password value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getPassword(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::PASSWORD->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq exchange name value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getExchangeName(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::EXCHANGE_NAME->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq router key value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getRouterKey(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::ROUTER_KEY->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq schedule value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getSchedule(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::SCHEDULE->value, $storeId);
    }

    /**
     * Method to Retrieve the rabbitmq vhost value
     *
     * @param int|null $storeId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getVhost(?int $storeId = null): ?string
    {
        return $this->getConfigValueByField(ConfigValuesEnum::VHOST->value, $storeId) ?? '/';
    }

    /**
     * Method to Retrieve the rabbitmq connection config
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getRabbitMqConnection(): array
    {
        return [
            ConfigValuesEnum::HOST->value => $this->getHost(),
            ConfigValuesEnum::PORT->value => $this->getPort(),
            ConfigValuesEnum::USER->value => $this->getUser(),
            ConfigValuesEnum::PASSWORD->value => $this->getPassword(),
            ConfigValuesEnum::VHOST->value => $this->getVhost()
        ];
    }

    /**
     * Method to get the store ID
     *
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * Method to set the store ID
     *
     * @param int|null $storeId
     * @return $this
     */
    public function setStoreId(?int $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }
}
