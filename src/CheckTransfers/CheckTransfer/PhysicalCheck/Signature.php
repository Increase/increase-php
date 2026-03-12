<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\PhysicalCheck;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The signature that will appear on the check.
 *
 * @phpstan-type SignatureShape = array{
 *   imageFileID: string|null, text: string|null
 * }
 */
final class Signature implements BaseModel
{
    /** @use SdkModel<SignatureShape> */
    use SdkModel;

    /**
     * The ID of a File containing a PNG of the signature.
     */
    #[Required('image_file_id')]
    public ?string $imageFileID;

    /**
     * The text that will appear as the signature on the check in cursive font.
     */
    #[Required]
    public ?string $text;

    /**
     * `new Signature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Signature::with(imageFileID: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Signature)->withImageFileID(...)->withText(...)
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
    public static function with(?string $imageFileID, ?string $text): self
    {
        $self = new self;

        $self['imageFileID'] = $imageFileID;
        $self['text'] = $text;

        return $self;
    }

    /**
     * The ID of a File containing a PNG of the signature.
     */
    public function withImageFileID(?string $imageFileID): self
    {
        $self = clone $this;
        $self['imageFileID'] = $imageFileID;

        return $self;
    }

    /**
     * The text that will appear as the signature on the check in cursive font.
     */
    public function withText(?string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
