<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\Returned\ReturnMethod;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Returned. Present if and only if `return_outcome` is `returned`.
 *
 * @phpstan-type ReturnedShape = array{
 *   merchantReceivedReturnAt: string|null,
 *   otherExplanation: string|null,
 *   returnMethod: ReturnMethod|value-of<ReturnMethod>,
 *   returnedAt: string,
 *   trackingNumber: string|null,
 * }
 */
final class Returned implements BaseModel
{
    /** @use SdkModel<ReturnedShape> */
    use SdkModel;

    /**
     * Merchant received return at.
     */
    #[Required('merchant_received_return_at')]
    public ?string $merchantReceivedReturnAt;

    /**
     * Other explanation. Required if and only if the return method is `other`.
     */
    #[Required('other_explanation')]
    public ?string $otherExplanation;

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
     * Tracking number.
     */
    #[Required('tracking_number')]
    public ?string $trackingNumber;

    /**
     * `new Returned()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Returned::with(
     *   merchantReceivedReturnAt: ...,
     *   otherExplanation: ...,
     *   returnMethod: ...,
     *   returnedAt: ...,
     *   trackingNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Returned)
     *   ->withMerchantReceivedReturnAt(...)
     *   ->withOtherExplanation(...)
     *   ->withReturnMethod(...)
     *   ->withReturnedAt(...)
     *   ->withTrackingNumber(...)
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
        ?string $merchantReceivedReturnAt,
        ?string $otherExplanation,
        ReturnMethod|string $returnMethod,
        string $returnedAt,
        ?string $trackingNumber,
    ): self {
        $self = new self;

        $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;
        $self['otherExplanation'] = $otherExplanation;
        $self['returnMethod'] = $returnMethod;
        $self['returnedAt'] = $returnedAt;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }

    /**
     * Merchant received return at.
     */
    public function withMerchantReceivedReturnAt(
        ?string $merchantReceivedReturnAt
    ): self {
        $self = clone $this;
        $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;

        return $self;
    }

    /**
     * Other explanation. Required if and only if the return method is `other`.
     */
    public function withOtherExplanation(?string $otherExplanation): self
    {
        $self = clone $this;
        $self['otherExplanation'] = $otherExplanation;

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
     * Tracking number.
     */
    public function withTrackingNumber(?string $trackingNumber): self
    {
        $self = clone $this;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }
}
