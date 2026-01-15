<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundMailItems\InboundMailItem;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundMailItemsContract
{
    /**
     * @api
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
    ): InboundMailItem;
}
