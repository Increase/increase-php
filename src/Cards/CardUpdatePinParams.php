<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update a Card's PIN.
 *
 * @see Increase\Services\CardsService::updatePin()
 *
 * @phpstan-type CardUpdatePinParamsShape = array{pin: string}
 */
final class CardUpdatePinParams implements BaseModel
{
    /** @use SdkModel<CardUpdatePinParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The 4-digit PIN for the card, for use with ATMs.
     */
    #[Required]
    public string $pin;

    /**
     * `new CardUpdatePinParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardUpdatePinParams::with(pin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardUpdatePinParams)->withPin(...)
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
    public static function with(string $pin): self
    {
        $self = new self;

        $self['pin'] = $pin;

        return $self;
    }

    /**
     * The 4-digit PIN for the card, for use with ATMs.
     */
    public function withPin(string $pin): self
    {
        $self = clone $this;
        $self['pin'] = $pin;

        return $self;
    }
}
