<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Model\Pattern\Builder\Request;

use Magento\Framework\Exception\LocalizedException as Exception;
use Heartub\EntitySyncPulse\Enum\RabbitParams;
use Heartub\EntitySyncPulse\Model\Pattern\Builder\BuilderInterface;
use Heartub\EntitySyncPulse\Service\Publisher\QueuePublisher;

class ProductSyncRequestBuilder implements BuilderInterface
{

    /**
     * @param QueuePublisher $queuePublisher
     * @param int $requestId
     * @param array $params
     */
    public function __construct(
        private readonly QueuePublisher $queuePublisher,
        private int $requestId = -1,
        private array $params = []
    ) {
    }

    /**
     * Method build
     *
     * @return array
     * @throws Exception
     */
    public function build(): array
    {
        if ($this->getRequestId() < 0 && empty($this->params)) {
            throw new Exception(
                __("The request has not enough parameters. Verify and try again.")
            );
        }

        $request = [
            RabbitParams::EVENT_NAME->value => RabbitParams::ECOMMERCE_PRODUCT_CREATED->value,
            RabbitParams::EVENT_TYPE->value => RabbitParams::EVENT_TYPE_PRODUCT->value,
            RabbitParams::EVENT_VERSION->value => RabbitParams::EVENT_VERSION_SET->value,
            RabbitParams::EVENT_REFERENCE->value => $this->params['sku'] ?? '',
            RabbitParams::EVENT_SOURCE->value => RabbitParams::EVENT_SOURCE_MAGENTO->value,
            RabbitParams::SOURCE_EVENT_TIME->value => date('c'),
            RabbitParams::INFORMATION->value => [
                'product_data' => $this->params
            ]
        ];

        return $request;
    }

    /**
     * @return ProductSyncRequestBuilder
     */
    public function setPublish(): self
    {
        if (!empty($this->data)) {
            $this->queuePublisher->publish(RabbitParams::ECOMMERCE_PRODUCT_MODIFIED->value, $this->data);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getRequestId(): int
    {
        return $this->requestId;
    }

    /**
     * @param int $requestId
     * @return ProductSyncRequestBuilder
     */
    public function setRequestId(int $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return ProductSyncRequestBuilder
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }
}
