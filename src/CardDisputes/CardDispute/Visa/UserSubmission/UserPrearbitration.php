<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\UserPrearbitration\CategoryChange;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Visa Card Dispute User-Initiated Pre-Arbitration User Submission object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration`. Contains the details specific to a user-initiated pre-arbitration Visa Card Dispute User Submission.
 *
 * @phpstan-import-type CategoryChangeShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\UserPrearbitration\CategoryChange
 *
 * @phpstan-type UserPrearbitrationShape = array{
 *   categoryChange: null|CategoryChange|CategoryChangeShape, reason: string
 * }
 */
final class UserPrearbitration implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationShape> */
    use SdkModel;

    /**
     * Category change details for the pre-arbitration request, if requested.
     */
    #[Required('category_change')]
    public ?CategoryChange $categoryChange;

    /**
     * The reason for the pre-arbitration request.
     */
    #[Required]
    public string $reason;

    /**
     * `new UserPrearbitration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserPrearbitration::with(categoryChange: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserPrearbitration)->withCategoryChange(...)->withReason(...)
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
        CategoryChange|array|null $categoryChange,
        string $reason
    ): self {
        $self = new self;

        $self['categoryChange'] = $categoryChange;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Category change details for the pre-arbitration request, if requested.
     *
     * @param CategoryChange|CategoryChangeShape|null $categoryChange
     */
    public function withCategoryChange(
        CategoryChange|array|null $categoryChange
    ): self {
        $self = clone $this;
        $self['categoryChange'] = $categoryChange;

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
}
