<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the Card Dispute has been withdrawn, this will contain details of the withdrawal.
 *
 * @phpstan-type WithdrawalShape = array{explanation: string|null}
 */
final class Withdrawal implements BaseModel
{
    /** @use SdkModel<WithdrawalShape> */
    use SdkModel;

    /**
     * The explanation for the withdrawal of the Card Dispute.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new Withdrawal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Withdrawal::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Withdrawal)->withExplanation(...)
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
     * The explanation for the withdrawal of the Card Dispute.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
