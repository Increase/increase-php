<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardDisputes\CardDispute;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardDisputes\CardDisputeActionParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardDisputesRawContract
{
    /**
     * @api
     *
     * @param string $cardDisputeID the dispute you would like to action
     * @param array<string,mixed>|CardDisputeActionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function action(
        string $cardDisputeID,
        array|CardDisputeActionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
