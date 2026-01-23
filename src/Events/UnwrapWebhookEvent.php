<?php

declare(strict_types=1);

namespace Increase\Events;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Events\UnwrapWebhookEvent\Category;
use Increase\Events\UnwrapWebhookEvent\Type;

/**
 * Events are records of things that happened to objects at Increase. Events are accessible via the List Events endpoint and can be delivered to your application via webhooks. For more information, see our [webhooks guide](https://increase.com/documentation/webhooks).
 *
 * @phpstan-type UnwrapWebhookEventShape = array{
 *   id: string,
 *   associatedObjectID: string,
 *   associatedObjectType: string,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class UnwrapWebhookEvent implements BaseModel
{
    /** @use SdkModel<UnwrapWebhookEventShape> */
    use SdkModel;

    /**
     * The Event identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the object that generated this Event.
     */
    #[Required('associated_object_id')]
    public string $associatedObjectID;

    /**
     * The type of the object that generated this Event.
     */
    #[Required('associated_object_type')]
    public string $associatedObjectType;

    /**
     * The category of the Event. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The time the Event was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A constant representing the object's type. For this resource it will always be `event`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new UnwrapWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnwrapWebhookEvent::with(
     *   id: ...,
     *   associatedObjectID: ...,
     *   associatedObjectType: ...,
     *   category: ...,
     *   createdAt: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnwrapWebhookEvent)
     *   ->withID(...)
     *   ->withAssociatedObjectID(...)
     *   ->withAssociatedObjectType(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
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
     * @param Category|value-of<Category> $category
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $associatedObjectID,
        string $associatedObjectType,
        Category|string $category,
        \DateTimeInterface $createdAt,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['associatedObjectID'] = $associatedObjectID;
        $self['associatedObjectType'] = $associatedObjectType;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Event identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the object that generated this Event.
     */
    public function withAssociatedObjectID(string $associatedObjectID): self
    {
        $self = clone $this;
        $self['associatedObjectID'] = $associatedObjectID;

        return $self;
    }

    /**
     * The type of the object that generated this Event.
     */
    public function withAssociatedObjectType(string $associatedObjectType): self
    {
        $self = clone $this;
        $self['associatedObjectType'] = $associatedObjectType;

        return $self;
    }

    /**
     * The category of the Event. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The time the Event was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `event`.
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
