<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\AttachmentFile;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Category;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\MerchantPrearbitrationDecline;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Status;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\UserPrearbitration;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\AttachmentFile
 * @phpstan-import-type ChargebackShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback
 * @phpstan-import-type MerchantPrearbitrationDeclineShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\MerchantPrearbitrationDecline
 * @phpstan-import-type UserPrearbitrationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\UserPrearbitration
 *
 * @phpstan-type UserSubmissionShape = array{
 *   acceptedAt: \DateTimeInterface|null,
 *   amount: int|null,
 *   attachmentFiles: list<AttachmentFile|AttachmentFileShape>,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   explanation: string|null,
 *   furtherInformationRequestedAt: \DateTimeInterface|null,
 *   furtherInformationRequestedReason: string|null,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   chargeback?: null|Chargeback|ChargebackShape,
 *   merchantPrearbitrationDecline?: null|MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape,
 *   userPrearbitration?: null|UserPrearbitration|UserPrearbitrationShape,
 * }
 */
final class UserSubmission implements BaseModel
{
    /** @use SdkModel<UserSubmissionShape> */
    use SdkModel;

    /**
     * The date and time at which the Visa Card Dispute User Submission was reviewed and accepted.
     */
    #[Required('accepted_at')]
    public ?\DateTimeInterface $acceptedAt;

    /**
     * The amount of the dispute if it is different from the amount of a prior user submission or the disputed transaction.
     */
    #[Required]
    public ?int $amount;

    /**
     * The files attached to the Visa Card Dispute User Submission.
     *
     * @var list<AttachmentFile> $attachmentFiles
     */
    #[Required('attachment_files', list: AttachmentFile::class)]
    public array $attachmentFiles;

    /**
     * The category of the user submission. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute User Submission was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     */
    #[Required]
    public ?string $explanation;

    /**
     * The date and time at which Increase requested further information from the user for the Visa Card Dispute.
     */
    #[Required('further_information_requested_at')]
    public ?\DateTimeInterface $furtherInformationRequestedAt;

    /**
     * The reason for Increase requesting further information from the user for the Visa Card Dispute.
     */
    #[Required('further_information_requested_reason')]
    public ?string $furtherInformationRequestedReason;

    /**
     * The status of the Visa Card Dispute User Submission.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute User Submission was updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * A Visa Card Dispute Chargeback User Submission Chargeback Details object. This field will be present in the JSON response if and only if `category` is equal to `chargeback`. Contains the details specific to a Visa chargeback User Submission for a Card Dispute.
     */
    #[Optional(nullable: true)]
    public ?Chargeback $chargeback;

    /**
     * A Visa Card Dispute Merchant Pre-Arbitration Decline User Submission object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline`. Contains the details specific to a merchant prearbitration decline Visa Card Dispute User Submission.
     */
    #[Optional('merchant_prearbitration_decline', nullable: true)]
    public ?MerchantPrearbitrationDecline $merchantPrearbitrationDecline;

    /**
     * A Visa Card Dispute User-Initiated Pre-Arbitration User Submission object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration`. Contains the details specific to a user-initiated pre-arbitration Visa Card Dispute User Submission.
     */
    #[Optional('user_prearbitration', nullable: true)]
    public ?UserPrearbitration $userPrearbitration;

