<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Invalid dispute details. Present if and only if `reason` is `invalid_dispute`.
 *
 * @phpstan-type InvalidDisputeShape = array{
 *   explanation: string|null,
 *   reason: \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute\Reason|value-of<\Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute\Reason>,
 * }
 */
final class InvalidDispute implements BaseModel
{
    /** @use SdkModel<InvalidDisputeShape> */
    use SdkModel;

    /**
     * Explanation for why the dispute is considered invalid by the merchant.
     */
    #[Required]
    public ?string $explanation;

    /**
     * The reason a merchant considers the dispute invalid.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(
        enum: Reason::class,
    )]
    public string $reason;

    /**
     * `new InvalidDispute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvalidDispute::with(explanation: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvalidDispute)->withExplanation(...)->withReason(...)
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
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        ?string $explanation,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Explanation for why the dispute is considered invalid by the merchant.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The reason a merchant considers the dispute invalid.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(
        Reason|string $reason,
    ): self {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
