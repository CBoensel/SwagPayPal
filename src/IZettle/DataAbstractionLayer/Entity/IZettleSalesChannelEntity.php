<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPal\IZettle\DataAbstractionLayer\Entity;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\SalesChannel\Aggregate\SalesChannelDomain\SalesChannelDomainEntity;

class IZettleSalesChannelEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $salesChannelId;

    /**
     * @var string|null
     */
    protected $productStreamId;

    /**
     * @var string
     */
    protected $salesChannelDomainId;

    /**
     * @var SalesChannelDomainEntity|null
     */
    protected $salesChannelDomain;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var bool
     */
    protected $syncPrices;

    /**
     * @var bool
     */
    protected $replace;

    public function getSalesChannelId(): string
    {
        return $this->salesChannelId;
    }

    public function setSalesChannelId(string $salesChannelId): void
    {
        $this->salesChannelId = $salesChannelId;
    }

    public function getProductStreamId(): ?string
    {
        return $this->productStreamId;
    }

    public function setProductStreamId(?string $productStreamId): void
    {
        $this->productStreamId = $productStreamId;
    }

    public function getSalesChannelDomainId(): string
    {
        return $this->salesChannelDomainId;
    }

    public function setSalesChannelDomainId(string $salesChannelDomainId): void
    {
        $this->salesChannelDomainId = $salesChannelDomainId;
    }

    public function getSalesChannelDomain(): ?SalesChannelDomainEntity
    {
        return $this->salesChannelDomain;
    }

    public function setSalesChannelDomain(SalesChannelDomainEntity $salesChannelDomain): void
    {
        $this->salesChannelDomain = $salesChannelDomain;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function isSyncPrices(): bool
    {
        return $this->syncPrices;
    }

    public function setSyncPrices(bool $syncPrices): void
    {
        $this->syncPrices = $syncPrices;
    }

    public function isReplace(): bool
    {
        return $this->replace;
    }

    public function setReplace(bool $replace): void
    {
        $this->replace = $replace;
    }
}
