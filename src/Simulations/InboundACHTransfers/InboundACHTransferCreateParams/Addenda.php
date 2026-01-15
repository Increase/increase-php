<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda\Category;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda\Freeform;

/**
 * Additional information to include in the transfer.
 *
 * @phpstan-import-type FreeformShape from \Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda\Freeform
 *
 * @phpstan-type AddendaShape = array{
 *   category: Category|value-of<Category>, freeform?: null|Freeform|FreeformShape
 * }
 */
final class Addenda implements BaseModel
{
    /** @use SdkModel<AddendaShape> */
    use SdkModel;

    /**
     * The type of addenda to simulate being sent with the transfer.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Unstructured `payment_related_information` passed through with the transfer.
     */
    #[Optional]
    public ?Freeform $freeform;

    /**
     * `new Addenda()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addenda::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Addenda)->withCategory(...)
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
     * @param Freeform|FreeformShape|null $freeform
     */
    public static function with(
        Category|string $category,
        Freeform|array|null $freeform = null
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $freeform && $self['freeform'] = $freeform;

        return $self;
    }

    /**
     * The type of addenda to simulate being sent with the transfer.
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
     * Unstructured `payment_related_information` passed through with the transfer.
     *
     * @param Freeform|FreeformShape $freeform
     */
    public function withFreeform(Freeform|array $freeform): self
    {
        $self = clone $this;
        $self['freeform'] = $freeform;

        return $self;
    }
}
