<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ShippingMethod;
use Increase\RequestOptions;

/**
 * @phpstan-import-type MailingAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress
 * @phpstan-import-type ReturnAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCheckBatchesContract
{
    /**
     * @api
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress details for where the parcel will be mailed
     * @param ReturnAddress|ReturnAddressShape $returnAddress details for where the parcel should return if it is unable to be delivered
     * @param ShippingMethod|value-of<ShippingMethod> $shippingMethod How to ship the batch.
     *
     * Defaults to `usps_first_class`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MailingAddress|array $mailingAddress,
        ReturnAddress|array $returnAddress,
        ShippingMethod|string $shippingMethod = 'usps_first_class',
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCheckBatch;

    /**
     * @api
     *
     * @param string $physicalCheckBatchID the identifier of the pending Physical Check Batch to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCheckBatch;

    /**
     * @api
     *
     * @param string $physicalCheckBatchID the identifier of the Physical Check Batch to complete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCheckBatch;
}
