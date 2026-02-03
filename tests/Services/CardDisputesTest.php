<?php

namespace Tests\Services;

use Increase\CardDisputes\CardDispute;
use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardDisputesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->cardDisputes->create(
            disputedTransactionID: 'transaction_uyrp7fld2ium70oa7oi',
            network: 'visa'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->cardDisputes->create(
            disputedTransactionID: 'transaction_uyrp7fld2ium70oa7oi',
            network: 'visa',
            amount: 100,
            attachmentFiles: [['fileID' => 'file_id']],
            explanation: 'x',
            visa: [
                'category' => 'fraud',
                'authorization' => ['accountStatus' => 'account_closed'],
                'consumerCanceledMerchandise' => [
                    'merchantResolutionAttempted' => 'attempted',
                    'purchaseExplanation' => 'x',
                    'receivedOrExpectedAt' => '2019-12-27',
                    'returnOutcome' => 'not_returned',
                    'cardholderCancellation' => [
                        'canceledAt' => '2019-12-27',
                        'canceledPriorToShipDate' => 'canceled_prior_to_ship_date',
                        'cancellationPolicyProvided' => 'not_provided',
                        'reason' => 'x',
                    ],
                    'notReturned' => [],
                    'returnAttempted' => [
                        'attemptExplanation' => 'x',
                        'attemptReason' => 'merchant_not_responding',
                        'attemptedAt' => '2019-12-27',
                        'merchandiseDisposition' => 'x',
                    ],
                    'returned' => [
                        'returnMethod' => 'dhl',
                        'returnedAt' => '2019-12-27',
                        'merchantReceivedReturnAt' => '2019-12-27',
                        'otherExplanation' => 'x',
                        'trackingNumber' => 'x',
                    ],
                ],
                'consumerCanceledRecurringTransaction' => [
                    'cancellationTarget' => 'account',
                    'merchantContactMethods' => [
                        'applicationName' => 'x',
                        'callCenterPhoneNumber' => 'x',
                        'emailAddress' => 'x',
                        'inPersonAddress' => 'x',
                        'mailingAddress' => 'x',
                        'textPhoneNumber' => 'x',
                    ],
                    'transactionOrAccountCanceledAt' => '2019-12-27',
                    'otherFormOfPaymentExplanation' => 'x',
                ],
                'consumerCanceledServices' => [
                    'cardholderCancellation' => [
                        'canceledAt' => '2019-12-27',
                        'cancellationPolicyProvided' => 'not_provided',
                        'reason' => 'x',
                    ],
                    'contractedAt' => '2019-12-27',
                    'merchantResolutionAttempted' => 'attempted',
                    'purchaseExplanation' => 'x',
                    'serviceType' => 'guaranteed_reservation',
                    'guaranteedReservation' => [
                        'explanation' => 'cardholder_canceled_prior_to_service',
                    ],
                    'other' => [],
                    'timeshare' => [],
                ],
                'consumerCounterfeitMerchandise' => [
                    'counterfeitExplanation' => 'x',
                    'dispositionExplanation' => 'x',
                    'orderExplanation' => 'x',
                    'receivedAt' => '2019-12-27',
                ],
                'consumerCreditNotProcessed' => [
                    'canceledOrReturnedAt' => '2019-12-27',
                    'creditExpectedAt' => '2019-12-27',
                ],
                'consumerDamagedOrDefectiveMerchandise' => [
                    'merchantResolutionAttempted' => 'attempted',
                    'orderAndIssueExplanation' => 'x',
                    'receivedAt' => '2019-12-27',
                    'returnOutcome' => 'not_returned',
                    'notReturned' => [],
                    'returnAttempted' => [
                        'attemptExplanation' => 'x',
                        'attemptReason' => 'merchant_not_responding',
                        'attemptedAt' => '2019-12-27',
                        'merchandiseDisposition' => 'x',
                    ],
                    'returned' => [
                        'returnMethod' => 'dhl',
                        'returnedAt' => '2019-12-27',
                        'merchantReceivedReturnAt' => '2019-12-27',
                        'otherExplanation' => 'x',
                        'trackingNumber' => 'x',
                    ],
                ],
                'consumerMerchandiseMisrepresentation' => [
                    'merchantResolutionAttempted' => 'attempted',
                    'misrepresentationExplanation' => 'x',
                    'purchaseExplanation' => 'x',
                    'receivedAt' => '2019-12-27',
                    'returnOutcome' => 'not_returned',
                    'notReturned' => [],
                    'returnAttempted' => [
                        'attemptExplanation' => 'x',
                        'attemptReason' => 'merchant_not_responding',
                        'attemptedAt' => '2019-12-27',
                        'merchandiseDisposition' => 'x',
                    ],
                    'returned' => [
                        'returnMethod' => 'dhl',
                        'returnedAt' => '2019-12-27',
                        'merchantReceivedReturnAt' => '2019-12-27',
                        'otherExplanation' => 'x',
                        'trackingNumber' => 'x',
                    ],
                ],
                'consumerMerchandiseNotAsDescribed' => [
                    'merchantResolutionAttempted' => 'attempted',
                    'receivedAt' => '2019-12-27',
                    'returnOutcome' => 'returned',
                    'returnAttempted' => [
                        'attemptExplanation' => 'x',
                        'attemptReason' => 'merchant_not_responding',
                        'attemptedAt' => '2019-12-27',
                        'merchandiseDisposition' => 'x',
                    ],
                    'returned' => [
                        'returnMethod' => 'dhl',
                        'returnedAt' => '2019-12-27',
                        'merchantReceivedReturnAt' => '2019-12-27',
                        'otherExplanation' => 'x',
                        'trackingNumber' => 'x',
                    ],
                ],
                'consumerMerchandiseNotReceived' => [
                    'cancellationOutcome' => 'cardholder_cancellation_prior_to_expected_receipt',
                    'deliveryIssue' => 'delayed',
                    'lastExpectedReceiptAt' => '2019-12-27',
                    'merchantResolutionAttempted' => 'attempted',
                    'purchaseInfoAndExplanation' => 'x',
                    'cardholderCancellationPriorToExpectedReceipt' => [
                        'canceledAt' => '2019-12-27', 'reason' => 'x',
                    ],
                    'delayed' => [
                        'explanation' => 'x',
                        'returnOutcome' => 'not_returned',
                        'notReturned' => [],
                        'returnAttempted' => ['attemptedAt' => '2019-12-27'],
                        'returned' => [
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'returnedAt' => '2019-12-27',
                        ],
                    ],
                    'deliveredToWrongLocation' => ['agreedLocation' => 'x'],
                    'merchantCancellation' => ['canceledAt' => '2019-12-27'],
                    'noCancellation' => [],
                ],
                'consumerNonReceiptOfCash' => [],
                'consumerOriginalCreditTransactionNotAccepted' => [
                    'explanation' => 'x',
                    'reason' => 'prohibited_by_local_laws_or_regulation',
                ],
                'consumerQualityMerchandise' => [
                    'expectedAt' => '2019-12-27',
                    'merchantResolutionAttempted' => 'attempted',
                    'purchaseInfoAndQualityIssue' => 'x',
                    'receivedAt' => '2019-12-27',
                    'returnOutcome' => 'not_returned',
                    'notReturned' => [],
                    'ongoingNegotiations' => [
                        'explanation' => 'x',
                        'issuerFirstNotifiedAt' => '2019-12-27',
                        'startedAt' => '2019-12-27',
                    ],
                    'returnAttempted' => [
                        'attemptExplanation' => 'x',
                        'attemptReason' => 'merchant_not_responding',
                        'attemptedAt' => '2019-12-27',
                        'merchandiseDisposition' => 'x',
                    ],
                    'returned' => [
                        'returnMethod' => 'dhl',
                        'returnedAt' => '2019-12-27',
                        'merchantReceivedReturnAt' => '2019-12-27',
                        'otherExplanation' => 'x',
                        'trackingNumber' => 'x',
                    ],
                ],
                'consumerQualityServices' => [
                    'cardholderCancellation' => [
                        'acceptedByMerchant' => 'accepted',
                        'canceledAt' => '2019-12-27',
                        'reason' => 'x',
                    ],
                    'nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription' => 'not_related',
                    'purchaseInfoAndQualityIssue' => 'x',
                    'servicesReceivedAt' => '2019-12-27',
                    'cardholderPaidToHaveWorkRedone' => 'did_not_pay_to_have_work_redone',
                    'ongoingNegotiations' => [
                        'explanation' => 'x',
                        'issuerFirstNotifiedAt' => '2019-12-27',
                        'startedAt' => '2019-12-27',
                    ],
                    'restaurantFoodRelated' => 'not_related',
                ],
                'consumerServicesMisrepresentation' => [
                    'cardholderCancellation' => [
                        'acceptedByMerchant' => 'accepted',
                        'canceledAt' => '2019-12-27',
                        'reason' => 'x',
                    ],
                    'merchantResolutionAttempted' => 'attempted',
                    'misrepresentationExplanation' => 'x',
                    'purchaseExplanation' => 'x',
                    'receivedAt' => '2019-12-27',
                ],
                'consumerServicesNotAsDescribed' => [
                    'cardholderCancellation' => [
                        'acceptedByMerchant' => 'accepted',
                        'canceledAt' => '2019-12-27',
                        'reason' => 'x',
                    ],
                    'explanation' => 'x',
                    'merchantResolutionAttempted' => 'attempted',
                    'receivedAt' => '2019-12-27',
                ],
                'consumerServicesNotReceived' => [
                    'cancellationOutcome' => 'cardholder_cancellation_prior_to_expected_receipt',
                    'lastExpectedReceiptAt' => '2019-12-27',
                    'merchantResolutionAttempted' => 'attempted',
                    'purchaseInfoAndExplanation' => 'x',
                    'cardholderCancellationPriorToExpectedReceipt' => [
                        'canceledAt' => '2019-12-27', 'reason' => 'x',
                    ],
                    'merchantCancellation' => ['canceledAt' => '2019-12-27'],
                    'noCancellation' => [],
                ],
                'fraud' => ['fraudType' => 'account_or_credentials_takeover'],
                'processingError' => [
                    'errorReason' => 'duplicate_transaction',
                    'merchantResolutionAttempted' => 'attempted',
                    'duplicateTransaction' => ['otherTransactionID' => 'x'],
                    'incorrectAmount' => ['expectedAmount' => 0],
                    'paidByOtherMeans' => [
                        'otherFormOfPaymentEvidence' => 'canceled_check',
                        'otherTransactionID' => 'x',
                    ],
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->cardDisputes->retrieve(
            'card_dispute_h9sc95nbl1cgltpp7men'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->cardDisputes->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CardDispute::class, $item);
        }
    }

    #[Test]
    public function testSubmitUserSubmission(): void
    {
        $result = $this->client->cardDisputes->submitUserSubmission(
            'card_dispute_h9sc95nbl1cgltpp7men',
            network: 'visa'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testSubmitUserSubmissionWithOptionalParams(): void
    {
        $result = $this->client->cardDisputes->submitUserSubmission(
            'card_dispute_h9sc95nbl1cgltpp7men',
            network: 'visa',
            amount: 1,
            attachmentFiles: [['fileID' => 'file_id']],
            explanation: 'x',
            visa: [
                'category' => 'merchant_prearbitration_decline',
                'chargeback' => [
                    'category' => 'authorization',
                    'authorization' => ['accountStatus' => 'account_closed'],
                    'consumerCanceledMerchandise' => [
                        'merchantResolutionAttempted' => 'attempted',
                        'purchaseExplanation' => 'x',
                        'receivedOrExpectedAt' => '2019-12-27',
                        'returnOutcome' => 'not_returned',
                        'cardholderCancellation' => [
                            'canceledAt' => '2019-12-27',
                            'canceledPriorToShipDate' => 'canceled_prior_to_ship_date',
                            'cancellationPolicyProvided' => 'not_provided',
                            'reason' => 'x',
                        ],
                        'notReturned' => [],
                        'returnAttempted' => [
                            'attemptExplanation' => 'x',
                            'attemptReason' => 'merchant_not_responding',
                            'attemptedAt' => '2019-12-27',
                            'merchandiseDisposition' => 'x',
                        ],
                        'returned' => [
                            'returnMethod' => 'dhl',
                            'returnedAt' => '2019-12-27',
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'otherExplanation' => 'x',
                            'trackingNumber' => 'x',
                        ],
                    ],
                    'consumerCanceledRecurringTransaction' => [
                        'cancellationTarget' => 'account',
                        'merchantContactMethods' => [
                            'applicationName' => 'x',
                            'callCenterPhoneNumber' => 'x',
                            'emailAddress' => 'x',
                            'inPersonAddress' => 'x',
                            'mailingAddress' => 'x',
                            'textPhoneNumber' => 'x',
                        ],
                        'transactionOrAccountCanceledAt' => '2019-12-27',
                        'otherFormOfPaymentExplanation' => 'x',
                    ],
                    'consumerCanceledServices' => [
                        'cardholderCancellation' => [
                            'canceledAt' => '2019-12-27',
                            'cancellationPolicyProvided' => 'not_provided',
                            'reason' => 'x',
                        ],
                        'contractedAt' => '2019-12-27',
                        'merchantResolutionAttempted' => 'attempted',
                        'purchaseExplanation' => 'x',
                        'serviceType' => 'guaranteed_reservation',
                        'guaranteedReservation' => [
                            'explanation' => 'cardholder_canceled_prior_to_service',
                        ],
                        'other' => [],
                        'timeshare' => [],
                    ],
                    'consumerCounterfeitMerchandise' => [
                        'counterfeitExplanation' => 'x',
                        'dispositionExplanation' => 'x',
                        'orderExplanation' => 'x',
                        'receivedAt' => '2019-12-27',
                    ],
                    'consumerCreditNotProcessed' => [
                        'canceledOrReturnedAt' => '2019-12-27',
                        'creditExpectedAt' => '2019-12-27',
                    ],
                    'consumerDamagedOrDefectiveMerchandise' => [
                        'merchantResolutionAttempted' => 'attempted',
                        'orderAndIssueExplanation' => 'x',
                        'receivedAt' => '2019-12-27',
                        'returnOutcome' => 'not_returned',
                        'notReturned' => [],
                        'returnAttempted' => [
                            'attemptExplanation' => 'x',
                            'attemptReason' => 'merchant_not_responding',
                            'attemptedAt' => '2019-12-27',
                            'merchandiseDisposition' => 'x',
                        ],
                        'returned' => [
                            'returnMethod' => 'dhl',
                            'returnedAt' => '2019-12-27',
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'otherExplanation' => 'x',
                            'trackingNumber' => 'x',
                        ],
                    ],
                    'consumerMerchandiseMisrepresentation' => [
                        'merchantResolutionAttempted' => 'attempted',
                        'misrepresentationExplanation' => 'x',
                        'purchaseExplanation' => 'x',
                        'receivedAt' => '2019-12-27',
                        'returnOutcome' => 'not_returned',
                        'notReturned' => [],
                        'returnAttempted' => [
                            'attemptExplanation' => 'x',
                            'attemptReason' => 'merchant_not_responding',
                            'attemptedAt' => '2019-12-27',
                            'merchandiseDisposition' => 'x',
                        ],
                        'returned' => [
                            'returnMethod' => 'dhl',
                            'returnedAt' => '2019-12-27',
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'otherExplanation' => 'x',
                            'trackingNumber' => 'x',
                        ],
                    ],
                    'consumerMerchandiseNotAsDescribed' => [
                        'merchantResolutionAttempted' => 'attempted',
                        'receivedAt' => '2019-12-27',
                        'returnOutcome' => 'returned',
                        'returnAttempted' => [
                            'attemptExplanation' => 'x',
                            'attemptReason' => 'merchant_not_responding',
                            'attemptedAt' => '2019-12-27',
                            'merchandiseDisposition' => 'x',
                        ],
                        'returned' => [
                            'returnMethod' => 'dhl',
                            'returnedAt' => '2019-12-27',
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'otherExplanation' => 'x',
                            'trackingNumber' => 'x',
                        ],
                    ],
                    'consumerMerchandiseNotReceived' => [
                        'cancellationOutcome' => 'cardholder_cancellation_prior_to_expected_receipt',
                        'deliveryIssue' => 'delayed',
                        'lastExpectedReceiptAt' => '2019-12-27',
                        'merchantResolutionAttempted' => 'attempted',
                        'purchaseInfoAndExplanation' => 'x',
                        'cardholderCancellationPriorToExpectedReceipt' => [
                            'canceledAt' => '2019-12-27', 'reason' => 'x',
                        ],
                        'delayed' => [
                            'explanation' => 'x',
                            'returnOutcome' => 'not_returned',
                            'notReturned' => [],
                            'returnAttempted' => ['attemptedAt' => '2019-12-27'],
                            'returned' => [
                                'merchantReceivedReturnAt' => '2019-12-27',
                                'returnedAt' => '2019-12-27',
                            ],
                        ],
                        'deliveredToWrongLocation' => ['agreedLocation' => 'x'],
                        'merchantCancellation' => ['canceledAt' => '2019-12-27'],
                        'noCancellation' => [],
                    ],
                    'consumerNonReceiptOfCash' => [],
                    'consumerOriginalCreditTransactionNotAccepted' => [
                        'explanation' => 'x',
                        'reason' => 'prohibited_by_local_laws_or_regulation',
                    ],
                    'consumerQualityMerchandise' => [
                        'expectedAt' => '2019-12-27',
                        'merchantResolutionAttempted' => 'attempted',
                        'purchaseInfoAndQualityIssue' => 'x',
                        'receivedAt' => '2019-12-27',
                        'returnOutcome' => 'not_returned',
                        'notReturned' => [],
                        'ongoingNegotiations' => [
                            'explanation' => 'x',
                            'issuerFirstNotifiedAt' => '2019-12-27',
                            'startedAt' => '2019-12-27',
                        ],
                        'returnAttempted' => [
                            'attemptExplanation' => 'x',
                            'attemptReason' => 'merchant_not_responding',
                            'attemptedAt' => '2019-12-27',
                            'merchandiseDisposition' => 'x',
                        ],
                        'returned' => [
                            'returnMethod' => 'dhl',
                            'returnedAt' => '2019-12-27',
                            'merchantReceivedReturnAt' => '2019-12-27',
                            'otherExplanation' => 'x',
                            'trackingNumber' => 'x',
                        ],
                    ],
                    'consumerQualityServices' => [
                        'cardholderCancellation' => [
                            'acceptedByMerchant' => 'accepted',
                            'canceledAt' => '2019-12-27',
                            'reason' => 'x',
                        ],
                        'nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription' => 'not_related',
                        'purchaseInfoAndQualityIssue' => 'x',
                        'servicesReceivedAt' => '2019-12-27',
                        'cardholderPaidToHaveWorkRedone' => 'did_not_pay_to_have_work_redone',
                        'ongoingNegotiations' => [
                            'explanation' => 'x',
                            'issuerFirstNotifiedAt' => '2019-12-27',
                            'startedAt' => '2019-12-27',
                        ],
                        'restaurantFoodRelated' => 'not_related',
                    ],
                    'consumerServicesMisrepresentation' => [
                        'cardholderCancellation' => [
                            'acceptedByMerchant' => 'accepted',
                            'canceledAt' => '2019-12-27',
                            'reason' => 'x',
                        ],
                        'merchantResolutionAttempted' => 'attempted',
                        'misrepresentationExplanation' => 'x',
                        'purchaseExplanation' => 'x',
                        'receivedAt' => '2019-12-27',
                    ],
                    'consumerServicesNotAsDescribed' => [
                        'cardholderCancellation' => [
                            'acceptedByMerchant' => 'accepted',
                            'canceledAt' => '2019-12-27',
                            'reason' => 'x',
                        ],
                        'explanation' => 'x',
                        'merchantResolutionAttempted' => 'attempted',
                        'receivedAt' => '2019-12-27',
                    ],
                    'consumerServicesNotReceived' => [
                        'cancellationOutcome' => 'cardholder_cancellation_prior_to_expected_receipt',
                        'lastExpectedReceiptAt' => '2019-12-27',
                        'merchantResolutionAttempted' => 'attempted',
                        'purchaseInfoAndExplanation' => 'x',
                        'cardholderCancellationPriorToExpectedReceipt' => [
                            'canceledAt' => '2019-12-27', 'reason' => 'x',
                        ],
                        'merchantCancellation' => ['canceledAt' => '2019-12-27'],
                        'noCancellation' => [],
                    ],
                    'fraud' => ['fraudType' => 'account_or_credentials_takeover'],
                    'processingError' => [
                        'errorReason' => 'duplicate_transaction',
                        'merchantResolutionAttempted' => 'attempted',
                        'duplicateTransaction' => ['otherTransactionID' => 'x'],
                        'incorrectAmount' => ['expectedAmount' => 0],
                        'paidByOtherMeans' => [
                            'otherFormOfPaymentEvidence' => 'canceled_check',
                            'otherTransactionID' => 'x',
                        ],
                    ],
                ],
                'merchantPrearbitrationDecline' => [
                    'reason' => 'The pre-arbitration received from the merchantdoes not explain how they obtained permission to charge the card.',
                ],
                'userPrearbitration' => [
                    'reason' => 'x',
                    'categoryChange' => ['category' => 'authorization', 'reason' => 'x'],
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testWithdraw(): void
    {
        $result = $this->client->cardDisputes->withdraw(
            'card_dispute_h9sc95nbl1cgltpp7men'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }
}
