<?php declare(strict_types=1);

namespace Swag\PayPal\PayPal\Resource;

use Swag\PayPal\PayPal\Api\Capture;
use Swag\PayPal\PayPal\Api\DoVoid;
use Swag\PayPal\PayPal\Client\PayPalClientFactory;
use Swag\PayPal\PayPal\RequestUri;
use Swag\PayPal\Setting\Exception\PayPalSettingsInvalidException;

class AuthorizationResource
{
    /**
     * @var PayPalClientFactory
     */
    private $payPalClientFactory;

    public function __construct(PayPalClientFactory $payPalClientFactory)
    {
        $this->payPalClientFactory = $payPalClientFactory;
    }

    /**
     * @throws PayPalSettingsInvalidException
     */
    public function capture(string $authorizationId, Capture $capture, string $salesChannelId): Capture
    {
        $response = $this->payPalClientFactory->createPaymentClient($salesChannelId)->sendPostRequest(
            RequestUri::AUTHORIZATION_RESOURCE . '/' . $authorizationId . '/capture',
            $capture
        );

        $capture->assign($response);

        return $capture;
    }

    /**
     * @throws PayPalSettingsInvalidException
     */
    public function void(string $authorizationId, string $salesChannelId): DoVoid
    {
        $doVoid = new DoVoid();
        $response = $this->payPalClientFactory->createPaymentClient($salesChannelId)->sendPostRequest(
            RequestUri::AUTHORIZATION_RESOURCE . '/' . $authorizationId . '/void',
            $doVoid
        );

        $doVoid->assign($response);

        return $doVoid;
    }
}
