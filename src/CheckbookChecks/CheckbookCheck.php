<?php

declare(strict_types=1);

namespace Increase\CheckbookChecks;

use Increase\CheckbookChecks\CheckbookCheck\Status;
use Increase\CheckbookChecks\CheckbookCheck\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Checkbook Check is a single check within a Checkbook.
 *
 * @phpstan-type CheckbookCheckShape = array{
 *   id: string,
 *   checkNumber: int,
 *   checkbookID: string,
 *   createdAt: \DateTimeInterface,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class CheckbookCheck implements BaseModel
{
    /** @use SdkModel<CheckbookCheckShape> */
    use SdkModel;

    /**
     * The Checkbook Check's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The check number printed on the check.
     */
    #[Required('check_number')]
    public int $checkNumber;

    /**
     * The identifier of the Checkbook the check belongs to.
     */
    #[Required('checkbook_id')]
    public string $checkbookID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Checkbook Check was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The status of the Checkbook Check.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `checkbook_check`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CheckbookCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckbookCheck::with(
     *   id: ...,
     *   checkNumber: ...,
     *   checkbookID: ...,
     *   createdAt: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckbookCheck)
     *   ->withID(...)
     *   ->withCheckNumber(...)
     *   ->withCheckbookID(...)
     *   ->withCreatedAt(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $checkNumber,
        string $checkbookID,
        \DateTimeInterface $createdAt,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['checkNumber'] = $checkNumber;
        $self['checkbookID'] = $checkbookID;
        $self['createdAt'] = $createdAt;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Checkbook Check's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The check number printed on the check.
     */
    public function withCheckNumber(int $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

        return $self;
    }

    /**
     * The identifier of the Checkbook the check belongs to.
     */
    public function withCheckbookID(string $checkbookID): self
    {
        $self = clone $this;
        $self['checkbookID'] = $checkbookID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Checkbook Check was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The status of the Checkbook Check.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `checkbook_check`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
