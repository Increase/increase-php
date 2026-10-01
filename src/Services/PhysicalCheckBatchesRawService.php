<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ShippingMethod;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCheckBatchesRawContract;

/**
 * @phpstan-import-type MailingAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress
 * @phpstan-import-type ReturnAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCheckBatchesRawService implements PhysicalCheckBatchesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Physical Check Batch
     *
     * @param array{
     *   mailingAddress: MailingAddress|MailingAddressShape,
     *   returnAddress: ReturnAddress|ReturnAddressShape,
     *   shippingMethod?: ShippingMethod|value-of<ShippingMethod>,
     * }|PhysicalCheckBatchCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCheckBatchCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCheckBatchCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'physical_check_batches',
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCheckBatch::class,
        );
    }

    /**
     * @api
     *
     * Cancel a pending Physical Check Batch, which cancels all of its related checks.
     *
     * @param string $physicalCheckBatchID the identifier of the pending Physical Check Batch to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function cancel(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['physical_check_batches/%1$s/cancel', $physicalCheckBatchID],
            options: $requestOptions,
            convert: PhysicalCheckBatch::class,
        );
    }

    /**
     * @api
     *
     * Completing a Physical Check Batch closes it to new Physical Checks and begins the process of printing and mailing it.
     *
     * @param string $physicalCheckBatchID the identifier of the Physical Check Batch to complete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function complete(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['physical_check_batches/%1$s/complete', $physicalCheckBatchID],
            options: $requestOptions,
            convert: PhysicalCheckBatch::class,
        );
    }
}
