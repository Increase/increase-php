<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Browser;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The device channel of the card authentication attempt.
 *
 * @phpstan-import-type BrowserShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Browser
 *
 * @phpstan-type DeviceChannelShape = array{
 *   browser: null|Browser|BrowserShape,
 *   category: \Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Category|value-of<\Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Category>,
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
     * `new DeviceChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceChannel::with(browser: ..., category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceChannel)->withBrowser(...)->withCategory(...)
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
     */
    public static function with(
        Browser|array|null $browser,
        Category|string $category,
    ): self {
        $self = new self;

        $self['browser'] = $browser;
        $self['category'] = $category;

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
}
