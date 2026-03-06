<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Browser;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Category;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\MerchantInitiated;

/**
 * The device channel of the card authentication attempt.
 *
 * @phpstan-import-type BrowserShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Browser
 * @phpstan-import-type MerchantInitiatedShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\MerchantInitiated
 *
 * @phpstan-type DeviceChannelShape = array{
 *   browser: null|Browser|BrowserShape,
 *   category: \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Category|value-of<\Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Category>,
 *   merchantInitiated: null|MerchantInitiated|MerchantInitiatedShape,
 * }
 */
final class DeviceChannel implements BaseModel
{
    /** @use SdkModel<DeviceChannelShape> */
    use SdkModel;

    /**
     * Fields specific to the browser device channel.
     */
    #[Required]
    public ?Browser $browser;

    /**
     * The category of the device channel.
     *
     * @var value-of<Category> $category
     */
    #[Required(
        enum: Category::class,
    )]
    public string $category;

    /**
     * Fields specific to merchant initiated transactions.
     */
    #[Required('merchant_initiated')]
    public ?MerchantInitiated $merchantInitiated;

    /**
     * `new DeviceChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceChannel::with(browser: ..., category: ..., merchantInitiated: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceChannel)
     *   ->withBrowser(...)
     *   ->withCategory(...)
     *   ->withMerchantInitiated(...)
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
     * @param Browser|BrowserShape|null $browser
     * @param Category|value-of<Category> $category
     * @param MerchantInitiated|MerchantInitiatedShape|null $merchantInitiated
     */
    public static function with(
        Browser|array|null $browser,
        Category|string $category,
        MerchantInitiated|array|null $merchantInitiated,
    ): self {
        $self = new self;

        $self['browser'] = $browser;
        $self['category'] = $category;
        $self['merchantInitiated'] = $merchantInitiated;

        return $self;
    }

    /**
     * Fields specific to the browser device channel.
     *
     * @param Browser|BrowserShape|null $browser
     */
    public function withBrowser(Browser|array|null $browser): self
    {
        $self = clone $this;
        $self['browser'] = $browser;

        return $self;
    }

    /**
     * The category of the device channel.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(
        Category|string $category,
    ): self {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Fields specific to merchant initiated transactions.
     *
     * @param MerchantInitiated|MerchantInitiatedShape|null $merchantInitiated
     */
    public function withMerchantInitiated(
        MerchantInitiated|array|null $merchantInitiated
    ): self {
        $self = clone $this;
        $self['merchantInitiated'] = $merchantInitiated;

        return $self;
    }
}
