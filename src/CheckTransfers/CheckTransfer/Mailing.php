<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the check has been mailed by Increase, this will contain details of the shipment.
 *
 * @phpstan-type MailingShape = array{mailedAt: \DateTimeInterface}
 */
final class Mailing implements BaseModel
{
    /** @use SdkModel<MailingShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check was mailed.
     */
    #[Required('mailed_at')]
    public \DateTimeInterface $mailedAt;

    /**
     * `new Mailing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Mailing::with(mailedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Mailing)->withMailedAt(...)
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
    public static function with(\DateTimeInterface $mailedAt): self
    {
        $self = new self;

        $self['mailedAt'] = $mailedAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check was mailed.
     */
    public function withMailedAt(\DateTimeInterface $mailedAt): self
    {
        $self = clone $this;
        $self['mailedAt'] = $mailedAt;

        return $self;
    }
}
