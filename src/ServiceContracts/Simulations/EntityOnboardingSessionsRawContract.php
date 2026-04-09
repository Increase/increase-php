<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntityOnboardingSessionsRawContract
{
    /**
     * @api
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function submit(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
