<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDecline\Reason;

/**
 * A Check Decline object. This field will be present in the JSON response if and only if `category` is equal to `check_decline`.
 *
 * @phpstan-type CheckDeclineShape = array{
 *   amount: int,
 *   auxiliaryOnUs: string|null,
 *   backImageFileID: string|null,
 *   checkTransferID: string|null,
 *   frontImageFileID: string|null,
 *   inboundCheckDepositID: string|null,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class CheckDecline implements BaseModel
{
    /** @use SdkModel<CheckDeclineShape> */
    use SdkModel;

    /**
     * The declined amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * A computer-readable number printed on the MICR line of business checks, usually the check number. This is useful for positive pay checks, but can be unreliably transmitted by the bank of first deposit.
     */
    #[Required('auxiliary_on_us')]
    public ?string $auxiliaryOnUs;

    /**
     * The identifier of the API File object containing an image of the back of the declined check.
     */
    #[Required('back_image_file_id')]
    public ?string $backImageFileID;

    /**
     * The identifier of the Check Transfer object associated with this decline.
     */
    #[Required('check_transfer_id')]
    public ?string $checkTransferID;

    /**
     * The identifier of the API File object containing an image of the front of the declined check.
     */
    #[Required('front_image_file_id')]
    public ?string $frontImageFileID;

    /**
     * The identifier of the Inbound Check Deposit object associated with this decline.
     */
    #[Required('inbound_check_deposit_id')]
    public ?string $inboundCheckDepositID;

    /**
     * Why the check was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new CheckDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckDecline::with(
     *   amount: ...,
     *   auxiliaryOnUs: ...,
     *   backImageFileID: ...,
     *   checkTransferID: ...,
     *   frontImageFileID: ...,
     *   inboundCheckDepositID: ...,
     *   reason: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckDecline)
     *   ->withAmount(...)
     *   ->withAuxiliaryOnUs(...)
     *   ->withBackImageFileID(...)
     *   ->withCheckTransferID(...)
     *   ->withFrontImageFileID(...)
     *   ->withInboundCheckDepositID(...)
     *   ->withReason(...)
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
    public static function with(
        int $amount,
        ?string $auxiliaryOnUs,
        ?string $backImageFileID,
        ?string $checkTransferID,
        ?string $frontImageFileID,
        ?string $inboundCheckDepositID,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['auxiliaryOnUs'] = $auxiliaryOnUs;
        $self['backImageFileID'] = $backImageFileID;
        $self['checkTransferID'] = $checkTransferID;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['inboundCheckDepositID'] = $inboundCheckDepositID;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The declined amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * A computer-readable number printed on the MICR line of business checks, usually the check number. This is useful for positive pay checks, but can be unreliably transmitted by the bank of first deposit.
     */
    public function withAuxiliaryOnUs(?string $auxiliaryOnUs): self
    {
        $self = clone $this;
        $self['auxiliaryOnUs'] = $auxiliaryOnUs;

        return $self;
    }

    /**
     * The identifier of the API File object containing an image of the back of the declined check.
     */
    public function withBackImageFileID(?string $backImageFileID): self
    {
        $self = clone $this;
        $self['backImageFileID'] = $backImageFileID;

        return $self;
    }

    /**
     * The identifier of the Check Transfer object associated with this decline.
     */
    public function withCheckTransferID(?string $checkTransferID): self
    {
        $self = clone $this;
        $self['checkTransferID'] = $checkTransferID;

        return $self;
    }

    /**
     * The identifier of the API File object containing an image of the front of the declined check.
     */
    public function withFrontImageFileID(?string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * The identifier of the Inbound Check Deposit object associated with this decline.
     */
    public function withInboundCheckDepositID(
        ?string $inboundCheckDepositID
    ): self {
        $self = clone $this;
        $self['inboundCheckDepositID'] = $inboundCheckDepositID;

        return $self;
    }

    /**
     * Why the check was declined.
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
