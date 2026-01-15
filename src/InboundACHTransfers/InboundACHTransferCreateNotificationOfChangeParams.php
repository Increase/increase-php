<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a notification of change for an Inbound ACH Transfer.
 *
 * @see Increase\Services\InboundACHTransfersService::createNotificationOfChange()
 *
 * @phpstan-type InboundACHTransferCreateNotificationOfChangeParamsShape = array{
 *   updatedAccountNumber?: string|null, updatedRoutingNumber?: string|null
 * }
 */
final class InboundACHTransferCreateNotificationOfChangeParams implements BaseModel
{
    /** @use SdkModel<InboundACHTransferCreateNotificationOfChangeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The updated account number to send in the notification of change.
     */
    #[Optional('updated_account_number')]
    public ?string $updatedAccountNumber;

    /**
     * The updated routing number to send in the notification of change.
     */
    #[Optional('updated_routing_number')]
    public ?string $updatedRoutingNumber;

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
        ?string $updatedAccountNumber = null,
        ?string $updatedRoutingNumber = null
    ): self {
        $self = new self;

        null !== $updatedAccountNumber && $self['updatedAccountNumber'] = $updatedAccountNumber;
        null !== $updatedRoutingNumber && $self['updatedRoutingNumber'] = $updatedRoutingNumber;

        return $self;
    }

    /**
     * The updated account number to send in the notification of change.
     */
    public function withUpdatedAccountNumber(string $updatedAccountNumber): self
    {
        $self = clone $this;
        $self['updatedAccountNumber'] = $updatedAccountNumber;

        return $self;
    }

    /**
     * The updated routing number to send in the notification of change.
     */
    public function withUpdatedRoutingNumber(string $updatedRoutingNumber): self
    {
        $self = clone $this;
        $self['updatedRoutingNumber'] = $updatedRoutingNumber;

        return $self;
    }
}
