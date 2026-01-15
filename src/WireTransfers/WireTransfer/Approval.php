<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
 *
 * @phpstan-type ApprovalShape = array{
 *   approvedAt: \DateTimeInterface, approvedBy: string|null
 * }
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was approved.
     */
    #[Required('approved_at')]
    public \DateTimeInterface $approvedAt;

    /**
     * If the Transfer was approved by a user in the dashboard, the email address of that user.
     */
    #[Required('approved_by')]
    public ?string $approvedBy;

    /**
     * `new Approval()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Approval::with(approvedAt: ..., approvedBy: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Approval)->withApprovedAt(...)->withApprovedBy(...)
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
        \DateTimeInterface $approvedAt,
        ?string $approvedBy
    ): self {
        $self = new self;

        $self['approvedAt'] = $approvedAt;
        $self['approvedBy'] = $approvedBy;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was approved.
     */
    public function withApprovedAt(\DateTimeInterface $approvedAt): self
    {
        $self = clone $this;
        $self['approvedAt'] = $approvedAt;

        return $self;
    }

    /**
     * If the Transfer was approved by a user in the dashboard, the email address of that user.
     */
    public function withApprovedBy(?string $approvedBy): self
    {
        $self = clone $this;
        $self['approvedBy'] = $approvedBy;

        return $self;
    }
}
