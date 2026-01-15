<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CompellingEvidence\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Compelling evidence details. Present if and only if `reason` is `compelling_evidence`.
 *
 * @phpstan-type CompellingEvidenceShape = array{
 *   category: Category|value-of<Category>, explanation: string|null
 * }
 */
final class CompellingEvidence implements BaseModel
{
    /** @use SdkModel<CompellingEvidenceShape> */
    use SdkModel;

    /**
     * The category of compelling evidence provided by the merchant.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Explanation of the compelling evidence provided by the merchant.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new CompellingEvidence()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompellingEvidence::with(category: ..., explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompellingEvidence)->withCategory(...)->withExplanation(...)
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
    public static function with(
        Category|string $category,
        ?string $explanation
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The category of compelling evidence provided by the merchant.
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
     * Explanation of the compelling evidence provided by the merchant.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
