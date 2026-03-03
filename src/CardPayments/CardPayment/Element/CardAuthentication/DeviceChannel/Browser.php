<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\Browser\JavascriptEnabled;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to the browser device channel.
 *
 * @phpstan-type BrowserShape = array{
 *   acceptHeader: string|null,
 *   ipAddress: string|null,
 *   javascriptEnabled: null|JavascriptEnabled|value-of<JavascriptEnabled>,
 *   language: string|null,
 *   userAgent: string|null,
 * }
 */
final class Browser implements BaseModel
{
    /** @use SdkModel<BrowserShape> */
    use SdkModel;

    /**
     * The accept header from the cardholder's browser.
     */
    #[Required('accept_header')]
    public ?string $acceptHeader;

    /**
     * The IP address of the cardholder's browser.
     */
    #[Required('ip_address')]
    public ?string $ipAddress;

    /**
     * Whether JavaScript is enabled in the cardholder's browser.
     *
     * @var value-of<JavascriptEnabled>|null $javascriptEnabled
     */
    #[Required('javascript_enabled', enum: JavascriptEnabled::class)]
    public ?string $javascriptEnabled;

    /**
     * The language of the cardholder's browser.
     */
    #[Required]
    public ?string $language;

    /**
     * The user agent of the cardholder's browser.
     */
    #[Required('user_agent')]
    public ?string $userAgent;

    /**
     * `new Browser()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Browser::with(
     *   acceptHeader: ...,
     *   ipAddress: ...,
     *   javascriptEnabled: ...,
     *   language: ...,
     *   userAgent: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Browser)
     *   ->withAcceptHeader(...)
     *   ->withIPAddress(...)
     *   ->withJavascriptEnabled(...)
     *   ->withLanguage(...)
     *   ->withUserAgent(...)
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
     * @param JavascriptEnabled|value-of<JavascriptEnabled>|null $javascriptEnabled
     */
    public static function with(
        ?string $acceptHeader,
        ?string $ipAddress,
        JavascriptEnabled|string|null $javascriptEnabled,
        ?string $language,
        ?string $userAgent,
    ): self {
        $self = new self;

        $self['acceptHeader'] = $acceptHeader;
        $self['ipAddress'] = $ipAddress;
        $self['javascriptEnabled'] = $javascriptEnabled;
        $self['language'] = $language;
        $self['userAgent'] = $userAgent;

        return $self;
    }

    /**
     * The accept header from the cardholder's browser.
     */
    public function withAcceptHeader(?string $acceptHeader): self
    {
        $self = clone $this;
        $self['acceptHeader'] = $acceptHeader;

        return $self;
    }

    /**
     * The IP address of the cardholder's browser.
     */
    public function withIPAddress(?string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    /**
     * Whether JavaScript is enabled in the cardholder's browser.
     *
     * @param JavascriptEnabled|value-of<JavascriptEnabled>|null $javascriptEnabled
     */
    public function withJavascriptEnabled(
        JavascriptEnabled|string|null $javascriptEnabled
    ): self {
        $self = clone $this;
        $self['javascriptEnabled'] = $javascriptEnabled;

        return $self;
    }

    /**
     * The language of the cardholder's browser.
     */
    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * The user agent of the cardholder's browser.
     */
    public function withUserAgent(?string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }
}
