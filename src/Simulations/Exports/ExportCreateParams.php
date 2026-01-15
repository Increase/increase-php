<?php

declare(strict_types=1);

namespace Increase\Simulations\Exports;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\Exports\ExportCreateParams\Category;
use Increase\Simulations\Exports\ExportCreateParams\Form1099Int;

/**
 * Many exports are created by you via POST /exports or in the Dashboard. Some exports are created automatically by Increase. For example, tax documents are published once a year. In sandbox, you can trigger the arrival of an export that would normally only be created automatically via this simulation.
 *
 * @see Increase\Services\Simulations\ExportsService::create()
 *
 * @phpstan-import-type Form1099IntShape from \Increase\Simulations\Exports\ExportCreateParams\Form1099Int
 *
 * @phpstan-type ExportCreateParamsShape = array{
 *   category: Category|value-of<Category>,
 *   form1099Int?: null|Form1099Int|Form1099IntShape,
 * }
 */
final class ExportCreateParams implements BaseModel
{
    /** @use SdkModel<ExportCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The type of Export to create.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Options for the created export. Required if `category` is equal to `form_1099_int`.
     */
    #[Optional('form_1099_int')]
    public ?Form1099Int $form1099Int;

    /**
     * `new ExportCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportCreateParams::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportCreateParams)->withCategory(...)
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
     * @param Form1099Int|Form1099IntShape|null $form1099Int
     */
    public static function with(
        Category|string $category,
        Form1099Int|array|null $form1099Int = null
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $form1099Int && $self['form1099Int'] = $form1099Int;

        return $self;
    }

    /**
     * The type of Export to create.
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
     * Options for the created export. Required if `category` is equal to `form_1099_int`.
     *
     * @param Form1099Int|Form1099IntShape $form1099Int
     */
    public function withForm1099Int(Form1099Int|array $form1099Int): self
    {
        $self = clone $this;
        $self['form1099Int'] = $form1099Int;

        return $self;
    }
}
