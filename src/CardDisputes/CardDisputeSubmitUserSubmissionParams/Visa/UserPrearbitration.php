<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration\CategoryChange;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The user pre-arbitration details for the user submission. Required if and only if `category` is `user_prearbitration`.
 *
 * @phpstan-import-type CategoryChangeShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration\CategoryChange
 *
 * @phpstan-type UserPrearbitrationShape = array{
 *   reason: string, categoryChange?: null|CategoryChange|CategoryChangeShape
 * }
 */
final class UserPrearbitration implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationShape> */
    use SdkModel;

    /**
     * The reason for the pre-arbitration request.
     */
    #[Required]
    public string $reason;

    /**
     * Category change details for the pre-arbitration request. Should only be populated if the category of the dispute is being changed as part of the pre-arbitration request.
     */
    #[Optional('category_change')]
    public ?CategoryChange $categoryChange;

    /**
     * `new UserPrearbitration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserPrearbitration::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserPrearbitration)->withReason(...)
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
     * @param CategoryChange|CategoryChangeShape|null $categoryChange
     */
    public static function with(
        string $reason,
        CategoryChange|array|null $categoryChange = null
    ): self {
        $self = new self;

        $self['reason'] = $reason;

        null !== $categoryChange && $self['categoryChange'] = $categoryChange;

        return $self;
    }

    /**
     * The reason for the pre-arbitration request.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Category change details for the pre-arbitration request. Should only be populated if the category of the dispute is being changed as part of the pre-arbitration request.
     *
     * @param CategoryChange|CategoryChangeShape $categoryChange
     */
    public function withCategoryChange(
        CategoryChange|array $categoryChange
    ): self {
        $self = clone $this;
        $self['categoryChange'] = $categoryChange;

        return $self;
    }
}
