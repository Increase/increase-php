<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\AttachmentFile;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Category;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackAccepted;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackSubmitted;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackTimedOut;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationDeclineSubmitted;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationTimedOut;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\RepresentmentTimedOut;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationAccepted;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationDeclined;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationSubmitted;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationTimedOut;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserWithdrawalSubmitted;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\AttachmentFile
 * @phpstan-import-type ChargebackAcceptedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackAccepted
 * @phpstan-import-type ChargebackSubmittedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackSubmitted
 * @phpstan-import-type ChargebackTimedOutShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\ChargebackTimedOut
 * @phpstan-import-type MerchantPrearbitrationDeclineSubmittedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationDeclineSubmitted
 * @phpstan-import-type MerchantPrearbitrationReceivedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived
 * @phpstan-import-type MerchantPrearbitrationTimedOutShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationTimedOut
 * @phpstan-import-type RepresentedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented
 * @phpstan-import-type RepresentmentTimedOutShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\RepresentmentTimedOut
 * @phpstan-import-type UserPrearbitrationAcceptedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationAccepted
 * @phpstan-import-type UserPrearbitrationDeclinedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationDeclined
 * @phpstan-import-type UserPrearbitrationSubmittedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationSubmitted
 * @phpstan-import-type UserPrearbitrationTimedOutShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserPrearbitrationTimedOut
 * @phpstan-import-type UserWithdrawalSubmittedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\UserWithdrawalSubmitted
 *
 * @phpstan-type NetworkEventShape = array{
 *   attachmentFiles: list<AttachmentFile|AttachmentFileShape>,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   disputeFinancialTransactionID: string|null,
 *   chargebackAccepted?: null|ChargebackAccepted|ChargebackAcceptedShape,
 *   chargebackSubmitted?: null|ChargebackSubmitted|ChargebackSubmittedShape,
 *   chargebackTimedOut?: null|ChargebackTimedOut|ChargebackTimedOutShape,
 *   merchantPrearbitrationDeclineSubmitted?: null|MerchantPrearbitrationDeclineSubmitted|MerchantPrearbitrationDeclineSubmittedShape,
 *   merchantPrearbitrationReceived?: null|MerchantPrearbitrationReceived|MerchantPrearbitrationReceivedShape,
 *   merchantPrearbitrationTimedOut?: null|MerchantPrearbitrationTimedOut|MerchantPrearbitrationTimedOutShape,
 *   represented?: null|Represented|RepresentedShape,
 *   representmentTimedOut?: null|RepresentmentTimedOut|RepresentmentTimedOutShape,
 *   userPrearbitrationAccepted?: null|UserPrearbitrationAccepted|UserPrearbitrationAcceptedShape,
 *   userPrearbitrationDeclined?: null|UserPrearbitrationDeclined|UserPrearbitrationDeclinedShape,
 *   userPrearbitrationSubmitted?: null|UserPrearbitrationSubmitted|UserPrearbitrationSubmittedShape,
 *   userPrearbitrationTimedOut?: null|UserPrearbitrationTimedOut|UserPrearbitrationTimedOutShape,
 *   userWithdrawalSubmitted?: null|UserWithdrawalSubmitted|UserWithdrawalSubmittedShape,
 * }
 */
final class NetworkEvent implements BaseModel
{
    /** @use SdkModel<NetworkEventShape> */
    use SdkModel;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute Network Event was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The dispute financial transaction that resulted from the network event, if any.
     */
    #[Required('dispute_financial_transaction_id')]
    public ?string $disputeFinancialTransactionID;

    /**
     * A Card Dispute Chargeback Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_accepted`. Contains the details specific to a chargeback accepted Visa Card Dispute Network Event, which represents that a chargeback has been accepted by the merchant.
     */
    #[Optional('chargeback_accepted', nullable: true)]
    public ?ChargebackAccepted $chargebackAccepted;

    /**
     * A Card Dispute Chargeback Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_submitted`. Contains the details specific to a chargeback submitted Visa Card Dispute Network Event, which represents that a chargeback has been submitted to the network.
     */
    #[Optional('chargeback_submitted', nullable: true)]
    public ?ChargebackSubmitted $chargebackSubmitted;

