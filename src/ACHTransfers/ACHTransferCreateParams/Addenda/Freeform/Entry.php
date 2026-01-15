<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Freeform;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntryShape = array{paymentRelatedInformation: string}
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    /**
     * The payment related information passed in the addendum.
     */
    #[Required('payment_related_information')]
    public string $paymentRelatedInformation;

    /**
     * `new Entry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entry::with(paymentRelatedInformation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entry)->withPaymentRelatedInformation(...)
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
     */
    public static function with(string $paymentRelatedInformation): self
    {
        $self = new self;

        $self['paymentRelatedInformation'] = $paymentRelatedInformation;

        return $self;
    }

    /**
     * The payment related information passed in the addendum.
     */
    public function withPaymentRelatedInformation(
        string $paymentRelatedInformation
    ): self {
        $self = clone $this;
        $self['paymentRelatedInformation'] = $paymentRelatedInformation;

        return $self;
    }
}
