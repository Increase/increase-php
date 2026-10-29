<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\WireDrawdownRequests\WireDrawdownRequestRefuseParams\RefusalReasonCode;
use Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireDrawdownRequestsContract
{
    /**
     * @api
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to refuse
     * @param string $refusalReasonAdditionalInformation additional information about the refusal that the simulated refusal will have
     * @param RefusalReasonCode|value-of<RefusalReasonCode> $refusalReasonCode The reason code that the simulated refusal will have.
     *
     * Defaults to `other`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function refuse(
        string $wireDrawdownRequestID,
        ?string $refusalReasonAdditionalInformation = null,
        RefusalReasonCode|string $refusalReasonCode = 'other',
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest;

    /**
     * @api
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest;
}
