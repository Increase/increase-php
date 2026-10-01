<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Declined\Reason;

/**
 * Details of the decline. Present if and only if `outcome` is `declined`.
 *
 * @phpstan-type DeclinedShape = array{reason: Reason|value-of<Reason>}
 */
final class Declined implements BaseModel
{
    /** @use SdkModel<DeclinedShape> */
    use SdkModel;

    /**
     * The reason the tokenization was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new Declined()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Declined::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Declined)->withReason(...)
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
    public static function with(Reason|string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason the tokenization was declined.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
