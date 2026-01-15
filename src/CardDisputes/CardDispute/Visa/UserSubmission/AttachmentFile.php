<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachmentFileShape = array{fileID: string}
 */
final class AttachmentFile implements BaseModel
{
    /** @use SdkModel<AttachmentFileShape> */
    use SdkModel;

    /**
     * The ID of the file attached to the Card Dispute.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * `new AttachmentFile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentFile::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentFile)->withFileID(...)
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
     * The ID of the file attached to the Card Dispute.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }
}
