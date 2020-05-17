<?php
namespace Laraws\Express\Tests;

use Laraws\Express\Express;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery\Matcher\AnyArgs;
use Laraws\Express\Exceptions\HttpException;
use Laraws\Express\Exceptions\InvalidArgumentException;

class ExpressTest extends TestCase
{
    public function testGetExpressWithInvalidType()
    {
        $w = new Express('mock-key');
        $this->expectExceptionMessage('Invalid type value(base/all): test');
        $this->expectException(\Laraws\Express\Exceptions\InvalidArgumentException::class);

        $a = $w->getExpress('mock-number', 'test');
    }
}