    /**
     * A Card Dispute Chargeback Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_timed_out`. Contains the details specific to a chargeback timed out Visa Card Dispute Network Event, which represents that the chargeback has timed out in the user's favor.
     */
    #[Optional('chargeback_timed_out', nullable: true)]
    public ?ChargebackTimedOut $chargebackTimedOut;

    /**
     * A Card Dispute Merchant Pre-Arbitration Decline Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline_submitted`. Contains the details specific to a merchant prearbitration decline submitted Visa Card Dispute Network Event, which represents that the user has declined the merchant's request for a prearbitration request decision in their favor.
     */
    #[Optional('merchant_prearbitration_decline_submitted', nullable: true)]
    public ?MerchantPrearbitrationDeclineSubmitted $merchantPrearbitrationDeclineSubmitted;

    /**
     * A Card Dispute Merchant Pre-Arbitration Received Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_received`. Contains the details specific to a merchant prearbitration received Visa Card Dispute Network Event, which represents that the merchant has issued a prearbitration request in the user's favor.
     */
    #[Optional('merchant_prearbitration_received', nullable: true)]
    public ?MerchantPrearbitrationReceived $merchantPrearbitrationReceived;

    /**
     * A Card Dispute Merchant Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_timed_out`. Contains the details specific to a merchant prearbitration timed out Visa Card Dispute Network Event, which represents that the user has timed out responding to the merchant's prearbitration request.
     */
    #[Optional('merchant_prearbitration_timed_out', nullable: true)]
    public ?MerchantPrearbitrationTimedOut $merchantPrearbitrationTimedOut;

    /**
     * A Card Dispute Re-presented Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `represented`. Contains the details specific to a re-presented Visa Card Dispute Network Event, which represents that the merchant has declined the user's chargeback and has re-presented the payment.
     */
    #[Optional(nullable: true)]
    public ?Represented $represented;

    /**
     * A Card Dispute Re-presentment Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `representment_timed_out`. Contains the details specific to a re-presentment time-out Visa Card Dispute Network Event, which represents that the user did not respond to the re-presentment by the merchant within the time limit.
     */
    #[Optional('representment_timed_out', nullable: true)]
    public ?RepresentmentTimedOut $representmentTimedOut;

    /**
     * A Card Dispute User Pre-Arbitration Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_accepted`. Contains the details specific to a user prearbitration accepted Visa Card Dispute Network Event, which represents that the merchant has accepted the user's prearbitration request in the user's favor.
     */
    #[Optional('user_prearbitration_accepted', nullable: true)]
    public ?UserPrearbitrationAccepted $userPrearbitrationAccepted;

    /**
     * A Card Dispute User Pre-Arbitration Declined Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_declined`. Contains the details specific to a user prearbitration declined Visa Card Dispute Network Event, which represents that the merchant has declined the user's prearbitration request.
     */
    #[Optional('user_prearbitration_declined', nullable: true)]
    public ?UserPrearbitrationDeclined $userPrearbitrationDeclined;

    /**
     * A Card Dispute User Pre-Arbitration Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_submitted`. Contains the details specific to a user prearbitration submitted Visa Card Dispute Network Event, which represents that the user's request for prearbitration has been submitted to the network.
     */
    #[Optional('user_prearbitration_submitted', nullable: true)]
    public ?UserPrearbitrationSubmitted $userPrearbitrationSubmitted;

    /**
     * A Card Dispute User Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_timed_out`. Contains the details specific to a user prearbitration timed out Visa Card Dispute Network Event, which represents that the merchant has timed out responding to the user's prearbitration request.
     */
    #[Optional('user_prearbitration_timed_out', nullable: true)]
    public ?UserPrearbitrationTimedOut $userPrearbitrationTimedOut;

    /**
     * A Card Dispute User Withdrawal Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_withdrawal_submitted`. Contains the details specific to a user withdrawal submitted Visa Card Dispute Network Event, which represents that the user's request to withdraw the dispute has been submitted to the network.
     */
    #[Optional('user_withdrawal_submitted', nullable: true)]
    public ?UserWithdrawalSubmitted $userWithdrawalSubmitted;

