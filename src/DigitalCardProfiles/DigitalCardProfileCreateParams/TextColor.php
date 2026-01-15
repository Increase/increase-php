<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The Card's text color, specified as an RGB triple. The default is white.
 *
 * @phpstan-type TextColorShape = array{blue: int, green: int, red: int}
 */
final class TextColor implements BaseModel
{
    /** @use SdkModel<TextColorShape> */
    use SdkModel;

    /**
     * The value of the blue channel in the RGB color.
     */
    #[Required]
    public int $blue;

    /**
     * The value of the green channel in the RGB color.
     */
    #[Required]
    public int $green;

    /**
     * The value of the red channel in the RGB color.
     */
    #[Required]
    public int $red;

    /**
     * `new TextColor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TextColor::with(blue: ..., green: ..., red: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TextColor)->withBlue(...)->withGreen(...)->withRed(...)
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
    public static function with(int $blue, int $green, int $red): self
    {
        $self = new self;

        $self['blue'] = $blue;
        $self['green'] = $green;
        $self['red'] = $red;

        return $self;
    }

    /**
     * The value of the blue channel in the RGB color.
     */
    public function withBlue(int $blue): self
    {
        $self = clone $this;
        $self['blue'] = $blue;

        return $self;
    }

    /**
     * The value of the green channel in the RGB color.
     */
    public function withGreen(int $green): self
    {
        $self = clone $this;
        $self['green'] = $green;

        return $self;
    }

    /**
     * The value of the red channel in the RGB color.
     */
    public function withRed(int $red): self
    {
        $self = clone $this;
        $self['red'] = $red;

        return $self;
    }
}
