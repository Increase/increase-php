<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The name of the cardholder. Used to respond to Account Name Inquiry requests from acquirers in Card Validations.
 *
 * @phpstan-type CardholderNameShape = array{
 *   first: string, last: string, middle?: string|null
 * }
 */
final class CardholderName implements BaseModel
{
    /** @use SdkModel<CardholderNameShape> */
    use SdkModel;

    /**
     * The cardholder's first name.
     */
    #[Required]
    public string $first;

    /**
     * The cardholder's last name.
     */
    #[Required]
    public string $last;

    /**
     * The cardholder's middle name.
     */
    #[Optional]
    public ?string $middle;

    /**
     * `new CardholderName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderName::with(first: ..., last: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderName)->withFirst(...)->withLast(...)
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
        string $first,
        string $last,
        ?string $middle = null
    ): self {
        $self = new self;

        $self['first'] = $first;
        $self['last'] = $last;

        null !== $middle && $self['middle'] = $middle;

        return $self;
    }

    /**
     * The cardholder's first name.
     */
    public function withFirst(string $first): self
    {
        $self = clone $this;
        $self['first'] = $first;

        return $self;
    }

    /**
     * The cardholder's last name.
     */
    public function withLast(string $last): self
    {
        $self = clone $this;
        $self['last'] = $last;

        return $self;
    }

    /**
     * The cardholder's middle name.
     */
    public function withMiddle(string $middle): self
    {
        $self = clone $this;
        $self['middle'] = $middle;

        return $self;
    }
}
