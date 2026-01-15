<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\ExternalAccounts\ExternalAccount;
use Increase\ExternalAccounts\ExternalAccountCreateParams;
use Increase\ExternalAccounts\ExternalAccountListParams;
use Increase\ExternalAccounts\ExternalAccountUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ExternalAccountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExternalAccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function create(
        array|ExternalAccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $externalAccountID the identifier of the External Account
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalAccountID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $externalAccountID the external account identifier
     * @param array<string,mixed>|ExternalAccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function update(
        string $externalAccountID,
        array|ExternalAccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExternalAccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ExternalAccount>>
     *
     * @throws APIException
     */
    public function list(
        array|ExternalAccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
