<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams;

use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\MailingAddress;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\Payer;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\ReturnAddress;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\ShippingMethod;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details relating to the physical check that Increase will print and mail. This is required if `fulfillment_method` is equal to `physical_check`. It must not be included if any other `fulfillment_method` is provided.
 *
 * @phpstan-import-type MailingAddressShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\Payer
 * @phpstan-import-type ReturnAddressShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck\ReturnAddress
 *
 * @phpstan-type PhysicalCheckShape = array{
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   memo: string,
 *   recipientName: string,
 *   attachmentFileID?: string|null,
 *   checkVoucherImageFileID?: string|null,
 *   note?: string|null,
 *   payer?: list<Payer|PayerShape>|null,
 *   returnAddress?: null|ReturnAddress|ReturnAddressShape,
 *   shippingMethod?: null|ShippingMethod|value-of<ShippingMethod>,
 *   signatureText?: string|null,
 * }
 */
final class PhysicalCheck implements BaseModel
{
    /** @use SdkModel<PhysicalCheckShape> */
    use SdkModel;

    /**
     * Details for where Increase will mail the check.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * The descriptor that will be printed on the memo field on the check.
     */
    #[Required]
    public string $memo;

    /**
     * The name that will be printed on the check in the 'To:' field.
     */
    #[Required('recipient_name')]
    public string $recipientName;

    /**
     * The ID of a File to be attached to the check. This must have `purpose: check_attachment`. For details on pricing and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     */
    #[Optional('attachment_file_id')]
    public ?string $attachmentFileID;

    /**
     * The ID of a File to be used as the check voucher image. This must have `purpose: check_voucher_image`. For details on pricing and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     */
    #[Optional('check_voucher_image_file_id')]
    public ?string $checkVoucherImageFileID;

    /**
     * The descriptor that will be printed on the letter included with the check.
     */
    #[Optional]
    public ?string $note;

    /**
     * The payer of the check. This will be printed on the top-left portion of the check and defaults to the return address if unspecified. This should be an array of up to 4 elements, each of which represents a line of the payer.
     *
     * @var list<Payer>|null $payer
     */
    #[Optional(list: Payer::class)]
    public ?array $payer;

    /**
     * The return address to be printed on the check. If omitted this will default to an Increase-owned address that will mark checks as delivery failed and shred them.
     */
    #[Optional('return_address')]
    public ?ReturnAddress $returnAddress;

    /**
     * How to ship the check. For details on pricing, timing, and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     *
     * @var value-of<ShippingMethod>|null $shippingMethod
     */
    #[Optional('shipping_method', enum: ShippingMethod::class)]
    public ?string $shippingMethod;

    /**
     * The text that will appear as the signature on the check in cursive font. If not provided, the check will be printed with 'No signature required'.
     */
    #[Optional('signature_text')]
    public ?string $signatureText;

    /**
     * `new PhysicalCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCheck::with(mailingAddress: ..., memo: ..., recipientName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCheck)
     *   ->withMailingAddress(...)
     *   ->withMemo(...)
     *   ->withRecipientName(...)
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
     * @param list<Payer|PayerShape>|null $payer
     * @param ReturnAddress|ReturnAddressShape|null $returnAddress
     * @param ShippingMethod|value-of<ShippingMethod>|null $shippingMethod
     */
    public static function with(
        MailingAddress|array $mailingAddress,
        string $memo,
        string $recipientName,
        ?string $attachmentFileID = null,
        ?string $checkVoucherImageFileID = null,
        ?string $note = null,
        ?array $payer = null,
        ReturnAddress|array|null $returnAddress = null,
        ShippingMethod|string|null $shippingMethod = null,
        ?string $signatureText = null,
    ): self {
        $self = new self;

        $self['mailingAddress'] = $mailingAddress;
        $self['memo'] = $memo;
        $self['recipientName'] = $recipientName;

        null !== $attachmentFileID && $self['attachmentFileID'] = $attachmentFileID;
        null !== $checkVoucherImageFileID && $self['checkVoucherImageFileID'] = $checkVoucherImageFileID;
        null !== $note && $self['note'] = $note;
        null !== $payer && $self['payer'] = $payer;
        null !== $returnAddress && $self['returnAddress'] = $returnAddress;
        null !== $shippingMethod && $self['shippingMethod'] = $shippingMethod;
        null !== $signatureText && $self['signatureText'] = $signatureText;

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
    public function withMemo(string $memo): self
    {
        $self = clone $this;
        $self['memo'] = $memo;

        return $self;
    }

    /**
     * The name that will be printed on the check in the 'To:' field.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The ID of a File to be attached to the check. This must have `purpose: check_attachment`. For details on pricing and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     */
    public function withAttachmentFileID(string $attachmentFileID): self
    {
        $self = clone $this;
        $self['attachmentFileID'] = $attachmentFileID;

        return $self;
    }

    /**
     * The ID of a File to be used as the check voucher image. This must have `purpose: check_voucher_image`. For details on pricing and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     */
    public function withCheckVoucherImageFileID(
        string $checkVoucherImageFileID
    ): self {
        $self = clone $this;
        $self['checkVoucherImageFileID'] = $checkVoucherImageFileID;

        return $self;
    }

    /**
     * The descriptor that will be printed on the letter included with the check.
     */
    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * The payer of the check. This will be printed on the top-left portion of the check and defaults to the return address if unspecified. This should be an array of up to 4 elements, each of which represents a line of the payer.
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
     * The return address to be printed on the check. If omitted this will default to an Increase-owned address that will mark checks as delivery failed and shred them.
     *
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     */
    public function withReturnAddress(ReturnAddress|array $returnAddress): self
    {
        $self = clone $this;
        $self['returnAddress'] = $returnAddress;

        return $self;
    }

    /**
     * How to ship the check. For details on pricing, timing, and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
     *
     * @param ShippingMethod|value-of<ShippingMethod> $shippingMethod
     */
    public function withShippingMethod(
        ShippingMethod|string $shippingMethod
    ): self {
        $self = clone $this;
        $self['shippingMethod'] = $shippingMethod;

        return $self;
    }

    /**
     * The text that will appear as the signature on the check in cursive font. If not provided, the check will be printed with 'No signature required'.
     */
    public function withSignatureText(string $signatureText): self
    {
        $self = clone $this;
        $self['signatureText'] = $signatureText;

        return $self;
    }
}
