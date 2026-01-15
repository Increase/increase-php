<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\CardIframeURL\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An object containing the iframe URL for a Card.
 *
 * @phpstan-type CardIframeURLShape = array{
 *   expiresAt: \DateTimeInterface, iframeURL: string, type: Type|value-of<Type>
 * }
 */
final class CardIframeURL implements BaseModel
{
    /** @use SdkModel<CardIframeURLShape> */
    use SdkModel;

    /**
     * The time the iframe URL will expire.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The iframe URL for the Card. Treat this as an opaque URL.
     */
    #[Required('iframe_url')]
    public string $iframeURL;

    /**
     * A constant representing the object's type. For this resource it will always be `card_iframe_url`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardIframeURL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardIframeURL::with(expiresAt: ..., iframeURL: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardIframeURL)->withExpiresAt(...)->withIframeURL(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        \DateTimeInterface $expiresAt,
        string $iframeURL,
        Type|string $type
    ): self {
        $self = new self;

        $self['expiresAt'] = $expiresAt;
        $self['iframeURL'] = $iframeURL;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The time the iframe URL will expire.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The iframe URL for the Card. Treat this as an opaque URL.
     */
    public function withIframeURL(string $iframeURL): self
    {
        $self = clone $this;
        $self['iframeURL'] = $iframeURL;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_iframe_url`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
