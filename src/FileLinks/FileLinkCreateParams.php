<?php

declare(strict_types=1);

namespace Increase\FileLinks;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a File Link.
 *
 * @see Increase\Services\FileLinksService::create()
 *
 * @phpstan-type FileLinkCreateParamsShape = array{
 *   fileID: string, expiresAt?: \DateTimeInterface|null
 * }
 */
final class FileLinkCreateParams implements BaseModel
{
    /** @use SdkModel<FileLinkCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The File to create a File Link for.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The time at which the File Link will expire. The default is 1 hour from the time of the request. The maxiumum is 1 day from the time of the request.
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new FileLinkCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileLinkCreateParams::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileLinkCreateParams)->withFileID(...)
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
    public static function with(
        string $fileID,
        ?\DateTimeInterface $expiresAt = null
    ): self {
        $self = new self;

        $self['fileID'] = $fileID;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The File to create a File Link for.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The time at which the File Link will expire. The default is 1 hour from the time of the request. The maxiumum is 1 day from the time of the request.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
