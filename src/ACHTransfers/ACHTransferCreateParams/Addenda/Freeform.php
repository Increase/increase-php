<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams\Addenda;

use Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Freeform\Entry;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Unstructured `payment_related_information` passed through with the transfer. Required if and only if `category` is `freeform`.
 *
 * @phpstan-import-type EntryShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Freeform\Entry
 *
 * @phpstan-type FreeformShape = array{entries: list<Entry|EntryShape>}
 */
final class Freeform implements BaseModel
{
    /** @use SdkModel<FreeformShape> */
    use SdkModel;

    /**
     * Each entry represents an addendum sent with the transfer. In general, you should send at most one addendum–most ACH recipients cannot access beyond the first 80 characters sent. Please reach out to [support@increase.com](mailto:support@increase.com) to send 2 or more addenda to a recipient expecting a specific addendum format.
     *
     * @var list<Entry> $entries
     */
    #[Required(list: Entry::class)]
    public array $entries;

    /**
     * `new Freeform()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Freeform::with(entries: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Freeform)->withEntries(...)
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
     * @param list<Entry|EntryShape> $entries
     */
    public static function with(array $entries): self
    {
        $self = new self;

        $self['entries'] = $entries;

        return $self;
    }

    /**
     * Each entry represents an addendum sent with the transfer. In general, you should send at most one addendum–most ACH recipients cannot access beyond the first 80 characters sent. Please reach out to [support@increase.com](mailto:support@increase.com) to send 2 or more addenda to a recipient expecting a specific addendum format.
     *
     * @param list<Entry|EntryShape> $entries
     */
    public function withEntries(array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }
}
