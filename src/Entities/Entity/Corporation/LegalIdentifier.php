<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Corporation\LegalIdentifier\Category;

/**
 * The legal identifier of the corporation.
 *
 * @phpstan-type LegalIdentifierShape = array{
 *   category: Category|value-of<Category>, value: string
 * }
 */
final class LegalIdentifier implements BaseModel
{
    /** @use SdkModel<LegalIdentifierShape> */
    use SdkModel;

    /**
     * The category of the legal identifier.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The identifier of the legal identifier.
     */
    #[Required]
    public string $value;

    /**
     * `new LegalIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LegalIdentifier::with(category: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LegalIdentifier)->withCategory(...)->withValue(...)
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
     */
    public static function with(Category|string $category, string $value): self
    {
        $self = new self;

        $self['category'] = $category;
        $self['value'] = $value;

        return $self;
    }

    /**
     * The category of the legal identifier.
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
     * The identifier of the legal identifier.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
