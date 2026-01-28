<?php

declare(strict_types=1);

namespace Increase\CardDisputes;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Withdraw a Card Dispute.
 *
 * @see Increase\Services\CardDisputesService::withdraw()
 *
 * @phpstan-type CardDisputeWithdrawParamsShape = array{explanation?: string|null}
 */
final class CardDisputeWithdrawParams implements BaseModel
{
    /** @use SdkModel<CardDisputeWithdrawParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The explanation for withdrawing the Card Dispute.
     */
    #[Optional]
    public ?string $explanation;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $explanation = null): self
    {
        $self = new self;

        null !== $explanation && $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The explanation for withdrawing the Card Dispute.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
