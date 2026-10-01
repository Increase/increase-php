<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ShippingMethod;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCheckBatchesContract;

/**
 * @phpstan-import-type MailingAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress
 * @phpstan-import-type ReturnAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCheckBatchesService implements PhysicalCheckBatchesContract
{
    /**
     * @api
     */
    public PhysicalCheckBatchesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PhysicalCheckBatchesRawService($client);
    }

    /**
     * @api
     *
     * Create a Physical Check Batch
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
    ): PhysicalCheckBatch {
        $params = Util::removeNulls(
            [
                'mailingAddress' => $mailingAddress,
                'returnAddress' => $returnAddress,
                'shippingMethod' => $shippingMethod,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending Physical Check Batch, which cancels all of its related checks.
     *
     * @param string $physicalCheckBatchID the identifier of the pending Physical Check Batch to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCheckBatch {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($physicalCheckBatchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Completing a Physical Check Batch closes it to new Physical Checks and begins the process of printing and mailing it.
     *
     * @param string $physicalCheckBatchID the identifier of the Physical Check Batch to complete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCheckBatch {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->complete($physicalCheckBatchID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
