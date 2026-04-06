<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams\AuthorizationControls\Usage;

use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\MultiUse\SpendingLimit;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls for multi-use cards. Required if and only if `category` is `multi_use`.
 *
 * @phpstan-import-type SpendingLimitShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\MultiUse\SpendingLimit
 *
 * @phpstan-type MultiUseShape = array{
 *   spendingLimits?: list<SpendingLimit|SpendingLimitShape>|null
 * }
 */
final class MultiUse implements BaseModel
{
    /** @use SdkModel<MultiUseShape> */
    use SdkModel;

    /**
     * Spending limits for this card. The most restrictive limit applies if multiple limits match.
     *
     * @var list<SpendingLimit>|null $spendingLimits
     */
    #[Optional('spending_limits', list: SpendingLimit::class)]
    public ?array $spendingLimits;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<SpendingLimit|SpendingLimitShape>|null $spendingLimits
     */
    public static function with(?array $spendingLimits = null): self
    {
        $self = new self;

        null !== $spendingLimits && $self['spendingLimits'] = $spendingLimits;

        return $self;
    }

    /**
     * Spending limits for this card. The most restrictive limit applies if multiple limits match.
     *
     * @param list<SpendingLimit|SpendingLimitShape> $spendingLimits
     */
    public function withSpendingLimits(array $spendingLimits): self
    {
        $self = clone $this;
        $self['spendingLimits'] = $spendingLimits;

        return $self;
    }
}
