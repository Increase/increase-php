<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\CardCreateParams\BillingAddress;
use Increase\Cards\CardCreateParams\DigitalWallet;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Card.
 *
 * @see Increase\Services\CardsService::create()
 *
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardCreateParams\BillingAddress
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardCreateParams\DigitalWallet
 *
 * @phpstan-type CardCreateParamsShape = array{
 *   accountID: string,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   description?: string|null,
 *   digitalWallet?: null|DigitalWallet|DigitalWalletShape,
 *   entityID?: string|null,
 * }
 */
final class CardCreateParams implements BaseModel
{
    /** @use SdkModel<CardCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account the card should belong to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The card's billing address.
     */
    #[Optional('billing_address')]
    public ?BillingAddress $billingAddress;

    /**
     * The description you choose to give the card.
     */
    #[Optional]
    public ?string $description;

    /**
     * The contact information used in the two-factor steps for digital wallet card creation. To add the card to a digital wallet, you may supply an email or phone number with this request. Otherwise, subscribe and then action a Real Time Decision with the category `digital_wallet_token_requested` or `digital_wallet_authentication_requested`.
     */
    #[Optional('digital_wallet')]
    public ?DigitalWallet $digitalWallet;

    /**
     * The Entity the card belongs to. You only need to supply this in rare situations when the card is not for the Account holder.
     */
    #[Optional('entity_id')]
    public ?string $entityID;

    /**
     * `new CardCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardCreateParams::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardCreateParams)->withAccountID(...)
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
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param DigitalWallet|DigitalWalletShape|null $digitalWallet
     */
    public static function with(
        string $accountID,
        BillingAddress|array|null $billingAddress = null,
        ?string $description = null,
        DigitalWallet|array|null $digitalWallet = null,
        ?string $entityID = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;

        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $description && $self['description'] = $description;
        null !== $digitalWallet && $self['digitalWallet'] = $digitalWallet;
        null !== $entityID && $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The Account the card should belong to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The card's billing address.
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
     * The contact information used in the two-factor steps for digital wallet card creation. To add the card to a digital wallet, you may supply an email or phone number with this request. Otherwise, subscribe and then action a Real Time Decision with the category `digital_wallet_token_requested` or `digital_wallet_authentication_requested`.
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
}
