<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Corporation;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Corporation\LegalIdentifier\Category;

/**
 * The legal identifier of the corporation. This is usually the Employer Identification Number (EIN).
 *
 * @phpstan-type LegalIdentifierShape = array{
 *   value: string, category?: null|Category|value-of<Category>
 * }
 */
final class LegalIdentifier implements BaseModel
{
    /** @use SdkModel<LegalIdentifierShape> */
    use SdkModel;

    /**
     * The legal identifier. For US Employer Identification Numbers, submit nine digits with no dashes or other separators.
     */
    #[Required]
    public string $value;

    /**
     * The category of the legal identifier. If not provided, the default is `us_employer_identification_number`.
     *
     * @var value-of<Category>|null $category
     */
    #[Optional(enum: Category::class)]
    public ?string $category;

    /**
     * `new LegalIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LegalIdentifier::with(value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LegalIdentifier)->withValue(...)
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
     * @param Category|value-of<Category>|null $category
     */
    public static function with(
        string $value,
        Category|string|null $category = null
    ): self {
        $self = new self;

        $self['value'] = $value;

        null !== $category && $self['category'] = $category;

        return $self;
    }

    /**
     * The legal identifier. For US Employer Identification Numbers, submit nine digits with no dashes or other separators.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    /**
     * The category of the legal identifier. If not provided, the default is `us_employer_identification_number`.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }
}
