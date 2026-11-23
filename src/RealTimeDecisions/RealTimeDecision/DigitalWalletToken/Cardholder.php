<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The cardholder adding the card to the digital wallet.
 *
 * @phpstan-type CardholderShape = array{name: string|null}
 */
final class Cardholder implements BaseModel
{
    /** @use SdkModel<CardholderShape> */
    use SdkModel;

    /**
     * The cardholder's name, as entered in the digital wallet.
     */
    #[Required]
    public ?string $name;

    /**
     * `new Cardholder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cardholder::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cardholder)->withName(...)
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
    public static function with(?string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * The cardholder's name, as entered in the digital wallet.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
