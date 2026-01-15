<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel;

use Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel\Ancillary\CreditReasonIndicator;
use Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel\Ancillary\Service;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Ancillary purchases in addition to the airfare.
 *
 * @phpstan-import-type ServiceShape from \Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel\Ancillary\Service
 *
 * @phpstan-type AncillaryShape = array{
 *   connectedTicketDocumentNumber: string|null,
 *   creditReasonIndicator: null|\Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel\Ancillary\CreditReasonIndicator|value-of<\Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel\Ancillary\CreditReasonIndicator>,
 *   passengerNameOrDescription: string|null,
 *   services: list<Service|ServiceShape>,
 *   ticketDocumentNumber: string|null,
 * }
 */
final class Ancillary implements BaseModel
{
    /** @use SdkModel<AncillaryShape> */
    use SdkModel;

    /**
     * If this purchase has a connection or relationship to another purchase, such as a baggage fee for a passenger transport ticket, this field should contain the ticket document number for the other purchase.
     */
    #[Required('connected_ticket_document_number')]
    public ?string $connectedTicketDocumentNumber;

    /**
     * Indicates the reason for a credit to the cardholder.
     *
     * @var value-of<CreditReasonIndicator>|null $creditReasonIndicator
     */
    #[Required(
        'credit_reason_indicator',
        enum: CreditReasonIndicator::class,
    )]
    public ?string $creditReasonIndicator;

    /**
     * Name of the passenger or description of the ancillary purchase.
     */
    #[Required('passenger_name_or_description')]
    public ?string $passengerNameOrDescription;

    /**
     * Additional travel charges, such as baggage fees.
     *
     * @var list<Service> $services
     */
    #[Required(list: Service::class)]
    public array $services;

    /**
     * Ticket document number.
     */
    #[Required('ticket_document_number')]
    public ?string $ticketDocumentNumber;

    /**
     * `new Ancillary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Ancillary::with(
     *   connectedTicketDocumentNumber: ...,
     *   creditReasonIndicator: ...,
     *   passengerNameOrDescription: ...,
     *   services: ...,
     *   ticketDocumentNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Ancillary)
     *   ->withConnectedTicketDocumentNumber(...)
     *   ->withCreditReasonIndicator(...)
     *   ->withPassengerNameOrDescription(...)
     *   ->withServices(...)
     *   ->withTicketDocumentNumber(...)
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
     * @param CreditReasonIndicator|value-of<CreditReasonIndicator>|null $creditReasonIndicator
     * @param list<Service|ServiceShape> $services
     */
    public static function with(
        ?string $connectedTicketDocumentNumber,
        CreditReasonIndicator|string|null $creditReasonIndicator,
        ?string $passengerNameOrDescription,
        array $services,
        ?string $ticketDocumentNumber,
    ): self {
        $self = new self;

        $self['connectedTicketDocumentNumber'] = $connectedTicketDocumentNumber;
        $self['creditReasonIndicator'] = $creditReasonIndicator;
        $self['passengerNameOrDescription'] = $passengerNameOrDescription;
        $self['services'] = $services;
        $self['ticketDocumentNumber'] = $ticketDocumentNumber;

        return $self;
    }

    /**
     * If this purchase has a connection or relationship to another purchase, such as a baggage fee for a passenger transport ticket, this field should contain the ticket document number for the other purchase.
     */
    public function withConnectedTicketDocumentNumber(
        ?string $connectedTicketDocumentNumber
    ): self {
        $self = clone $this;
        $self['connectedTicketDocumentNumber'] = $connectedTicketDocumentNumber;

        return $self;
    }

    /**
     * Indicates the reason for a credit to the cardholder.
     *
     * @param CreditReasonIndicator|value-of<CreditReasonIndicator>|null $creditReasonIndicator
     */
    public function withCreditReasonIndicator(
        CreditReasonIndicator|string|null $creditReasonIndicator,
    ): self {
        $self = clone $this;
        $self['creditReasonIndicator'] = $creditReasonIndicator;

        return $self;
    }

    /**
     * Name of the passenger or description of the ancillary purchase.
     */
    public function withPassengerNameOrDescription(
        ?string $passengerNameOrDescription
    ): self {
        $self = clone $this;
        $self['passengerNameOrDescription'] = $passengerNameOrDescription;

        return $self;
    }

    /**
     * Additional travel charges, such as baggage fees.
     *
     * @param list<Service|ServiceShape> $services
     */
    public function withServices(array $services): self
    {
        $self = clone $this;
        $self['services'] = $services;

        return $self;
    }

    /**
     * Ticket document number.
     */
    public function withTicketDocumentNumber(
        ?string $ticketDocumentNumber
    ): self {
        $self = clone $this;
        $self['ticketDocumentNumber'] = $ticketDocumentNumber;

        return $self;
    }
}
