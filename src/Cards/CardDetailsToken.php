<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\CardDetailsToken\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A short-lived token that authorizes Increase Card Elements to render the details of a single Card.
 *
 * @phpstan-type CardDetailsTokenShape = array{
 *   token: string, expiresAt: \DateTimeInterface, type: Type|value-of<Type>
 * }
 */
final class CardDetailsToken implements BaseModel
{
    /** @use SdkModel<CardDetailsTokenShape> */
    use SdkModel;

    /**
     * The token. Pass this to the `@increasebank/card-elements` library in your frontend. Treat it as a credential: it authorizes anyone holding it to read the Card's details until it expires.
     */
    #[Required]
    public string $token;

    /**
     * The time the token will expire. Tokens are valid for one hour.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * A constant representing the object's type. For this resource it will always be `card_details_token`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardDetailsToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDetailsToken::with(token: ..., expiresAt: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDetailsToken)->withToken(...)->withExpiresAt(...)->withType(...)
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
        string $token,
        \DateTimeInterface $expiresAt,
        Type|string $type
    ): self {
        $self = new self;

        $self['token'] = $token;
        $self['expiresAt'] = $expiresAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The token. Pass this to the `@increasebank/card-elements` library in your frontend. Treat it as a credential: it authorizes anyone holding it to read the Card's details until it expires.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * The time the token will expire. Tokens are valid for one hour.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_details_token`.
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
