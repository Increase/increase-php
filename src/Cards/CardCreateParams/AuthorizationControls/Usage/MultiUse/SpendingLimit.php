<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls\Usage\MultiUse;

use Increase\Cards\CardCreateParams\AuthorizationControls\Usage\MultiUse\SpendingLimit\Interval;
use Increase\Cards\CardCreateParams\AuthorizationControls\Usage\MultiUse\SpendingLimit\MerchantCategoryCode;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\CardCreateParams\AuthorizationControls\Usage\MultiUse\SpendingLimit\MerchantCategoryCode
 *
 * @phpstan-type SpendingLimitShape = array{
 *   interval: Interval|value-of<Interval>,
 *   settlementAmount: int,
 *   merchantCategoryCodes?: list<MerchantCategoryCode|MerchantCategoryCodeShape>|null,
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
     * The maximum settlement amount permitted in the given interval.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * The Merchant Category Codes this spending limit applies to. If not set, the limit applies to all transactions.
     *
     * @var list<MerchantCategoryCode>|null $merchantCategoryCodes
     */
    #[Optional('merchant_category_codes', list: MerchantCategoryCode::class)]
    public ?array $merchantCategoryCodes;

    /**
     * `new SpendingLimit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SpendingLimit::with(interval: ..., settlementAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SpendingLimit)->withInterval(...)->withSettlementAmount(...)
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
        int $settlementAmount,
        ?array $merchantCategoryCodes = null,
    ): self {
        $self = new self;

        $self['interval'] = $interval;
        $self['settlementAmount'] = $settlementAmount;

        null !== $merchantCategoryCodes && $self['merchantCategoryCodes'] = $merchantCategoryCodes;

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
     * The maximum settlement amount permitted in the given interval.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The Merchant Category Codes this spending limit applies to. If not set, the limit applies to all transactions.
     *
     * @param list<MerchantCategoryCode|MerchantCategoryCodeShape> $merchantCategoryCodes
     */
    public function withMerchantCategoryCodes(
        array $merchantCategoryCodes
    ): self {
        $self = clone $this;
        $self['merchantCategoryCodes'] = $merchantCategoryCodes;

        return $self;
    }
}
