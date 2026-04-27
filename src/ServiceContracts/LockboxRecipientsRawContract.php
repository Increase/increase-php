<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\LockboxRecipients\LockboxRecipient;
use Increase\LockboxRecipients\LockboxRecipientCreateParams;
use Increase\LockboxRecipients\LockboxRecipientListParams;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxRecipientsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LockboxRecipientCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxRecipientCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxRecipientID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient
     * @param array<string,mixed>|LockboxRecipientUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function update(
        string $lockboxRecipientID,
        array|LockboxRecipientUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LockboxRecipientListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<LockboxRecipient>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxRecipientListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
