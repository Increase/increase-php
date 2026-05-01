<?php

declare(strict_types=1);

namespace Increase\Simulations\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\Entities\EntityUpdateValidationParams\Issue;

/**
 * Simulate updates to an [Entity's validation](/documentation/api/entities#entity-object.validation). In production, Know Your Customer validations [run automatically](/documentation/entity-validation#entity-validation) for eligible programs. While developing, use this API to simulate issues with information submissions.
 *
 * @see Increase\Services\Simulations\EntitiesService::updateValidation()
 *
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityUpdateValidationParams\Issue
 *
 * @phpstan-type EntityUpdateValidationParamsShape = array{
 *   issues: list<Issue|IssueShape>
 * }
 */
final class EntityUpdateValidationParams implements BaseModel
{
    /** @use SdkModel<EntityUpdateValidationParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The validation issues to attach. If no issues are provided, the validation status will be set to `valid`.
     *
     * @var list<Issue> $issues
     */
    #[Required(list: Issue::class)]
    public array $issues;

    /**
     * `new EntityUpdateValidationParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityUpdateValidationParams::with(issues: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityUpdateValidationParams)->withIssues(...)
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
     * @param list<Issue|IssueShape> $issues
     */
    public static function with(array $issues): self
    {
        $self = new self;

        $self['issues'] = $issues;

        return $self;
    }

    /**
     * The validation issues to attach. If no issues are provided, the validation status will be set to `valid`.
     *
     * @param list<Issue|IssueShape> $issues
     */
    public function withIssues(array $issues): self
    {
        $self = clone $this;
        $self['issues'] = $issues;

        return $self;
    }
}
