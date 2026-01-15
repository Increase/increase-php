<?php

declare(strict_types=1);

namespace Increase\Files;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Files\FileCreateParams\Purpose;

/**
 * To upload a file to Increase, you'll need to send a request of Content-Type `multipart/form-data`. The request should contain the file you would like to upload, as well as the parameters for creating a file.
 *
 * @see Increase\Services\FilesService::create()
 *
 * @phpstan-type FileCreateParamsShape = array{
 *   file: string, purpose: Purpose|value-of<Purpose>, description?: string|null
 * }
 */
final class FileCreateParams implements BaseModel
{
    /** @use SdkModel<FileCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The file contents. This should follow the specifications of [RFC 7578](https://datatracker.ietf.org/doc/html/rfc7578) which defines file transfers for the multipart/form-data protocol.
     */
    #[Required]
    public string $file;

    /**
     * What the File will be used for in Increase's systems.
     *
     * @var value-of<Purpose> $purpose
     */
    #[Required(enum: Purpose::class)]
    public string $purpose;

    /**
     * The description you choose to give the File.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new FileCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileCreateParams::with(file: ..., purpose: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileCreateParams)->withFile(...)->withPurpose(...)
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
     *
     * @param Purpose|value-of<Purpose> $purpose
     */
    public static function with(
        string $file,
        Purpose|string $purpose,
        ?string $description = null
    ): self {
        $self = new self;

        $self['file'] = $file;
        $self['purpose'] = $purpose;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * The file contents. This should follow the specifications of [RFC 7578](https://datatracker.ietf.org/doc/html/rfc7578) which defines file transfers for the multipart/form-data protocol.
     */
    public function withFile(string $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }

    /**
     * What the File will be used for in Increase's systems.
     *
     * @param Purpose|value-of<Purpose> $purpose
     */
    public function withPurpose(Purpose|string $purpose): self
    {
        $self = clone $this;
        $self['purpose'] = $purpose;

        return $self;
    }

    /**
     * The description you choose to give the File.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
