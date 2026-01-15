<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent;
use Increase\CardDisputes\CardDispute\Visa\RequiredUserSubmissionCategory;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Card Dispute information for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
 *
 * @phpstan-import-type NetworkEventShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent
 * @phpstan-import-type UserSubmissionShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission
 *
 * @phpstan-type VisaShape = array{
 *   networkEvents: list<NetworkEvent|NetworkEventShape>,
 *   requiredUserSubmissionCategory: null|RequiredUserSubmissionCategory|value-of<RequiredUserSubmissionCategory>,
 *   userSubmissions: list<UserSubmission|UserSubmissionShape>,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * The network events for the Card Dispute.
     *
     * @var list<NetworkEvent> $networkEvents
     */
    #[Required('network_events', list: NetworkEvent::class)]
    public array $networkEvents;

    /**
     * The category of the currently required user submission if the user wishes to proceed with the dispute. Present if and only if status is `user_submission_required`. Otherwise, this will be `nil`.
     *
     * @var value-of<RequiredUserSubmissionCategory>|null $requiredUserSubmissionCategory
     */
    #[Required(
        'required_user_submission_category',
        enum: RequiredUserSubmissionCategory::class,
    )]
    public ?string $requiredUserSubmissionCategory;

    /**
     * The user submissions for the Card Dispute.
     *
     * @var list<UserSubmission> $userSubmissions
     */
    #[Required('user_submissions', list: UserSubmission::class)]
    public array $userSubmissions;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(
     *   networkEvents: ..., requiredUserSubmissionCategory: ..., userSubmissions: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)
     *   ->withNetworkEvents(...)
     *   ->withRequiredUserSubmissionCategory(...)
     *   ->withUserSubmissions(...)
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
     * @param list<NetworkEvent|NetworkEventShape> $networkEvents
     * @param RequiredUserSubmissionCategory|value-of<RequiredUserSubmissionCategory>|null $requiredUserSubmissionCategory
     * @param list<UserSubmission|UserSubmissionShape> $userSubmissions
     */
    public static function with(
        array $networkEvents,
        RequiredUserSubmissionCategory|string|null $requiredUserSubmissionCategory,
        array $userSubmissions,
    ): self {
        $self = new self;

        $self['networkEvents'] = $networkEvents;
        $self['requiredUserSubmissionCategory'] = $requiredUserSubmissionCategory;
        $self['userSubmissions'] = $userSubmissions;

        return $self;
    }

    /**
     * The network events for the Card Dispute.
     *
     * @param list<NetworkEvent|NetworkEventShape> $networkEvents
     */
    public function withNetworkEvents(array $networkEvents): self
    {
        $self = clone $this;
        $self['networkEvents'] = $networkEvents;

        return $self;
    }

    /**
     * The category of the currently required user submission if the user wishes to proceed with the dispute. Present if and only if status is `user_submission_required`. Otherwise, this will be `nil`.
     *
     * @param RequiredUserSubmissionCategory|value-of<RequiredUserSubmissionCategory>|null $requiredUserSubmissionCategory
     */
    public function withRequiredUserSubmissionCategory(
        RequiredUserSubmissionCategory|string|null $requiredUserSubmissionCategory
    ): self {
        $self = clone $this;
        $self['requiredUserSubmissionCategory'] = $requiredUserSubmissionCategory;

        return $self;
    }

    /**
     * The user submissions for the Card Dispute.
     *
     * @param list<UserSubmission|UserSubmissionShape> $userSubmissions
     */
    public function withUserSubmissions(array $userSubmissions): self
    {
        $self = clone $this;
        $self['userSubmissions'] = $userSubmissions;

        return $self;
    }
}
