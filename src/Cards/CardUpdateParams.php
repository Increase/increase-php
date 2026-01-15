<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\CardUpdateParams\BillingAddress;
use Increase\Cards\CardUpdateParams\DigitalWallet;
use Increase\Cards\CardUpdateParams\Status;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update a Card.
 *
 * @see Increase\Services\CardsService::update()
 *
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardUpdateParams\BillingAddress
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardUpdateParams\DigitalWallet
 *
 * @phpstan-type CardUpdateParamsShape = array{
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   description?: string|null,
 *   digitalWallet?: null|DigitalWallet|DigitalWalletShape,
 *   entityID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class CardUpdateParams implements BaseModel
{
    /** @use SdkModel<CardUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The card's updated billing address.
     */
    #[Optional('billing_address')]
    public ?BillingAddress $billingAddress;

    /**
     * The description you choose to give the card.
     */
    #[Optional]
    public ?string $description;

    /**
     * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
     */
    #[Optional('digital_wallet')]
    public ?DigitalWallet $digitalWallet;

    /**
     * The Entity the card belongs to. You only need to supply this in rare situations when the card is not for the Account holder.
     */
    #[Optional('entity_id')]
    public ?string $entityID;

    /**
     * The status to update the Card with.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param DigitalWallet|DigitalWalletShape|null $digitalWallet
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        BillingAddress|array|null $billingAddress = null,
        ?string $description = null,
        DigitalWallet|array|null $digitalWallet = null,
        ?string $entityID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $description && $self['description'] = $description;
        null !== $digitalWallet && $self['digitalWallet'] = $digitalWallet;
        null !== $entityID && $self['entityID'] = $entityID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The card's updated billing address.
     *
     * @param BillingAddress|BillingAddressShape $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * The description you choose to give the card.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
     *
     * @param DigitalWallet|DigitalWalletShape $digitalWallet
     */
    public function withDigitalWallet(DigitalWallet|array $digitalWallet): self
    {
        $self = clone $this;
        $self['digitalWallet'] = $digitalWallet;

        return $self;
    }

    /**
     * The Entity the card belongs to. You only need to supply this in rare situations when the card is not for the Account holder.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The status to update the Card with.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
