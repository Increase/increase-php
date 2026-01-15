<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type SupplementalDocumentShape = array{fileID: string}
 */
final class SupplementalDocument implements BaseModel
{
    /** @use SdkModel<SupplementalDocumentShape> */
    use SdkModel;

    /**
     * The identifier of the File containing the document.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * `new SupplementalDocument()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SupplementalDocument::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SupplementalDocument)->withFileID(...)
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
    public static function with(string $fileID): self
    {
        $self = new self;

        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The identifier of the File containing the document.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }
}
