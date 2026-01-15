<?php

declare(strict_types=1);

namespace Increase\CardDisputes;

use Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile;
use Increase\CardDisputes\CardDisputeCreateParams\Network;
use Increase\CardDisputes\CardDisputeCreateParams\Visa;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Card Dispute.
 *
 * @see Increase\Services\CardDisputesService::create()
 *
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa
 *
 * @phpstan-type CardDisputeCreateParamsShape = array{
 *   disputedTransactionID: string,
 *   network: Network|value-of<Network>,
 *   amount?: int|null,
 *   attachmentFiles?: list<AttachmentFile|AttachmentFileShape>|null,
 *   explanation?: string|null,
 *   visa?: null|Visa|VisaShape,
 * }
 */
final class CardDisputeCreateParams implements BaseModel
{
    /** @use SdkModel<CardDisputeCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Transaction you wish to dispute. This Transaction must have a `source_type` of `card_settlement`.
     */
    #[Required('disputed_transaction_id')]
    public string $disputedTransactionID;

    /**
     * The network of the disputed transaction. Details specific to the network are required under the sub-object with the same identifier as the network.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The monetary amount of the part of the transaction that is being disputed. This is optional and will default to the full amount of the transaction if not provided. If provided, the amount must be less than or equal to the amount of the transaction.
     */
    #[Optional]
    public ?int $amount;

    /**
     * The files to be attached to the initial dispute submission.
     *
     * @var list<AttachmentFile>|null $attachmentFiles
     */
    #[Optional('attachment_files', list: AttachmentFile::class)]
    public ?array $attachmentFiles;

    /**
     * The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     */
    #[Optional]
    public ?string $explanation;

    /**
     * The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
     */
    #[Optional]
    public ?Visa $visa;

    /**
     * `new CardDisputeCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeCreateParams::with(disputedTransactionID: ..., network: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeCreateParams)->withDisputedTransactionID(...)->withNetwork(...)
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
     * @param Network|value-of<Network> $network
     * @param list<AttachmentFile|AttachmentFileShape>|null $attachmentFiles
     * @param Visa|VisaShape|null $visa
     */
    public static function with(
        string $disputedTransactionID,
        Network|string $network,
        ?int $amount = null,
        ?array $attachmentFiles = null,
        ?string $explanation = null,
        Visa|array|null $visa = null,
    ): self {
        $self = new self;

        $self['disputedTransactionID'] = $disputedTransactionID;
        $self['network'] = $network;

        null !== $amount && $self['amount'] = $amount;
        null !== $attachmentFiles && $self['attachmentFiles'] = $attachmentFiles;
        null !== $explanation && $self['explanation'] = $explanation;
        null !== $visa && $self['visa'] = $visa;

        return $self;
    }

    /**
     * The Transaction you wish to dispute. This Transaction must have a `source_type` of `card_settlement`.
     */
    public function withDisputedTransactionID(
        string $disputedTransactionID
    ): self {
        $self = clone $this;
        $self['disputedTransactionID'] = $disputedTransactionID;

        return $self;
    }

    /**
     * The network of the disputed transaction. Details specific to the network are required under the sub-object with the same identifier as the network.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The monetary amount of the part of the transaction that is being disputed. This is optional and will default to the full amount of the transaction if not provided. If provided, the amount must be less than or equal to the amount of the transaction.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The files to be attached to the initial dispute submission.
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
     * The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
     *
     * @param Visa|VisaShape $visa
     */
    public function withVisa(Visa|array $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }
}
