<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthentications;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\Category;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\DeviceChannel;

/**
 * Simulates a Card Authentication attempt on a [Card](#cards). The attempt always results in a [Card Payment](#card_payments) being created, either with a status that allows further action or a terminal failed status.
 *
 * @see Increase\Services\Simulations\CardAuthenticationsService::create()
 *
 * @phpstan-type CardAuthenticationCreateParamsShape = array{
 *   cardID: string,
 *   category?: null|Category|value-of<Category>,
 *   deviceChannel?: null|DeviceChannel|value-of<DeviceChannel>,
 *   merchantAcceptorID?: string|null,
 *   merchantCategoryCode?: string|null,
 *   merchantCountry?: string|null,
 *   merchantName?: string|null,
 *   purchaseAmount?: int|null,
 * }
 */
final class CardAuthenticationCreateParams implements BaseModel
{
    /** @use SdkModel<CardAuthenticationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Card to be authorized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The category of the card authentication attempt.
     *
     * @var value-of<Category>|null $category
     */
    #[Optional(enum: Category::class)]
    public ?string $category;

    /**
     * The device channel of the card authentication attempt.
     *
     * @var value-of<DeviceChannel>|null $deviceChannel
     */
    #[Optional('device_channel', enum: DeviceChannel::class)]
    public ?string $deviceChannel;

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Optional('merchant_acceptor_id')]
    public ?string $merchantAcceptorID;

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    #[Optional('merchant_category_code')]
    public ?string $merchantCategoryCode;

    /**
     * The country the merchant resides in.
     */
    #[Optional('merchant_country')]
    public ?string $merchantCountry;

    /**
     * The name of the merchant.
     */
    #[Optional('merchant_name')]
    public ?string $merchantName;

    /**
     * The purchase amount in cents.
     */
    #[Optional('purchase_amount')]
    public ?int $purchaseAmount;

    /**
     * `new CardAuthenticationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthenticationCreateParams::with(cardID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthenticationCreateParams)->withCardID(...)
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
     * @param Category|value-of<Category>|null $category
     * @param DeviceChannel|value-of<DeviceChannel>|null $deviceChannel
     */
    public static function with(
        string $cardID,
        Category|string|null $category = null,
        DeviceChannel|string|null $deviceChannel = null,
        ?string $merchantAcceptorID = null,
        ?string $merchantCategoryCode = null,
        ?string $merchantCountry = null,
        ?string $merchantName = null,
        ?int $purchaseAmount = null,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;

        null !== $category && $self['category'] = $category;
        null !== $deviceChannel && $self['deviceChannel'] = $deviceChannel;
        null !== $merchantAcceptorID && $self['merchantAcceptorID'] = $merchantAcceptorID;
        null !== $merchantCategoryCode && $self['merchantCategoryCode'] = $merchantCategoryCode;
        null !== $merchantCountry && $self['merchantCountry'] = $merchantCountry;
        null !== $merchantName && $self['merchantName'] = $merchantName;
        null !== $purchaseAmount && $self['purchaseAmount'] = $purchaseAmount;

        return $self;
    }

    /**
     * The identifier of the Card to be authorized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The category of the card authentication attempt.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The device channel of the card authentication attempt.
     *
     * @param DeviceChannel|value-of<DeviceChannel> $deviceChannel
     */
    public function withDeviceChannel(DeviceChannel|string $deviceChannel): self
    {
        $self = clone $this;
        $self['deviceChannel'] = $deviceChannel;

        return $self;
    }

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    public function withMerchantAcceptorID(string $merchantAcceptorID): self
    {
        $self = clone $this;
        $self['merchantAcceptorID'] = $merchantAcceptorID;

        return $self;
    }

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The name of the merchant.
     */
    public function withMerchantName(string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * The purchase amount in cents.
     */
    public function withPurchaseAmount(int $purchaseAmount): self
    {
        $self = clone $this;
        $self['purchaseAmount'] = $purchaseAmount;

        return $self;
    }
}
