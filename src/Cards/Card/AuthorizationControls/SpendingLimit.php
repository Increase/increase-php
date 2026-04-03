<?php

declare(strict_types=1);

namespace Increase\Cards\Card\AuthorizationControls;

use Increase\Cards\Card\AuthorizationControls\SpendingLimit\Interval;
use Increase\Cards\Card\AuthorizationControls\SpendingLimit\MerchantCategoryCode;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\Card\AuthorizationControls\SpendingLimit\MerchantCategoryCode
 *
 * @phpstan-type SpendingLimitShape = array{
 *   interval: Interval|value-of<Interval>,
 *   merchantCategoryCodes: list<\Increase\Cards\Card\AuthorizationControls\SpendingLimit\MerchantCategoryCode|MerchantCategoryCodeShape>|null,
 *   settlementAmount: int,
 * }
 */
final class SpendingLimit implements BaseModel
{
    /** @use SdkModel<SpendingLimitShape> */
    use SdkModel;

    /**
     * The interval at which the spending limit is enforced.
     *
     * @var value-of<Interval> $interval
     */
    #[Required(enum: Interval::class)]
    public string $interval;

    /**
     * The Merchant Category Codes (MCCs) this spending limit applies to. If not set, the limit applies to all transactions.
     *
     * @var list<MerchantCategoryCode>|null $merchantCategoryCodes
     */
    #[Required(
        'merchant_category_codes',
        list: MerchantCategoryCode::class,
    )]
    public ?array $merchantCategoryCodes;

    /**
     * The maximum settlement amount permitted in the given interval.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * `new SpendingLimit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SpendingLimit::with(
     *   interval: ..., merchantCategoryCodes: ..., settlementAmount: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SpendingLimit)
     *   ->withInterval(...)
     *   ->withMerchantCategoryCodes(...)
     *   ->withSettlementAmount(...)
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
     * @param Interval|value-of<Interval> $interval
     * @param list<MerchantCategoryCode|MerchantCategoryCodeShape>|null $merchantCategoryCodes
     */
    public static function with(
        Interval|string $interval,
        ?array $merchantCategoryCodes,
        int $settlementAmount,
    ): self {
        $self = new self;

        $self['interval'] = $interval;
        $self['merchantCategoryCodes'] = $merchantCategoryCodes;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The interval at which the spending limit is enforced.
     *
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * The Merchant Category Codes (MCCs) this spending limit applies to. If not set, the limit applies to all transactions.
     *
     * @param list<MerchantCategoryCode|MerchantCategoryCodeShape>|null $merchantCategoryCodes
     */
    public function withMerchantCategoryCodes(
        ?array $merchantCategoryCodes
    ): self {
        $self = clone $this;
        $self['merchantCategoryCodes'] = $merchantCategoryCodes;

        return $self;
    }

    /**
     * The maximum settlement amount permitted in the given interval.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }
}
