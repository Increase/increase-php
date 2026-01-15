<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details about the cardholder, as it appears on the printed card.
 *
 * @phpstan-type CardholderShape = array{firstName: string, lastName: string}
 */
final class Cardholder implements BaseModel
{
    /** @use SdkModel<CardholderShape> */
    use SdkModel;

    /**
     * The cardholder's first name.
     */
    #[Required('first_name')]
    public string $firstName;

    /**
     * The cardholder's last name.
     */
    #[Required('last_name')]
    public string $lastName;

    /**
     * `new Cardholder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cardholder::with(firstName: ..., lastName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cardholder)->withFirstName(...)->withLastName(...)
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
    public static function with(string $firstName, string $lastName): self
    {
        $self = new self;

        $self['firstName'] = $firstName;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * The cardholder's first name.
     */
    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * The cardholder's last name.
     */
    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }
}
