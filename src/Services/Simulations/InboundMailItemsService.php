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
     * Simulates an Inbound Mail Item to one of your Lockbox Addresses or Lockbox Recipients, as if someone had mailed a physical check.
     *
     * @param int $amount the amount of the check to be simulated, in cents
     * @param string $contentsFileID The file containing the PDF contents. If not present, a default check image file will be used.
     * @param string $lockboxAddressID the identifier of the Lockbox Address to simulate inbound mail to
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient to simulate inbound mail to
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        ?string $contentsFileID = null,
        ?string $lockboxAddressID = null,
        ?string $lockboxRecipientID = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundMailItem {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'contentsFileID' => $contentsFileID,
                'lockboxAddressID' => $lockboxAddressID,
                'lockboxRecipientID' => $lockboxRecipientID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
