<?php

declare(strict_types=1);

namespace Increase\Groups;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Groups\Group\Type;

/**
 * Groups represent organizations using Increase. You can retrieve information about your own organization via the API. More commonly, OAuth platforms can retrieve information about the organizations that have granted them access. Learn more about OAuth [here](https://increase.com/documentation/oauth).
 *
 * @phpstan-type GroupShape = array{
 *   id: string, createdAt: \DateTimeInterface, type: Type|value-of<Type>
 * }
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    /**
     * The Group identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Group was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A constant representing the object's type. For this resource it will always be `group`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Group()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Group::with(id: ..., createdAt: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Group)->withID(...)->withCreatedAt(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        Type|string $type
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Group identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Group was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `group`.
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
