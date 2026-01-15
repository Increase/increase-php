<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\MailingAddress;
use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\Payer;
use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\ReturnAddress;
use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\ShippingMethod;
use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\TrackingUpdate;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details relating to the physical check that Increase will print and mail. Will be present if and only if `fulfillment_method` is equal to `physical_check`.
 *
 * @phpstan-import-type MailingAddressShape from \Increase\CheckTransfers\CheckTransfer\PhysicalCheck\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\CheckTransfers\CheckTransfer\PhysicalCheck\Payer
 * @phpstan-import-type ReturnAddressShape from \Increase\CheckTransfers\CheckTransfer\PhysicalCheck\ReturnAddress
 * @phpstan-import-type TrackingUpdateShape from \Increase\CheckTransfers\CheckTransfer\PhysicalCheck\TrackingUpdate
 *
 * @phpstan-type PhysicalCheckShape = array{
 *   attachmentFileID: string|null,
 *   checkVoucherImageFileID: string|null,
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   memo: string|null,
 *   note: string|null,
 *   payer: list<Payer|PayerShape>,
 *   recipientName: string,
 *   returnAddress: null|ReturnAddress|ReturnAddressShape,
 *   shippingMethod: null|ShippingMethod|value-of<ShippingMethod>,
 *   signatureText: string|null,
 *   trackingUpdates: list<TrackingUpdate|TrackingUpdateShape>,
 * }
 */
final class PhysicalCheck implements BaseModel
{
    /** @use SdkModel<PhysicalCheckShape> */
    use SdkModel;

    /**
     * The ID of the file for the check attachment.
     */
    #[Required('attachment_file_id')]
    public ?string $attachmentFileID;

    /**
     * The ID of the file for the check voucher image.
     */
    #[Required('check_voucher_image_file_id')]
    public ?string $checkVoucherImageFileID;

    /**
     * Details for where Increase will mail the check.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * The descriptor that will be printed on the memo field on the check.
     */
    #[Required]
    public ?string $memo;

    /**
     * The descriptor that will be printed on the letter included with the check.
     */
    #[Required]
    public ?string $note;

    /**
     * The payer of the check. This will be printed on the top-left portion of the check and defaults to the return address if unspecified.
     *
     * @var list<Payer> $payer
     */
    #[Required(list: Payer::class)]
    public array $payer;

    /**
     * The name that will be printed on the check.
     */
    #[Required('recipient_name')]
    public string $recipientName;

    /**
     * The return address to be printed on the check.
     */
    #[Required('return_address')]
    public ?ReturnAddress $returnAddress;

    /**
     * The shipping method for the check.
     *
     * @var value-of<ShippingMethod>|null $shippingMethod
     */
    #[Required('shipping_method', enum: ShippingMethod::class)]
    public ?string $shippingMethod;

    /**
     * The text that will appear as the signature on the check in cursive font. If blank, the check will be printed with 'No signature required'.
     */
    #[Required('signature_text')]
    public ?string $signatureText;

    /**
     * Tracking updates relating to the physical check's delivery.
     *
     * @var list<TrackingUpdate> $trackingUpdates
     */
    #[Required('tracking_updates', list: TrackingUpdate::class)]
    public array $trackingUpdates;

