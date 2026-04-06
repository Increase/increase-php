<?php

declare(strict_types=1);

namespace Increase\Cards\Card\AuthorizationControls\Usage;

use Increase\Cards\Card\AuthorizationControls\Usage\SingleUse\SettlementAmount;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls for single-use cards. Required if and only if `category` is `single_use`.
 *
 * @phpstan-import-type SettlementAmountShape from \Increase\Cards\Card\AuthorizationControls\Usage\SingleUse\SettlementAmount
 *
 * @phpstan-type SingleUseShape = array{
 *   settlementAmount: SettlementAmount|SettlementAmountShape
 * }
 */
final class SingleUse implements BaseModel
{
    /** @use SdkModel<SingleUseShape> */
    use SdkModel;

    /**
     * The settlement amount constraint for this single-use card.
     */
    #[Required('settlement_amount')]
    public SettlementAmount $settlementAmount;

    /**
     * `new SingleUse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SingleUse::with(settlementAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SingleUse)->withSettlementAmount(...)
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
     * @param SettlementAmount|SettlementAmountShape $settlementAmount
     */
    public static function with(SettlementAmount|array $settlementAmount): self
    {
        $self = new self;

        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The settlement amount constraint for this single-use card.
     *
     * @param SettlementAmount|SettlementAmountShape $settlementAmount
     */
    public function withSettlementAmount(
        SettlementAmount|array $settlementAmount
    ): self {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }
}
