<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ShippingMethod;

/**
 * Create a Physical Check Batch.
 *
 * @see Increase\Services\PhysicalCheckBatchesService::create()
 *
 * @phpstan-import-type MailingAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\MailingAddress
 * @phpstan-import-type ReturnAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams\ReturnAddress
 *
 * @phpstan-type PhysicalCheckBatchCreateParamsShape = array{
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   returnAddress: ReturnAddress|ReturnAddressShape,
 *   shippingMethod?: null|ShippingMethod|value-of<ShippingMethod>,
 * }
 */
final class PhysicalCheckBatchCreateParams implements BaseModel
{
    /** @use SdkModel<PhysicalCheckBatchCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Details for where the parcel will be mailed.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * Details for where the parcel should return if it is unable to be delivered.
     */
    #[Required('return_address')]
    public ReturnAddress $returnAddress;

    /**
     * How to ship the batch.
     *
     * Defaults to `usps_first_class`.
     *
     * @var value-of<ShippingMethod>|null $shippingMethod
     */
    #[Optional('shipping_method', enum: ShippingMethod::class)]
    public ?string $shippingMethod;

    /**
     * `new PhysicalCheckBatchCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCheckBatchCreateParams::with(mailingAddress: ..., returnAddress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCheckBatchCreateParams)
     *   ->withMailingAddress(...)
     *   ->withReturnAddress(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     * @param ShippingMethod|value-of<ShippingMethod>|null $shippingMethod
     */
    public static function with(
        MailingAddress|array $mailingAddress,
        ReturnAddress|array $returnAddress,
        ShippingMethod|string|null $shippingMethod = null,
    ): self {
        $self = new self;

        $self['mailingAddress'] = $mailingAddress;
        $self['returnAddress'] = $returnAddress;

        null !== $shippingMethod && $self['shippingMethod'] = $shippingMethod;

        return $self;
    }

    /**
     * Details for where the parcel will be mailed.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     */
    public function withMailingAddress(
        MailingAddress|array $mailingAddress
    ): self {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * Details for where the parcel should return if it is unable to be delivered.
     *
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     */
    public function withReturnAddress(ReturnAddress|array $returnAddress): self
    {
        $self = clone $this;
        $self['returnAddress'] = $returnAddress;

        return $self;
    }

    /**
     * How to ship the batch.
     *
     * Defaults to `usps_first_class`.
     *
     * @param ShippingMethod|value-of<ShippingMethod> $shippingMethod
     */
    public function withShippingMethod(
        ShippingMethod|string $shippingMethod
    ): self {
        $self = clone $this;
        $self['shippingMethod'] = $shippingMethod;

        return $self;
    }
}
