<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\EventSubscriptions\EventSubscription;
use Increase\EventSubscriptions\EventSubscriptionCreateParams;
use Increase\EventSubscriptions\EventSubscriptionListParams;
use Increase\EventSubscriptions\EventSubscriptionUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EventSubscriptionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EventSubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function create(
        array|EventSubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventSubscriptionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param array<string,mixed>|EventSubscriptionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function update(
        string $eventSubscriptionID,
        array|EventSubscriptionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EventSubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EventSubscription>>
     *
     * @throws APIException
     */
    public function list(
        array|EventSubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
