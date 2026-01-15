<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\Returned\ReturnMethod;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Returned. Required if and only if `return_outcome` is `returned`.
 *
 * @phpstan-type ReturnedShape = array{
 *   returnMethod: ReturnMethod|value-of<ReturnMethod>,
 *   returnedAt: string,
 *   merchantReceivedReturnAt?: string|null,
 *   otherExplanation?: string|null,
 *   trackingNumber?: string|null,
 * }
 */
final class Returned implements BaseModel
{
    /** @use SdkModel<ReturnedShape> */
    use SdkModel;

    /**
     * Return method.
     *
     * @var value-of<ReturnMethod> $returnMethod
     */
    #[Required('return_method', enum: ReturnMethod::class)]
    public string $returnMethod;

    /**
     * Returned at.
     */
    #[Required('returned_at')]
    public string $returnedAt;

    /**
     * Merchant received return at.
     */
    #[Optional('merchant_received_return_at')]
    public ?string $merchantReceivedReturnAt;

    /**
     * Other explanation. Required if and only if the return method is `other`.
     */
    #[Optional('other_explanation')]
    public ?string $otherExplanation;

    /**
     * Tracking number.
     */
    #[Optional('tracking_number')]
    public ?string $trackingNumber;

    /**
     * `new Returned()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Returned::with(returnMethod: ..., returnedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Returned)->withReturnMethod(...)->withReturnedAt(...)
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
     * @param ReturnMethod|value-of<ReturnMethod> $returnMethod
     */
    public static function with(
        ReturnMethod|string $returnMethod,
        string $returnedAt,
        ?string $merchantReceivedReturnAt = null,
        ?string $otherExplanation = null,
        ?string $trackingNumber = null,
    ): self {
        $self = new self;

        $self['returnMethod'] = $returnMethod;
        $self['returnedAt'] = $returnedAt;

        null !== $merchantReceivedReturnAt && $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;
        null !== $otherExplanation && $self['otherExplanation'] = $otherExplanation;
        null !== $trackingNumber && $self['trackingNumber'] = $trackingNumber;

        return $self;
    }

    /**
     * Return method.
     *
     * @param ReturnMethod|value-of<ReturnMethod> $returnMethod
     */
    public function withReturnMethod(ReturnMethod|string $returnMethod): self
    {
        $self = clone $this;
        $self['returnMethod'] = $returnMethod;

        return $self;
    }

    /**
     * Returned at.
     */
    public function withReturnedAt(string $returnedAt): self
    {
        $self = clone $this;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }

    /**
     * Merchant received return at.
     */
    public function withMerchantReceivedReturnAt(
        string $merchantReceivedReturnAt
    ): self {
        $self = clone $this;
        $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;

        return $self;
    }

    /**
     * Other explanation. Required if and only if the return method is `other`.
     */
    public function withOtherExplanation(string $otherExplanation): self
    {
        $self = clone $this;
        $self['otherExplanation'] = $otherExplanation;

        return $self;
    }

    /**
     * Tracking number.
     */
    public function withTrackingNumber(string $trackingNumber): self
    {
        $self = clone $this;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }
}
