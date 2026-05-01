<?php

declare(strict_types=1);

namespace Increase\Simulations\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\Entities\EntityValidationParams\Issue;
use Increase\Simulations\Entities\EntityValidationParams\Status;

/**
 * Set the status for an [Entity's validation](/documentation/api/entities#entity-object.validation). In production, Know Your Customer validations [run automatically](/documentation/entity-validation#entity-validation). While developing, it can be helpful to override the behavior in Sandbox.
 *
 * @see Increase\Services\Simulations\EntitiesService::validation()
 *
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityValidationParams\Issue
 *
 * @phpstan-type EntityValidationParamsShape = array{
 *   issues: list<Issue|IssueShape>, status: Status|value-of<Status>
 * }
 */
final class EntityValidationParams implements BaseModel
{
    /** @use SdkModel<EntityValidationParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The issues to attach to the new managed compliance validation.
     *
     * @var list<Issue> $issues
     */
    #[Required(list: Issue::class)]
    public array $issues;

    /**
     * The status to set on the new managed compliance validation.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new EntityValidationParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityValidationParams::with(issues: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityValidationParams)->withIssues(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(array $issues, Status|string $status): self
    {
        $self = new self;

        $self['issues'] = $issues;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The issues to attach to the new managed compliance validation.
     *
     * @param list<Issue|IssueShape> $issues
     */
    public function withIssues(array $issues): self
    {
        $self = clone $this;
        $self['issues'] = $issues;

        return $self;
    }

    /**
     * The status to set on the new managed compliance validation.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
