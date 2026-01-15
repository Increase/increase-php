<?php

declare(strict_types=1);

namespace Increase\SupplementalDocuments;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a supplemental document for an Entity.
 *
 * @see Increase\Services\SupplementalDocumentsService::create()
 *
 * @phpstan-type SupplementalDocumentCreateParamsShape = array{
 *   entityID: string, fileID: string
 * }
 */
final class SupplementalDocumentCreateParams implements BaseModel
{
    /** @use SdkModel<SupplementalDocumentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Entity to associate with the supplemental document.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * The identifier of the File containing the document.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * `new SupplementalDocumentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SupplementalDocumentCreateParams::with(entityID: ..., fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SupplementalDocumentCreateParams)->withEntityID(...)->withFileID(...)
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
    public static function with(string $entityID, string $fileID): self
    {
        $self = new self;

        $self['entityID'] = $entityID;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The identifier of the Entity to associate with the supplemental document.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

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
