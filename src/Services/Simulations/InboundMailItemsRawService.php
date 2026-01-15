<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundMailItems\InboundMailItem;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundMailItemsRawContract;
use Increase\Simulations\InboundMailItems\InboundMailItemCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundMailItemsRawService implements InboundMailItemsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates an inbound mail item to your account, as if someone had mailed a physical check to one of your account's Lockboxes.
     *
     * @param array{
     *   amount: int, lockboxID: string, contentsFileID?: string
     * }|InboundMailItemCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundMailItem>
     *
     * @throws APIException
     */
    public function create(
        array|InboundMailItemCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundMailItemCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_mail_items',
            body: (object) $parsed,
            options: $options,
            convert: InboundMailItem::class,
        );
    }
}
