<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundMailItems\InboundMailItem;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundMailItemsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundMailItemsService implements InboundMailItemsContract
{
    /**
     * @api
     */
    public InboundMailItemsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundMailItemsRawService($client);
    }

    /**
     * @api
     *
     * Simulates an inbound mail item to your account, as if someone had mailed a physical check to one of your account's Lockboxes.
     *
     * @param int $amount the amount of the check to be simulated, in cents
     * @param string $lockboxID the identifier of the Lockbox to simulate inbound mail to
     * @param string $contentsFileID The file containing the PDF contents. If not present, a default check image file will be used.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $lockboxID,
        ?string $contentsFileID = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundMailItem {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'lockboxID' => $lockboxID,
                'contentsFileID' => $contentsFileID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