    /**
     * `new PhysicalCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCheck::with(
     *   attachmentFileID: ...,
     *   checkVoucherImageFileID: ...,
     *   mailingAddress: ...,
     *   memo: ...,
     *   note: ...,
     *   payer: ...,
     *   recipientName: ...,
     *   returnAddress: ...,
     *   shippingMethod: ...,
     *   signatureText: ...,
     *   trackingUpdates: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCheck)
     *   ->withAttachmentFileID(...)
     *   ->withCheckVoucherImageFileID(...)
     *   ->withMailingAddress(...)
     *   ->withMemo(...)
     *   ->withNote(...)
     *   ->withPayer(...)
     *   ->withRecipientName(...)
     *   ->withReturnAddress(...)
     *   ->withShippingMethod(...)
     *   ->withSignatureText(...)
     *   ->withTrackingUpdates(...)
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
     * @param MailingAddress|MailingAddressShape $mailingAddress
     * @param list<Payer|PayerShape> $payer
     * @param ReturnAddress|ReturnAddressShape|null $returnAddress
     * @param ShippingMethod|value-of<ShippingMethod>|null $shippingMethod
     * @param list<TrackingUpdate|TrackingUpdateShape> $trackingUpdates
     */
    public static function with(
        ?string $attachmentFileID,
        ?string $checkVoucherImageFileID,
        MailingAddress|array $mailingAddress,
        ?string $memo,
        ?string $note,
        array $payer,
        string $recipientName,
        ReturnAddress|array|null $returnAddress,
        ShippingMethod|string|null $shippingMethod,
        ?string $signatureText,
        array $trackingUpdates,
    ): self {
        $self = new self;

        $self['attachmentFileID'] = $attachmentFileID;
        $self['checkVoucherImageFileID'] = $checkVoucherImageFileID;
        $self['mailingAddress'] = $mailingAddress;
        $self['memo'] = $memo;
        $self['note'] = $note;
        $self['payer'] = $payer;
        $self['recipientName'] = $recipientName;
        $self['returnAddress'] = $returnAddress;
        $self['shippingMethod'] = $shippingMethod;
        $self['signatureText'] = $signatureText;
        $self['trackingUpdates'] = $trackingUpdates;

        return $self;
    }

    /**
     * The ID of the file for the check attachment.
     */
    public function withAttachmentFileID(?string $attachmentFileID): self
    {
        $self = clone $this;
        $self['attachmentFileID'] = $attachmentFileID;

        return $self;
    }

    /**
     * The ID of the file for the check voucher image.
     */
    public function withCheckVoucherImageFileID(
        ?string $checkVoucherImageFileID
    ): self {
        $self = clone $this;
        $self['checkVoucherImageFileID'] = $checkVoucherImageFileID;

        return $self;
    }

    /**
     * Details for where Increase will mail the check.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     */
    public function withMailingAddress(
        MailingAddress|array $mailingAddress
    ): self {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * The descriptor that will be printed on the memo field on the check.
     */
    public function withMemo(?string $memo): self
    {
        $self = clone $this;
        $self['memo'] = $memo;

        return $self;
    }

    /**
     * The descriptor that will be printed on the letter included with the check.
     */
    public function withNote(?string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * The payer of the check. This will be printed on the top-left portion of the check and defaults to the return address if unspecified.
     *
     * @param list<Payer|PayerShape> $payer
     */
    public function withPayer(array $payer): self
    {
        $self = clone $this;
        $self['payer'] = $payer;

        return $self;
    }

    /**
     * The name that will be printed on the check.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The return address to be printed on the check.
     *
     * @param ReturnAddress|ReturnAddressShape|null $returnAddress
     */
    public function withReturnAddress(
        ReturnAddress|array|null $returnAddress
    ): self {
        $self = clone $this;
        $self['returnAddress'] = $returnAddress;

        return $self;
    }

    /**
     * The shipping method for the check.
     *
     * @param ShippingMethod|value-of<ShippingMethod>|null $shippingMethod
     */
    public function withShippingMethod(
        ShippingMethod|string|null $shippingMethod
    ): self {
        $self = clone $this;
        $self['shippingMethod'] = $shippingMethod;

        return $self;
    }

    /**
     * The text that will appear as the signature on the check in cursive font. If blank, the check will be printed with 'No signature required'.
     */
    public function withSignatureText(?string $signatureText): self
    {
        $self = clone $this;
        $self['signatureText'] = $signatureText;

        return $self;
    }

    /**
     * Tracking updates relating to the physical check's delivery.
     *
     * @param list<TrackingUpdate|TrackingUpdateShape> $trackingUpdates
     */
    public function withTrackingUpdates(array $trackingUpdates): self
    {
        $self = clone $this;
        $self['trackingUpdates'] = $trackingUpdates;

        return $self;
    }
}
