<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardValidations\CardValidation;
use Increase\CardValidations\CardValidationCreateParams;
use Increase\CardValidations\CardValidationListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardValidationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardValidationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardValidation>
     *
     * @throws APIException
     */
    public function create(
        array|CardValidationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardValidationID the identifier of the Card Validation
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardValidation>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardValidationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardValidationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardValidation>>
     *
     * @throws APIException
     */
    public function list(
        array|CardValidationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
