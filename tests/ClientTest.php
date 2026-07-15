<?php

namespace Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use Increase\Core\Exceptions\APIConnectionException;
use Increase\Core\Util;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ClientTest extends TestCase
{
    public function testDefaultHeaders(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;

        $transporter->setDefaultResponse($mockRsp);

        $client = new \Increase\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->accounts->create(name: 'New Account!');

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);

        foreach (['accept', 'content-type'] as $header) {
            $sent = $requested->getHeaderLine($header);
            $this->assertNotEmpty($sent);
        }
    }

    public function testRedirectMalformedLocationThrows(): void
    {
        $transporter = new Client;
        $transporter->addResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(307)
                ->withHeader('Location', 'https://example.com:invalid-port/redirected')
        );

        $client = new \Increase\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $this->expectException(APIConnectionException::class);

        $client->accounts->create(name: 'New Account!');
    }

    public function testRedirectStripsAuthorizationCrossOrigin(): void
    {
        $transporter = new Client;
        $transporter->addResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(307)
                ->withHeader('Location', 'https://example.com/redirected?token=a%2Fb%2Bc%3D%3D#section')
        );
        $transporter->setDefaultResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(200)
                ->withHeader('Content-Type', 'application/json')
                ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        );

        $client = new \Increase\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->accounts->create(
            name: 'New Account!',
            requestOptions: ['extraQueryParams' => ['leaked' => 'secret']],
        );

        $requests = $transporter->getRequests();
        $this->assertGreaterThanOrEqual(2, count($requests));
        $redirected = $requests[1];

        $this->assertEmpty($redirected->getHeaderLine('Authorization'));
        $this->assertSame('token=a%2Fb%2Bc%3D%3D', $redirected->getUri()->getQuery());
        $this->assertSame('section', $redirected->getUri()->getFragment());
    }

    public function testRedirectKeepsAuthorizationSameOrigin(): void
    {
        $transporter = new Client;
        $transporter->addResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(307)
                ->withHeader('Location', '/redirected')
        );
        $transporter->setDefaultResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(200)
                ->withHeader('Content-Type', 'application/json')
                ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        );

        $client = new \Increase\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->accounts->create(name: 'New Account!');

        $requests = $transporter->getRequests();
        $this->assertGreaterThanOrEqual(2, count($requests));
        $redirected = $requests[1];

        $this->assertNotEmpty($redirected->getHeaderLine('Authorization'));
    }
}
