<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItem;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundMailItems\InboundMailItem\Check\Status;

/**
 * Inbound Mail Item Checks represent the checks in an Inbound Mail Item.
 *
 * @phpstan-type CheckShape = array{
 *   amount: int,
 *   backFileID: string|null,
 *   checkDepositID: string|null,
 *   frontFileID: string|null,
 *   status: null|\Increase\InboundMailItems\InboundMailItem\Check\Status|value-of<\Increase\InboundMailItems\InboundMailItem\Check\Status>,
 * }
 */
final class Check implements BaseModel
{
    /** @use SdkModel<CheckShape> */
    use SdkModel;

    /**
     * The amount of the check.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier for the File containing the back of the check.
     */
    #[Required('back_file_id')]
    public ?string $backFileID;

    /**
     * The identifier of the Check Deposit if this check was deposited.
     */
    #[Required('check_deposit_id')]
    public ?string $checkDepositID;

    /**
     * The identifier for the File containing the front of the check.
     */
    #[Required('front_file_id')]
    public ?string $frontFileID;

    /**
     * The status of the Inbound Mail Item Check.
     *
     * @var value-of<Status>|null $status
     */
    #[Required(
        enum: Status::class
    )]
    public ?string $status;

    /**
     * `new Check()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Check::with(
     *   amount: ...,
     *   backFileID: ...,
     *   checkDepositID: ...,
     *   frontFileID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Check)
     *   ->withAmount(...)
     *   ->withBackFileID(...)
     *   ->withCheckDepositID(...)
     *   ->withFrontFileID(...)
     *   ->withStatus(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        int $amount,
        ?string $backFileID,
        ?string $checkDepositID,
        ?string $frontFileID,
        Status|string|null $status,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['backFileID'] = $backFileID;
        $self['checkDepositID'] = $checkDepositID;
        $self['frontFileID'] = $frontFileID;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The amount of the check.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier for the File containing the back of the check.
     */
    public function withBackFileID(?string $backFileID): self
    {
        $self = clone $this;
        $self['backFileID'] = $backFileID;

        return $self;
    }

    /**
     * The identifier of the Check Deposit if this check was deposited.
     */
    public function withCheckDepositID(?string $checkDepositID): self
    {
        $self = clone $this;
        $self['checkDepositID'] = $checkDepositID;

        return $self;
    }

    /**
     * The identifier for the File containing the front of the check.
     */
    public function withFrontFileID(?string $frontFileID): self
    {
        $self = clone $this;
        $self['frontFileID'] = $frontFileID;

        return $self;
    }

    /**
     * The status of the Inbound Mail Item Check.
     *
     * @param Status|value-of<Status>|null $status
     */
    public function withStatus(
        Status|string|null $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
