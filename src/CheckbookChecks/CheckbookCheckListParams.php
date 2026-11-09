<?php

declare(strict_types=1);

namespace Increase\CheckbookChecks;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Checkbook Checks.
 *
 * @see Increase\Services\CheckbookChecksService::list()
 *
 * @phpstan-type CheckbookCheckListParamsShape = array{
 *   accountNumberID?: string|null,
 *   checkNumber?: int|null,
 *   checkbookID?: string|null,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class CheckbookCheckListParams implements BaseModel
{
    /** @use SdkModel<CheckbookCheckListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Checkbook Checks to those drawn on the specified Account Number.
     */
    #[Optional]
    public ?string $accountNumberID;

    /**
     * Filter Checkbook Checks to the one with the specified check number.
     */
    #[Optional]
    public ?int $checkNumber;

    /**
     * Filter Checkbook Checks to those belonging to the specified Checkbook.
     */
    #[Optional]
    public ?string $checkbookID;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     */
    #[Optional]
    public ?int $limit;

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
        ?string $accountNumberID = null,
        ?int $checkNumber = null,
        ?string $checkbookID = null,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $accountNumberID && $self['accountNumberID'] = $accountNumberID;
        null !== $checkNumber && $self['checkNumber'] = $checkNumber;
        null !== $checkbookID && $self['checkbookID'] = $checkbookID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter Checkbook Checks to those drawn on the specified Account Number.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * Filter Checkbook Checks to the one with the specified check number.
     */
    public function withCheckNumber(int $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

        return $self;
    }

    /**
     * Filter Checkbook Checks to those belonging to the specified Checkbook.
     */
    public function withCheckbookID(string $checkbookID): self
    {
        $self = clone $this;
        $self['checkbookID'] = $checkbookID;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