    /**
     * `new NetworkEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NetworkEvent::with(
     *   attachmentFiles: ...,
     *   category: ...,
     *   createdAt: ...,
     *   disputeFinancialTransactionID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NetworkEvent)
     *   ->withAttachmentFiles(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withDisputeFinancialTransactionID(...)
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
     * @param ChargebackAccepted|ChargebackAcceptedShape|null $chargebackAccepted
     * @param ChargebackSubmitted|ChargebackSubmittedShape|null $chargebackSubmitted
     * @param ChargebackTimedOut|ChargebackTimedOutShape|null $chargebackTimedOut
     * @param MerchantPrearbitrationDeclineSubmitted|MerchantPrearbitrationDeclineSubmittedShape|null $merchantPrearbitrationDeclineSubmitted
     * @param MerchantPrearbitrationReceived|MerchantPrearbitrationReceivedShape|null $merchantPrearbitrationReceived
     * @param MerchantPrearbitrationTimedOut|MerchantPrearbitrationTimedOutShape|null $merchantPrearbitrationTimedOut
     * @param Represented|RepresentedShape|null $represented
     * @param RepresentmentTimedOut|RepresentmentTimedOutShape|null $representmentTimedOut
     * @param UserPrearbitrationAccepted|UserPrearbitrationAcceptedShape|null $userPrearbitrationAccepted
     * @param UserPrearbitrationDeclined|UserPrearbitrationDeclinedShape|null $userPrearbitrationDeclined
     * @param UserPrearbitrationSubmitted|UserPrearbitrationSubmittedShape|null $userPrearbitrationSubmitted
     * @param UserPrearbitrationTimedOut|UserPrearbitrationTimedOutShape|null $userPrearbitrationTimedOut
     * @param UserWithdrawalSubmitted|UserWithdrawalSubmittedShape|null $userWithdrawalSubmitted
     */
    public static function with(
        array $attachmentFiles,
        Category|string $category,
        \DateTimeInterface $createdAt,
        ?string $disputeFinancialTransactionID,
        ChargebackAccepted|array|null $chargebackAccepted = null,
        ChargebackSubmitted|array|null $chargebackSubmitted = null,
        ChargebackTimedOut|array|null $chargebackTimedOut = null,
        MerchantPrearbitrationDeclineSubmitted|array|null $merchantPrearbitrationDeclineSubmitted = null,
        MerchantPrearbitrationReceived|array|null $merchantPrearbitrationReceived = null,
        MerchantPrearbitrationTimedOut|array|null $merchantPrearbitrationTimedOut = null,
        Represented|array|null $represented = null,
        RepresentmentTimedOut|array|null $representmentTimedOut = null,
        UserPrearbitrationAccepted|array|null $userPrearbitrationAccepted = null,
        UserPrearbitrationDeclined|array|null $userPrearbitrationDeclined = null,
        UserPrearbitrationSubmitted|array|null $userPrearbitrationSubmitted = null,
        UserPrearbitrationTimedOut|array|null $userPrearbitrationTimedOut = null,
        UserWithdrawalSubmitted|array|null $userWithdrawalSubmitted = null,
    ): self {
        $self = new self;

        $self['attachmentFiles'] = $attachmentFiles;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['disputeFinancialTransactionID'] = $disputeFinancialTransactionID;

        null !== $chargebackAccepted && $self['chargebackAccepted'] = $chargebackAccepted;
        null !== $chargebackSubmitted && $self['chargebackSubmitted'] = $chargebackSubmitted;
        null !== $chargebackTimedOut && $self['chargebackTimedOut'] = $chargebackTimedOut;
        null !== $merchantPrearbitrationDeclineSubmitted && $self['merchantPrearbitrationDeclineSubmitted'] = $merchantPrearbitrationDeclineSubmitted;
        null !== $merchantPrearbitrationReceived && $self['merchantPrearbitrationReceived'] = $merchantPrearbitrationReceived;
        null !== $merchantPrearbitrationTimedOut && $self['merchantPrearbitrationTimedOut'] = $merchantPrearbitrationTimedOut;
        null !== $represented && $self['represented'] = $represented;
        null !== $representmentTimedOut && $self['representmentTimedOut'] = $representmentTimedOut;
        null !== $userPrearbitrationAccepted && $self['userPrearbitrationAccepted'] = $userPrearbitrationAccepted;
        null !== $userPrearbitrationDeclined && $self['userPrearbitrationDeclined'] = $userPrearbitrationDeclined;
        null !== $userPrearbitrationSubmitted && $self['userPrearbitrationSubmitted'] = $userPrearbitrationSubmitted;
        null !== $userPrearbitrationTimedOut && $self['userPrearbitrationTimedOut'] = $userPrearbitrationTimedOut;
        null !== $userWithdrawalSubmitted && $self['userWithdrawalSubmitted'] = $userWithdrawalSubmitted;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Visa Card Dispute Network Event was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The dispute financial transaction that resulted from the network event, if any.
     */
    public function withDisputeFinancialTransactionID(
        ?string $disputeFinancialTransactionID
    ): self {
        $self = clone $this;
        $self['disputeFinancialTransactionID'] = $disputeFinancialTransactionID;

        return $self;
    }

    /**
     * A Card Dispute Chargeback Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_accepted`. Contains the details specific to a chargeback accepted Visa Card Dispute Network Event, which represents that a chargeback has been accepted by the merchant.
     *
     * @param ChargebackAccepted|ChargebackAcceptedShape|null $chargebackAccepted
     */
    public function withChargebackAccepted(
        ChargebackAccepted|array|null $chargebackAccepted
    ): self {
        $self = clone $this;
        $self['chargebackAccepted'] = $chargebackAccepted;

        return $self;
    }

    /**
     * A Card Dispute Chargeback Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_submitted`. Contains the details specific to a chargeback submitted Visa Card Dispute Network Event, which represents that a chargeback has been submitted to the network.
     *
     * @param ChargebackSubmitted|ChargebackSubmittedShape|null $chargebackSubmitted
     */
    public function withChargebackSubmitted(
        ChargebackSubmitted|array|null $chargebackSubmitted
    ): self {
        $self = clone $this;
        $self['chargebackSubmitted'] = $chargebackSubmitted;

        return $self;
    }

    /**
     * A Card Dispute Chargeback Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_timed_out`. Contains the details specific to a chargeback timed out Visa Card Dispute Network Event, which represents that the chargeback has timed out in the user's favor.
     *
     * @param ChargebackTimedOut|ChargebackTimedOutShape|null $chargebackTimedOut
     */
    public function withChargebackTimedOut(
        ChargebackTimedOut|array|null $chargebackTimedOut
    ): self {
        $self = clone $this;
        $self['chargebackTimedOut'] = $chargebackTimedOut;

        return $self;
    }

    /**
     * A Card Dispute Merchant Pre-Arbitration Decline Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline_submitted`. Contains the details specific to a merchant prearbitration decline submitted Visa Card Dispute Network Event, which represents that the user has declined the merchant's request for a prearbitration request decision in their favor.
     *
     * @param MerchantPrearbitrationDeclineSubmitted|MerchantPrearbitrationDeclineSubmittedShape|null $merchantPrearbitrationDeclineSubmitted
     */
    public function withMerchantPrearbitrationDeclineSubmitted(
        MerchantPrearbitrationDeclineSubmitted|array|null $merchantPrearbitrationDeclineSubmitted,
    ): self {
        $self = clone $this;
        $self['merchantPrearbitrationDeclineSubmitted'] = $merchantPrearbitrationDeclineSubmitted;

        return $self;
    }

    /**
     * A Card Dispute Merchant Pre-Arbitration Received Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_received`. Contains the details specific to a merchant prearbitration received Visa Card Dispute Network Event, which represents that the merchant has issued a prearbitration request in the user's favor.
     *
     * @param MerchantPrearbitrationReceived|MerchantPrearbitrationReceivedShape|null $merchantPrearbitrationReceived
     */
    public function withMerchantPrearbitrationReceived(
        MerchantPrearbitrationReceived|array|null $merchantPrearbitrationReceived
    ): self {
        $self = clone $this;
        $self['merchantPrearbitrationReceived'] = $merchantPrearbitrationReceived;

        return $self;
    }

    /**
     * A Card Dispute Merchant Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_timed_out`. Contains the details specific to a merchant prearbitration timed out Visa Card Dispute Network Event, which represents that the user has timed out responding to the merchant's prearbitration request.
     *
     * @param MerchantPrearbitrationTimedOut|MerchantPrearbitrationTimedOutShape|null $merchantPrearbitrationTimedOut
     */
    public function withMerchantPrearbitrationTimedOut(
        MerchantPrearbitrationTimedOut|array|null $merchantPrearbitrationTimedOut
    ): self {
        $self = clone $this;
        $self['merchantPrearbitrationTimedOut'] = $merchantPrearbitrationTimedOut;

        return $self;
    }

    /**
     * A Card Dispute Re-presented Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `represented`. Contains the details specific to a re-presented Visa Card Dispute Network Event, which represents that the merchant has declined the user's chargeback and has re-presented the payment.
     *
     * @param Represented|RepresentedShape|null $represented
     */
    public function withRepresented(Represented|array|null $represented): self
    {
        $self = clone $this;
        $self['represented'] = $represented;

        return $self;
    }

    /**
     * A Card Dispute Re-presentment Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `representment_timed_out`. Contains the details specific to a re-presentment time-out Visa Card Dispute Network Event, which represents that the user did not respond to the re-presentment by the merchant within the time limit.
     *
     * @param RepresentmentTimedOut|RepresentmentTimedOutShape|null $representmentTimedOut
     */
    public function withRepresentmentTimedOut(
        RepresentmentTimedOut|array|null $representmentTimedOut
    ): self {
        $self = clone $this;
        $self['representmentTimedOut'] = $representmentTimedOut;

        return $self;
    }

    /**
     * A Card Dispute User Pre-Arbitration Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_accepted`. Contains the details specific to a user prearbitration accepted Visa Card Dispute Network Event, which represents that the merchant has accepted the user's prearbitration request in the user's favor.
     *
     * @param UserPrearbitrationAccepted|UserPrearbitrationAcceptedShape|null $userPrearbitrationAccepted
     */
    public function withUserPrearbitrationAccepted(
        UserPrearbitrationAccepted|array|null $userPrearbitrationAccepted
    ): self {
        $self = clone $this;
        $self['userPrearbitrationAccepted'] = $userPrearbitrationAccepted;

        return $self;
    }

    /**
     * A Card Dispute User Pre-Arbitration Declined Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_declined`. Contains the details specific to a user prearbitration declined Visa Card Dispute Network Event, which represents that the merchant has declined the user's prearbitration request.
     *
     * @param UserPrearbitrationDeclined|UserPrearbitrationDeclinedShape|null $userPrearbitrationDeclined
     */
    public function withUserPrearbitrationDeclined(
        UserPrearbitrationDeclined|array|null $userPrearbitrationDeclined
    ): self {
        $self = clone $this;
        $self['userPrearbitrationDeclined'] = $userPrearbitrationDeclined;

        return $self;
    }

    /**
     * A Card Dispute User Pre-Arbitration Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_submitted`. Contains the details specific to a user prearbitration submitted Visa Card Dispute Network Event, which represents that the user's request for prearbitration has been submitted to the network.
     *
     * @param UserPrearbitrationSubmitted|UserPrearbitrationSubmittedShape|null $userPrearbitrationSubmitted
     */
    public function withUserPrearbitrationSubmitted(
        UserPrearbitrationSubmitted|array|null $userPrearbitrationSubmitted
    ): self {
        $self = clone $this;
        $self['userPrearbitrationSubmitted'] = $userPrearbitrationSubmitted;

        return $self;
    }

    /**
     * A Card Dispute User Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_timed_out`. Contains the details specific to a user prearbitration timed out Visa Card Dispute Network Event, which represents that the merchant has timed out responding to the user's prearbitration request.
     *
     * @param UserPrearbitrationTimedOut|UserPrearbitrationTimedOutShape|null $userPrearbitrationTimedOut
     */
    public function withUserPrearbitrationTimedOut(
        UserPrearbitrationTimedOut|array|null $userPrearbitrationTimedOut
    ): self {
        $self = clone $this;
        $self['userPrearbitrationTimedOut'] = $userPrearbitrationTimedOut;

        return $self;
    }

    /**
     * A Card Dispute User Withdrawal Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_withdrawal_submitted`. Contains the details specific to a user withdrawal submitted Visa Card Dispute Network Event, which represents that the user's request to withdraw the dispute has been submitted to the network.
     *
     * @param UserWithdrawalSubmitted|UserWithdrawalSubmittedShape|null $userWithdrawalSubmitted
     */
    public function withUserWithdrawalSubmitted(
        UserWithdrawalSubmitted|array|null $userWithdrawalSubmitted
    ): self {
        $self = clone $this;
        $self['userWithdrawalSubmitted'] = $userWithdrawalSubmitted;

        return $self;
    }
}
