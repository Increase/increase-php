<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\ServiceContracts\SimulationsContract;
use Increase\Services\Simulations\AccountStatementsService;
use Increase\Services\Simulations\AccountTransfersService;
use Increase\Services\Simulations\ACHTransfersService;
use Increase\Services\Simulations\CardAuthorizationExpirationsService;
use Increase\Services\Simulations\CardAuthorizationsService;
use Increase\Services\Simulations\CardBalanceInquiriesService;
use Increase\Services\Simulations\CardDisputesService;
use Increase\Services\Simulations\CardFuelConfirmationsService;
use Increase\Services\Simulations\CardIncrementsService;
use Increase\Services\Simulations\CardRefundsService;
use Increase\Services\Simulations\CardReversalsService;
use Increase\Services\Simulations\CardSettlementsService;
use Increase\Services\Simulations\CardTokensService;
use Increase\Services\Simulations\CheckDepositsService;
use Increase\Services\Simulations\CheckTransfersService;
use Increase\Services\Simulations\DigitalWalletTokenRequestsService;
use Increase\Services\Simulations\ExportsService;
use Increase\Services\Simulations\InboundACHTransfersService;
use Increase\Services\Simulations\InboundCheckDepositsService;
use Increase\Services\Simulations\InboundFednowTransfersService;
use Increase\Services\Simulations\InboundMailItemsService;
use Increase\Services\Simulations\InboundRealTimePaymentsTransfersService;
use Increase\Services\Simulations\InboundWireDrawdownRequestsService;
use Increase\Services\Simulations\InboundWireTransfersService;
use Increase\Services\Simulations\InterestPaymentsService;
use Increase\Services\Simulations\PendingTransactionsService;
use Increase\Services\Simulations\PhysicalCardsService;
use Increase\Services\Simulations\ProgramsService;
use Increase\Services\Simulations\RealTimePaymentsTransfersService;
use Increase\Services\Simulations\WireDrawdownRequestsService;
use Increase\Services\Simulations\WireTransfersService;

final class SimulationsService implements SimulationsContract
{
    /**
     * @api
     */
    public SimulationsRawService $raw;

    /**
     * @api
     */
    public InterestPaymentsService $interestPayments;

    /**
     * @api
     */
    public AccountTransfersService $accountTransfers;

    /**
     * @api
     */
    public CardAuthorizationsService $cardAuthorizations;

    /**
     * @api
     */
    public CardBalanceInquiriesService $cardBalanceInquiries;

    /**
     * @api
     */
    public CardAuthorizationExpirationsService $cardAuthorizationExpirations;

    /**
     * @api
     */
    public CardSettlementsService $cardSettlements;

    /**
     * @api
     */
    public CardReversalsService $cardReversals;

    /**
     * @api
     */
    public CardIncrementsService $cardIncrements;

    /**
     * @api
     */
    public CardFuelConfirmationsService $cardFuelConfirmations;

    /**
     * @api
     */
    public CardRefundsService $cardRefunds;

    /**
     * @api
     */
    public CardDisputesService $cardDisputes;

    /**
     * @api
     */
    public PhysicalCardsService $physicalCards;

    /**
     * @api
     */
    public DigitalWalletTokenRequestsService $digitalWalletTokenRequests;

    /**
     * @api
     */
    public PendingTransactionsService $pendingTransactions;

    /**
     * @api
     */
    public ACHTransfersService $achTransfers;

    /**
     * @api
     */
    public InboundACHTransfersService $inboundACHTransfers;

    /**
     * @api
     */
    public WireTransfersService $wireTransfers;

    /**
     * @api
     */
    public InboundWireTransfersService $inboundWireTransfers;

    /**
     * @api
     */
    public WireDrawdownRequestsService $wireDrawdownRequests;

    /**
     * @api
     */
    public InboundWireDrawdownRequestsService $inboundWireDrawdownRequests;

    /**
     * @api
     */
    public CheckTransfersService $checkTransfers;

    /**
     * @api
     */
    public InboundCheckDepositsService $inboundCheckDeposits;

    /**
     * @api
     */
    public RealTimePaymentsTransfersService $realTimePaymentsTransfers;

    /**
     * @api
     */
    public InboundRealTimePaymentsTransfersService $inboundRealTimePaymentsTransfers;

    /**
     * @api
     */
    public InboundFednowTransfersService $inboundFednowTransfers;

    /**
     * @api
     */
    public CheckDepositsService $checkDeposits;

    /**
     * @api
     */
    public InboundMailItemsService $inboundMailItems;

    /**
     * @api
     */
    public ProgramsService $programs;

    /**
     * @api
     */
    public AccountStatementsService $accountStatements;

    /**
     * @api
     */
    public ExportsService $exports;

    /**
     * @api
     */
    public CardTokensService $cardTokens;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SimulationsRawService($client);
        $this->interestPayments = new InterestPaymentsService($client);
        $this->accountTransfers = new AccountTransfersService($client);
        $this->cardAuthorizations = new CardAuthorizationsService($client);
        $this->cardBalanceInquiries = new CardBalanceInquiriesService($client);
        $this->cardAuthorizationExpirations = new CardAuthorizationExpirationsService($client);
        $this->cardSettlements = new CardSettlementsService($client);
        $this->cardReversals = new CardReversalsService($client);
        $this->cardIncrements = new CardIncrementsService($client);
        $this->cardFuelConfirmations = new CardFuelConfirmationsService($client);
        $this->cardRefunds = new CardRefundsService($client);
        $this->cardDisputes = new CardDisputesService($client);
        $this->physicalCards = new PhysicalCardsService($client);
        $this->digitalWalletTokenRequests = new DigitalWalletTokenRequestsService($client);
        $this->pendingTransactions = new PendingTransactionsService($client);
        $this->achTransfers = new ACHTransfersService($client);
        $this->inboundACHTransfers = new InboundACHTransfersService($client);
        $this->wireTransfers = new WireTransfersService($client);
        $this->inboundWireTransfers = new InboundWireTransfersService($client);
        $this->wireDrawdownRequests = new WireDrawdownRequestsService($client);
        $this->inboundWireDrawdownRequests = new InboundWireDrawdownRequestsService($client);
        $this->checkTransfers = new CheckTransfersService($client);
        $this->inboundCheckDeposits = new InboundCheckDepositsService($client);
        $this->realTimePaymentsTransfers = new RealTimePaymentsTransfersService($client);
        $this->inboundRealTimePaymentsTransfers = new InboundRealTimePaymentsTransfersService($client);
        $this->inboundFednowTransfers = new InboundFednowTransfersService($client);
        $this->checkDeposits = new CheckDepositsService($client);
        $this->inboundMailItems = new InboundMailItemsService($client);
        $this->programs = new ProgramsService($client);
        $this->accountStatements = new AccountStatementsService($client);
        $this->exports = new ExportsService($client);
        $this->cardTokens = new CardTokensService($client);
    }
}
