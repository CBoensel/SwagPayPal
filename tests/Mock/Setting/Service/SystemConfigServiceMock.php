<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPal\Test\Mock\Setting\Service;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Swag\PayPal\Setting\Settings;

/**
 * @internal
 */
#[Package('checkout')]
class SystemConfigServiceMock extends SystemConfigService
{
    /**
     * @var mixed[][]
     */
    private array $data;

    public function __construct()
    {
        $this->data = ['' => Settings::DEFAULT_VALUES];
    }

    /**
     * @return array|bool|float|int|string|null
     */
    public function get(string $key, ?string $salesChannelId = null, bool $inherit = true)
    {
        $salesChannelId = (string) $salesChannelId;
        if (isset($this->data[$salesChannelId][$key])) {
            return $this->data[$salesChannelId][$key];
        }

        if (isset($this->data[''][$key])) {
            return $this->data[''][$key];
        }

        return null;
    }

    public function getDomain(string $domain, ?string $salesChannelId = null, bool $inherit = false): array
    {
        $values = [];

        if ($inherit && $salesChannelId !== null) {
            foreach ($this->data[''] as $key => $value) {
                if (\mb_strpos($key, $domain) === 0) {
                    $values[$key] = $value;
                }
            }
        }
        $salesChannelId = (string) $salesChannelId;
        if (!isset($this->data[$salesChannelId])) {
            return $values;
        }

        foreach ($this->data[$salesChannelId] as $key => $value) {
            if (\mb_strpos($key, $domain) === 0) {
                $values[$key] = $value;
            }
        }

        return $values;
    }

    /**
     * @param int|float|string|bool|array|object|null $value
     */
    public function set(string $key, $value, ?string $salesChannelId = null): void
    {
        $salesChannelId = (string) $salesChannelId;
        if (!isset($this->data[$salesChannelId])) {
            $this->data[$salesChannelId] = [];
        }
        $this->data[$salesChannelId][$key] = $value;
    }

    public function delete(string $key, ?string $salesChannel = null): void
    {
        $this->set($key, null, $salesChannel);
    }
}
