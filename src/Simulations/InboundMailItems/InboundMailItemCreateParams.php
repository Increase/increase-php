<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundMailItems;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an inbound mail item to your account, as if someone had mailed a physical check to one of your account's Lockboxes.
 *
 * @see Increase\Services\Simulations\InboundMailItemsService::create()
 *
 * @phpstan-type InboundMailItemCreateParamsShape = array{
 *   amount: int,
 *   contentsFileID?: string|null,
 *   lockboxAddressID?: string|null,
 *   lockboxRecipientID?: string|null,
 * }
 */
final class InboundMailItemCreateParams implements BaseModel
{
    /** @use SdkModel<InboundMailItemCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of the check to be simulated, in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The file containing the PDF contents. If not present, a default check image file will be used.
     */
    #[Optional('contents_file_id')]
    public ?string $contentsFileID;

    /**
     * The identifier of the Lockbox Address to simulate inbound mail to.
     */
    #[Optional('lockbox_address_id')]
    public ?string $lockboxAddressID;

    /**
     * The identifier of the Lockbox Recipient to simulate inbound mail to.
     */
    #[Optional('lockbox_recipient_id')]
    public ?string $lockboxRecipientID;

    /**
     * `new InboundMailItemCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundMailItemCreateParams::with(amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundMailItemCreateParams)->withAmount(...)
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
        int $amount,
        ?string $contentsFileID = null,
        ?string $lockboxAddressID = null,
        ?string $lockboxRecipientID = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;

        null !== $contentsFileID && $self['contentsFileID'] = $contentsFileID;
        null !== $lockboxAddressID && $self['lockboxAddressID'] = $lockboxAddressID;
        null !== $lockboxRecipientID && $self['lockboxRecipientID'] = $lockboxRecipientID;

        return $self;
    }

    /**
     * The amount of the check to be simulated, in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The file containing the PDF contents. If not present, a default check image file will be used.
     */
    public function withContentsFileID(string $contentsFileID): self
    {
        $self = clone $this;
        $self['contentsFileID'] = $contentsFileID;

        return $self;
    }

    /**
     * The identifier of the Lockbox Address to simulate inbound mail to.
     */
    public function withLockboxAddressID(string $lockboxAddressID): self
    {
        $self = clone $this;
        $self['lockboxAddressID'] = $lockboxAddressID;

        return $self;
    }

    /**
     * The identifier of the Lockbox Recipient to simulate inbound mail to.
     */
    public function withLockboxRecipientID(string $lockboxRecipientID): self
    {
        $self = clone $this;
        $self['lockboxRecipientID'] = $lockboxRecipientID;

        return $self;
    }
}
