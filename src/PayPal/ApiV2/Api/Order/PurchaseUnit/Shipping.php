<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPal\PayPal\ApiV2\Api\Order\PurchaseUnit;

use Swag\PayPal\PayPal\ApiV2\Api\Order\PurchaseUnit\Shipping\Address;
use Swag\PayPal\PayPal\ApiV2\Api\Order\PurchaseUnit\Shipping\Name;
use Swag\PayPal\PayPal\PayPalApiStruct;

class Shipping extends PayPalApiStruct
{
    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Address
     */
    protected $address;

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
}
