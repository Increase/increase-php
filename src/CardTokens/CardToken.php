<?php

declare(strict_types=1);

namespace Increase\CardTokens;

use Increase\CardTokens\CardToken\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Card Tokens represent a tokenized card number that can be used for Card Push Transfers and Card Validations.
 *
 * @phpstan-type CardTokenShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   expirationDate: string,
 *   last4: string,
 *   length: int,
 *   prefix: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardToken implements BaseModel
{
    /** @use SdkModel<CardTokenShape> */
    use SdkModel;

    /**
     * The Card Token's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the card token was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date when the card expires.
     */
    #[Required('expiration_date')]
    public string $expirationDate;

    /**
     * The last 4 digits of the card number.
     */
    #[Required]
    public string $last4;

    /**
     * The length of the card number.
     */
    #[Required]
    public int $length;

    /**
     * The prefix of the card number, usually 8 digits.
     */
    #[Required]
    public string $prefix;

    /**
     * A constant representing the object's type. For this resource it will always be `card_token`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardToken::with(
     *   id: ...,
     *   createdAt: ...,
     *   expirationDate: ...,
     *   last4: ...,
     *   length: ...,
     *   prefix: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardToken)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withExpirationDate(...)
     *   ->withLast4(...)
     *   ->withLength(...)
     *   ->withPrefix(...)
     *   ->withType(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        string $expirationDate,
        string $last4,
        int $length,
        string $prefix,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['expirationDate'] = $expirationDate;
        $self['last4'] = $last4;
        $self['length'] = $length;
        $self['prefix'] = $prefix;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Token's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the card token was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date when the card expires.
     */
    public function withExpirationDate(string $expirationDate): self
    {
        $self = clone $this;
        $self['expirationDate'] = $expirationDate;

        return $self;
    }

    /**
     * The last 4 digits of the card number.
     */
    public function withLast4(string $last4): self
    {
        $self = clone $this;
        $self['last4'] = $last4;

        return $self;
    }

    /**
     * The length of the card number.
     */
    public function withLength(int $length): self
    {
        $self = clone $this;
        $self['length'] = $length;

        return $self;
    }

    /**
     * The prefix of the card number, usually 8 digits.
     */
    public function withPrefix(string $prefix): self
    {
        $self = clone $this;
        $self['prefix'] = $prefix;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_token`.
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
