<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Validation\Issue;
use Increase\Entities\Entity\Validation\Status;

/**
 * The validation results for the entity.
 *
 * @phpstan-import-type IssueShape from \Increase\Entities\Entity\Validation\Issue
 *
 * @phpstan-type ValidationShape = array{
 *   issues: list<Issue|IssueShape>,
 *   status: \Increase\Entities\Entity\Validation\Status|value-of<\Increase\Entities\Entity\Validation\Status>,
 * }
 */
final class Validation implements BaseModel
{
    /** @use SdkModel<ValidationShape> */
    use SdkModel;

    /**
     * The list of issues that need to be addressed.
     *
     * @var list<Issue> $issues
     */
    #[Required(list: Issue::class)]
    public array $issues;

    /**
     * The validation status for the entity. If the status is `invalid`, the `issues` array will be populated.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new Validation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Validation::with(issues: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Validation)->withIssues(...)->withStatus(...)
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
    public static function with(
        array $issues,
        Status|string $status
    ): self {
        $self = new self;

        $self['issues'] = $issues;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The list of issues that need to be addressed.
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
     * The validation status for the entity. If the status is `invalid`, the `issues` array will be populated.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
