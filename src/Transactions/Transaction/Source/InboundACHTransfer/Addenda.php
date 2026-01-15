<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda\Category;
use Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda\Freeform;

/**
 * Additional information sent from the originator.
 *
 * @phpstan-import-type FreeformShape from \Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda\Freeform
 *
 * @phpstan-type AddendaShape = array{
 *   category: Category|value-of<Category>, freeform: null|Freeform|FreeformShape
 * }
 */
final class Addenda implements BaseModel
{
    /** @use SdkModel<AddendaShape> */
    use SdkModel;

    /**
     * The type of addendum.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Unstructured `payment_related_information` passed through by the originator.
     */
    #[Required]
    public ?Freeform $freeform;

    /**
     * `new Addenda()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addenda::with(category: ..., freeform: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Addenda)->withCategory(...)->withFreeform(...)
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
        Freeform|array|null $freeform
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['freeform'] = $freeform;

        return $self;
    }

    /**
     * The type of addendum.
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
     * Unstructured `payment_related_information` passed through by the originator.
     *
     * @param Freeform|FreeformShape|null $freeform
     */
    public function withFreeform(Freeform|array|null $freeform): self
    {
        $self = clone $this;
        $self['freeform'] = $freeform;

        return $self;
    }
}