    /**
     * `new UserSubmission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserSubmission::with(
     *   acceptedAt: ...,
     *   amount: ...,
     *   attachmentFiles: ...,
     *   category: ...,
     *   createdAt: ...,
     *   explanation: ...,
     *   furtherInformationRequestedAt: ...,
     *   furtherInformationRequestedReason: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserSubmission)
     *   ->withAcceptedAt(...)
     *   ->withAmount(...)
     *   ->withAttachmentFiles(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withExplanation(...)
     *   ->withFurtherInformationRequestedAt(...)
     *   ->withFurtherInformationRequestedReason(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
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
     * @param list<AttachmentFile|AttachmentFileShape> $attachmentFiles
     * @param Category|value-of<Category> $category
     * @param Status|value-of<Status> $status
     * @param Chargeback|ChargebackShape|null $chargeback
     * @param MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape|null $merchantPrearbitrationDecline
     * @param UserPrearbitration|UserPrearbitrationShape|null $userPrearbitration
     */
    public static function with(
        ?\DateTimeInterface $acceptedAt,
        ?int $amount,
        array $attachmentFiles,
        Category|string $category,
        \DateTimeInterface $createdAt,
        ?string $explanation,
        ?\DateTimeInterface $furtherInformationRequestedAt,
        ?string $furtherInformationRequestedReason,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        Chargeback|array|null $chargeback = null,
        MerchantPrearbitrationDecline|array|null $merchantPrearbitrationDecline = null,
        UserPrearbitration|array|null $userPrearbitration = null,
    ): self {
        $self = new self;

        $self['acceptedAt'] = $acceptedAt;
        $self['amount'] = $amount;
        $self['attachmentFiles'] = $attachmentFiles;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['explanation'] = $explanation;
        $self['furtherInformationRequestedAt'] = $furtherInformationRequestedAt;
        $self['furtherInformationRequestedReason'] = $furtherInformationRequestedReason;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        null !== $chargeback && $self['chargeback'] = $chargeback;
        null !== $merchantPrearbitrationDecline && $self['merchantPrearbitrationDecline'] = $merchantPrearbitrationDecline;
        null !== $userPrearbitration && $self['userPrearbitration'] = $userPrearbitration;

        return $self;
    }

    /**
     * The date and time at which the Visa Card Dispute User Submission was reviewed and accepted.
     */
    public function withAcceptedAt(?\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The amount of the dispute if it is different from the amount of a prior user submission or the disputed transaction.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The files attached to the Visa Card Dispute User Submission.
     *
     * @param list<AttachmentFile|AttachmentFileShape> $attachmentFiles
     */
    public function withAttachmentFiles(array $attachmentFiles): self
    {
        $self = clone $this;
        $self['attachmentFiles'] = $attachmentFiles;

        return $self;
    }

    /**
     * The category of the user submission. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute User Submission was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The date and time at which Increase requested further information from the user for the Visa Card Dispute.
     */
    public function withFurtherInformationRequestedAt(
        ?\DateTimeInterface $furtherInformationRequestedAt
    ): self {
        $self = clone $this;
        $self['furtherInformationRequestedAt'] = $furtherInformationRequestedAt;

        return $self;
    }

    /**
     * The reason for Increase requesting further information from the user for the Visa Card Dispute.
     */
    public function withFurtherInformationRequestedReason(
        ?string $furtherInformationRequestedReason
    ): self {
        $self = clone $this;
        $self['furtherInformationRequestedReason'] = $furtherInformationRequestedReason;

        return $self;
    }

    /**
     * The status of the Visa Card Dispute User Submission.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute User Submission was updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * A Visa Card Dispute Chargeback User Submission Chargeback Details object. This field will be present in the JSON response if and only if `category` is equal to `chargeback`. Contains the details specific to a Visa chargeback User Submission for a Card Dispute.
     *
     * @param Chargeback|ChargebackShape|null $chargeback
     */
    public function withChargeback(Chargeback|array|null $chargeback): self
    {
        $self = clone $this;
        $self['chargeback'] = $chargeback;

        return $self;
    }

    /**
     * A Visa Card Dispute Merchant Pre-Arbitration Decline User Submission object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline`. Contains the details specific to a merchant prearbitration decline Visa Card Dispute User Submission.
     *
     * @param MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape|null $merchantPrearbitrationDecline
     */
    public function withMerchantPrearbitrationDecline(
        MerchantPrearbitrationDecline|array|null $merchantPrearbitrationDecline
    ): self {
        $self = clone $this;
        $self['merchantPrearbitrationDecline'] = $merchantPrearbitrationDecline;

        return $self;
    }

    /**
     * A Visa Card Dispute User-Initiated Pre-Arbitration User Submission object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration`. Contains the details specific to a user-initiated pre-arbitration Visa Card Dispute User Submission.
     *
     * @param UserPrearbitration|UserPrearbitrationShape|null $userPrearbitration
     */
    public function withUserPrearbitration(
        UserPrearbitration|array|null $userPrearbitration
    ): self {
        $self = clone $this;
        $self['userPrearbitration'] = $userPrearbitration;

        return $self;
    }
}
