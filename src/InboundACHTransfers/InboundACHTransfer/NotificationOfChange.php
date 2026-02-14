<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If you initiate a notification of change in response to the transfer, this will contain its details.
 *
 * @phpstan-type NotificationOfChangeShape = array{
 *   updatedAccountNumber: string|null, updatedRoutingNumber: string|null
 * }
 */
final class NotificationOfChange implements BaseModel
{
    /** @use SdkModel<NotificationOfChangeShape> */
    use SdkModel;

    /**
     * The new account number provided in the notification of change.
     */
    #[Required('updated_account_number')]
    public ?string $updatedAccountNumber;

    /**
     * The new routing number provided in the notification of change.
     */
    #[Required('updated_routing_number')]
    public ?string $updatedRoutingNumber;

    /**
     * `new NotificationOfChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationOfChange::with(updatedAccountNumber: ..., updatedRoutingNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationOfChange)
     *   ->withUpdatedAccountNumber(...)
     *   ->withUpdatedRoutingNumber(...)
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
        ?string $updatedAccountNumber,
        ?string $updatedRoutingNumber
    ): self {
        $self = new self;

        $self['updatedAccountNumber'] = $updatedAccountNumber;
        $self['updatedRoutingNumber'] = $updatedRoutingNumber;

        return $self;
    }

    /**
     * The new account number provided in the notification of change.
     */
    public function withUpdatedAccountNumber(
        ?string $updatedAccountNumber
    ): self {
        $self = clone $this;
        $self['updatedAccountNumber'] = $updatedAccountNumber;

        return $self;
    }

    /**
     * The new routing number provided in the notification of change.
     */
    public function withUpdatedRoutingNumber(
        ?string $updatedRoutingNumber
    ): self {
        $self = clone $this;
        $self['updatedRoutingNumber'] = $updatedRoutingNumber;

        return $self;
    }
}
