<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RealTimeDecisions\RealTimeDecision;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RealTimeDecisionsRawContract
{
    /**
     * @api
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimeDecision>
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimeDecisionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param array<string,mixed>|RealTimeDecisionActionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimeDecision>
     *
     * @throws APIException
     */
    public function action(
        string $realTimeDecisionID,
        array|RealTimeDecisionActionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
