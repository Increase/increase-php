<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The signature that will appear on the check. If not provided, the check will be printed with 'No Signature Required'. At most one of `text` and `image_file_id` may be provided.
 *
 * @phpstan-type SignatureShape = array{
 *   imageFileID?: string|null, text?: string|null
 * }
 */
final class Signature implements BaseModel
{
    /** @use SdkModel<SignatureShape> */
    use SdkModel;

    /**
     * The ID of a File containing a PNG of the signature. This must have `purpose: check_signature` and be a 1320x120 pixel PNG.
     */
    #[Optional('image_file_id')]
    public ?string $imageFileID;

    /**
     * The text that will appear as the signature on the check in cursive font.
     */
    #[Optional]
    public ?string $text;

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
        ?string $imageFileID = null,
        ?string $text = null
    ): self {
        $self = new self;

        null !== $imageFileID && $self['imageFileID'] = $imageFileID;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * The ID of a File containing a PNG of the signature. This must have `purpose: check_signature` and be a 1320x120 pixel PNG.
     */
    public function withImageFileID(string $imageFileID): self
    {
        $self = clone $this;
        $self['imageFileID'] = $imageFileID;

        return $self;
    }

    /**
     * The text that will appear as the signature on the check in cursive font.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
