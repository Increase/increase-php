<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the Card Dispute's status is `won`, this will contain details of the won dispute.
 *
 * @phpstan-type WinShape = array{wonAt: \DateTimeInterface}
 */
final class Win implements BaseModel
{
    /** @use SdkModel<WinShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was won.
     */
    #[Required('won_at')]
    public \DateTimeInterface $wonAt;

    /**
     * `new Win()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Win::with(wonAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Win)->withWonAt(...)
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
    public static function with(\DateTimeInterface $wonAt): self
    {
        $self = new self;

        $self['wonAt'] = $wonAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was won.
     */
    public function withWonAt(\DateTimeInterface $wonAt): self
    {
        $self = clone $this;
        $self['wonAt'] = $wonAt;

        return $self;
    }
}
