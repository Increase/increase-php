<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\PhysicalCards\PhysicalCard;
use Increase\PhysicalCards\PhysicalCardCreateParams;
use Increase\PhysicalCards\PhysicalCardListParams;
use Increase\PhysicalCards\PhysicalCardUpdateParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCardsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PhysicalCardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardID the identifier of the Physical Card
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardID the Physical Card identifier
     * @param array<string,mixed>|PhysicalCardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function update(
        string $physicalCardID,
        array|PhysicalCardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PhysicalCardListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PhysicalCard>>
     *
     * @throws APIException
     */
    public function list(
        array|PhysicalCardListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
