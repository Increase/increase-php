<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
 *
 * @phpstan-type CancellationShape = array{
 *   canceledAt: \DateTimeInterface, canceledBy: string|null
 * }
 */
final class Cancellation implements BaseModel
{
    /** @use SdkModel<CancellationShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Transfer was canceled.
     */
    #[Required('canceled_at')]
    public \DateTimeInterface $canceledAt;

    /**
     * If the Transfer was canceled by a user in the dashboard, the email address of that user.
     */
    #[Required('canceled_by')]
    public ?string $canceledBy;

    /**
     * `new Cancellation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cancellation::with(canceledAt: ..., canceledBy: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cancellation)->withCanceledAt(...)->withCanceledBy(...)
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
    public static function with(
        \DateTimeInterface $canceledAt,
        ?string $canceledBy
    ): self {
        $self = new self;

        $self['canceledAt'] = $canceledAt;
        $self['canceledBy'] = $canceledBy;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Transfer was canceled.
     */
    public function withCanceledAt(\DateTimeInterface $canceledAt): self
    {
        $self = clone $this;
        $self['canceledAt'] = $canceledAt;

        return $self;
    }

    /**
     * If the Transfer was canceled by a user in the dashboard, the email address of that user.
     */
    public function withCanceledBy(?string $canceledBy): self
    {
        $self = clone $this;
        $self['canceledBy'] = $canceledBy;

        return $self;
    }
}
