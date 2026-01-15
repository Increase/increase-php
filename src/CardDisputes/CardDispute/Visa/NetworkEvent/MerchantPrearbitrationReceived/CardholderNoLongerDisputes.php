<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cardholder no longer disputes details. Present if and only if `reason` is `cardholder_no_longer_disputes`.
 *
 * @phpstan-type CardholderNoLongerDisputesShape = array{explanation: string|null}
 */
final class CardholderNoLongerDisputes implements BaseModel
{
    /** @use SdkModel<CardholderNoLongerDisputesShape> */
    use SdkModel;

    /**
     * Explanation for why the merchant believes the cardholder no longer disputes the transaction.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new CardholderNoLongerDisputes()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderNoLongerDisputes::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderNoLongerDisputes)->withExplanation(...)
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
     * Explanation for why the merchant believes the cardholder no longer disputes the transaction.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
