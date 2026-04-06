<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\SingleUse;

use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\SingleUse\SettlementAmount\Comparison;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The settlement amount constraint for this single-use card.
 *
 * @phpstan-type SettlementAmountShape = array{
 *   comparison: Comparison|value-of<Comparison>, value: int
 * }
 */
final class SettlementAmount implements BaseModel
{
    /** @use SdkModel<SettlementAmountShape> */
    use SdkModel;

    /**
     * The operator used to compare the settlement amount.
     *
     * @var value-of<Comparison> $comparison
     */
    #[Required(enum: Comparison::class)]
    public string $comparison;

    /**
     * The settlement amount value.
     */
    #[Required]
    public int $value;

    /**
     * `new SettlementAmount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SettlementAmount::with(comparison: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SettlementAmount)->withComparison(...)->withValue(...)
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
     * @param Comparison|value-of<Comparison> $comparison
     */
    public static function with(Comparison|string $comparison, int $value): self
    {
        $self = new self;

        $self['comparison'] = $comparison;
        $self['value'] = $value;

        return $self;
    }

    /**
     * The operator used to compare the settlement amount.
     *
     * @param Comparison|value-of<Comparison> $comparison
     */
    public function withComparison(Comparison|string $comparison): self
    {
        $self = clone $this;
        $self['comparison'] = $comparison;

        return $self;
    }

    /**
     * The settlement amount value.
     */
    public function withValue(int $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
