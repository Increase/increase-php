<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Delayed charge transaction details. Present if and only if `reason` is `delayed_charge_transaction`.
 *
 * @phpstan-type DelayedChargeTransactionShape = array{explanation: string|null}
 */
final class DelayedChargeTransaction implements BaseModel
{
    /** @use SdkModel<DelayedChargeTransactionShape> */
    use SdkModel;

    /**
     * Additional details about the delayed charge transaction.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new DelayedChargeTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DelayedChargeTransaction::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DelayedChargeTransaction)->withExplanation(...)
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
    public static function with(?string $explanation): self
    {
        $self = new self;

        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * Additional details about the delayed charge transaction.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
