<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
 *
 * @phpstan-type FrontTextShape = array{line1: string, line2?: string|null}
 */
final class FrontText implements BaseModel
{
    /** @use SdkModel<FrontTextShape> */
    use SdkModel;

    /**
     * The first line of text on the front of the card.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of text on the front of the card. Providing a second line moves the first line slightly higher and prints the second line in the spot where the first line would have otherwise been printed.
     */
    #[Optional]
    public ?string $line2;

    /**
     * `new FrontText()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FrontText::with(line1: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FrontText)->withLine1(...)
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
    public static function with(string $line1, ?string $line2 = null): self
    {
        $self = new self;

        $self['line1'] = $line1;

        null !== $line2 && $self['line2'] = $line2;

        return $self;
    }

    /**
     * The first line of text on the front of the card.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of text on the front of the card. Providing a second line moves the first line slightly higher and prints the second line in the spot where the first line would have otherwise been printed.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }
}
