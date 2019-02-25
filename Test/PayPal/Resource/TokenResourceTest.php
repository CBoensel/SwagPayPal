<?php declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPayPal\Test\PayPal\Resource;

use DateTime;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use SwagPayPal\PayPal\Api\OAuthCredentials;
use SwagPayPal\PayPal\Api\Token;
use SwagPayPal\PayPal\Resource\TokenResource;
use SwagPayPal\Test\Mock\CacheItemWithTokenMock;
use SwagPayPal\Test\Mock\CacheMock;
use SwagPayPal\Test\Mock\PayPal\Client\TokenClientFactoryMock;
use SwagPayPal\Test\Mock\PayPal\Client\TokenClientMock;

class TokenResourceTest extends TestCase
{
    public const SALES_CHANNEL_ID_WITH_TOKEN = 'salesChannelIdWithToken';

    public function testGetToken(): void
    {
        $tokenResource = $this->getTokenResource();

        $context = Context::createDefaultContext();
        $token = $tokenResource->getToken(new OAuthCredentials(), $context, 'url');

        $dateNow = new DateTime('now');

        static::assertInstanceOf(Token::class, $token);
        static::assertSame(TokenClientMock::ACCESS_TOKEN, $token->getAccessToken());
        static::assertSame(TokenClientMock::TOKEN_TYPE, $token->getTokenType());
        static::assertInstanceOf(DateTime::class, $token->getExpireDateTime());
        static::assertTrue($dateNow < $token->getExpireDateTime());
    }

    public function testTestApiCredentials(): void
    {
        $result = $this->getTokenResource()->testApiCredentials(new OAuthCredentials(), 'url');

        static::assertTrue($result);
    }

    public function testGetTokenFromCache(): void
    {
        $tokenResource = $this->getTokenResource();

        $context = Context::createDefaultContext();
        $context->getSourceContext()->setSalesChannelId(self::SALES_CHANNEL_ID_WITH_TOKEN);
        $token = $tokenResource->getToken(new OAuthCredentials(), $context, 'url');

        static::assertInstanceOf(Token::class, $token);
        static::assertSame(CacheItemWithTokenMock::ACCESS_TOKEN, $token->getAccessToken());
        static::assertSame(TokenClientMock::TOKEN_TYPE, $token->getTokenType());
        static::assertInstanceOf(DateTime::class, $token->getExpireDateTime());
    }

    private function getTokenResource(): TokenResource
    {
        return new TokenResource(new CacheMock(), new TokenClientFactoryMock());
    }
}
