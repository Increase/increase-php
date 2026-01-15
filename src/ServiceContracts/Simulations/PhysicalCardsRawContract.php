<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCards\PhysicalCard;
use Increase\RequestOptions;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCardsRawContract
{
    /**
     * @api
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param array<string,mixed>|PhysicalCardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function create(
        string $physicalCardID,
        array|PhysicalCardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param array<string,mixed>|PhysicalCardAdvanceShipmentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function advanceShipment(
        string $physicalCardID,
        array|PhysicalCardAdvanceShipmentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
