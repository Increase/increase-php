<?php

declare(strict_types=1);

namespace Increase;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Increase\Core\BaseClient;
use Increase\Core\Util;
use Increase\Services\AccountNumbersService;
use Increase\Services\AccountsService;
use Increase\Services\AccountStatementsService;
use Increase\Services\AccountTransfersService;
use Increase\Services\ACHPrenotificationsService;
use Increase\Services\ACHTransfersService;
use Increase\Services\BookkeepingAccountsService;
use Increase\Services\BookkeepingEntriesService;
use Increase\Services\BookkeepingEntrySetsService;
use Increase\Services\CardDisputesService;
use Increase\Services\CardPaymentsService;
use Increase\Services\CardPurchaseSupplementsService;
use Increase\Services\CardPushTransfersService;
use Increase\Services\CardsService;
use Increase\Services\CardTokensService;
use Increase\Services\CardValidationsService;
use Increase\Services\CheckDepositsService;
use Increase\Services\CheckTransfersService;
use Increase\Services\DeclinedTransactionsService;
use Increase\Services\DigitalCardProfilesService;
use Increase\Services\DigitalWalletTokensService;
use Increase\Services\EntitiesService;
use Increase\Services\EventsService;
use Increase\Services\EventSubscriptionsService;
use Increase\Services\ExportsService;
use Increase\Services\ExternalAccountsService;
use Increase\Services\FednowTransfersService;
use Increase\Services\FileLinksService;
use Increase\Services\FilesService;
use Increase\Services\GroupsService;
use Increase\Services\InboundACHTransfersService;
use Increase\Services\InboundCheckDepositsService;
use Increase\Services\InboundFednowTransfersService;
use Increase\Services\InboundMailItemsService;
use Increase\Services\InboundRealTimePaymentsTransfersService;
use Increase\Services\InboundWireDrawdownRequestsService;
use Increase\Services\InboundWireTransfersService;
use Increase\Services\IntrafiAccountEnrollmentsService;
use Increase\Services\IntrafiBalancesService;
use Increase\Services\IntrafiExclusionsService;
use Increase\Services\LockboxesService;
use Increase\Services\OAuthApplicationsService;
use Increase\Services\OAuthConnectionsService;
use Increase\Services\OAuthTokensService;
use Increase\Services\PendingTransactionsService;
use Increase\Services\PhysicalCardProfilesService;
use Increase\Services\PhysicalCardsService;
use Increase\Services\ProgramsService;
use Increase\Services\RealTimeDecisionsService;
use Increase\Services\RealTimePaymentsTransfersService;
use Increase\Services\RoutingNumbersService;
use Increase\Services\SimulationsService;
use Increase\Services\SupplementalDocumentsService;
use Increase\Services\SwiftTransfersService;
use Increase\Services\TransactionsService;
use Increase\Services\WireDrawdownRequestsService;
use Increase\Services\WireTransfersService;

/**
 * @phpstan-import-type NormalizedRequest from \Increase\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public AccountNumbersService $accountNumbers;

    /**
     * @api
     */
    public AccountTransfersService $accountTransfers;

    /**
     * @api
     */
    public CardsService $cards;

    /**
     * @api
     */
    public CardPaymentsService $cardPayments;

    /**
     * @api
     */
    public CardPurchaseSupplementsService $cardPurchaseSupplements;

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
    public DigitalCardProfilesService $digitalCardProfiles;

    /**
     * @api
     */
    public PhysicalCardProfilesService $physicalCardProfiles;

    /**
     * @api
     */
    public DigitalWalletTokensService $digitalWalletTokens;

    /**
     * @api
     */
    public TransactionsService $transactions;

    /**
     * @api
     */
    public PendingTransactionsService $pendingTransactions;

    /**
     * @api
     */
    public DeclinedTransactionsService $declinedTransactions;

    /**
     * @api
     */
    public ACHTransfersService $achTransfers;

    /**
     * @api
     */
    public ACHPrenotificationsService $achPrenotifications;

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
    public FednowTransfersService $fednowTransfers;

    /**
     * @api
     */
    public InboundFednowTransfersService $inboundFednowTransfers;

    /**
     * @api
     */
    public SwiftTransfersService $swiftTransfers;

    /**
     * @api
     */
    public CheckDepositsService $checkDeposits;

    /**
     * @api
     */
    public LockboxesService $lockboxes;

    /**
     * @api
     */
    public InboundMailItemsService $inboundMailItems;

    /**
     * @api
     */
    public RoutingNumbersService $routingNumbers;

    /**
     * @api
     */
    public ExternalAccountsService $externalAccounts;

    /**
     * @api
     */
    public EntitiesService $entities;

    /**
     * @api
     */
    public SupplementalDocumentsService $supplementalDocuments;

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
    public FilesService $files;

    /**
     * @api
     */
    public FileLinksService $fileLinks;

    /**
     * @api
     */
    public ExportsService $exports;

    /**
     * @api
     */
    public EventsService $events;

    /**
     * @api
     */
    public EventSubscriptionsService $eventSubscriptions;

    /**
     * @api
     */
    public RealTimeDecisionsService $realTimeDecisions;

    /**
     * @api
     */
    public BookkeepingAccountsService $bookkeepingAccounts;

    /**
     * @api
     */
    public BookkeepingEntrySetsService $bookkeepingEntrySets;

    /**
     * @api
     */
    public BookkeepingEntriesService $bookkeepingEntries;

    /**
     * @api
     */
    public GroupsService $groups;

    /**
     * @api
     */
    public OAuthApplicationsService $oauthApplications;

    /**
     * @api
     */
    public OAuthConnectionsService $oauthConnections;

    /**
     * @api
     */
    public OAuthTokensService $oauthTokens;

    /**
     * @api
     */
    public IntrafiAccountEnrollmentsService $intrafiAccountEnrollments;

    /**
     * @api
     */
    public IntrafiBalancesService $intrafiBalances;

    /**
     * @api
     */
    public IntrafiExclusionsService $intrafiExclusions;

    /**
     * @api
     */
    public CardTokensService $cardTokens;

    /**
     * @api
     */
    public CardPushTransfersService $cardPushTransfers;

    /**
     * @api
     */
    public CardValidationsService $cardValidations;

    /**
     * @api
     */
    public SimulationsService $simulations;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('INCREASE_API_KEY'));

        $baseUrl ??= Util::getenv(
            'INCREASE_BASE_URL'
        ) ?: 'https://api.increase.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('increase/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.23.0',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options,
            idempotencyHeader: 'Idempotency-Key'
        );

        $this->accounts = new AccountsService($this);
        $this->accountNumbers = new AccountNumbersService($this);
        $this->accountTransfers = new AccountTransfersService($this);
        $this->cards = new CardsService($this);
        $this->cardPayments = new CardPaymentsService($this);
        $this->cardPurchaseSupplements = new CardPurchaseSupplementsService($this);
        $this->cardDisputes = new CardDisputesService($this);
        $this->physicalCards = new PhysicalCardsService($this);
        $this->digitalCardProfiles = new DigitalCardProfilesService($this);
        $this->physicalCardProfiles = new PhysicalCardProfilesService($this);
        $this->digitalWalletTokens = new DigitalWalletTokensService($this);
        $this->transactions = new TransactionsService($this);
        $this->pendingTransactions = new PendingTransactionsService($this);
        $this->declinedTransactions = new DeclinedTransactionsService($this);
        $this->achTransfers = new ACHTransfersService($this);
        $this->achPrenotifications = new ACHPrenotificationsService($this);
        $this->inboundACHTransfers = new InboundACHTransfersService($this);
        $this->wireTransfers = new WireTransfersService($this);
        $this->inboundWireTransfers = new InboundWireTransfersService($this);
        $this->wireDrawdownRequests = new WireDrawdownRequestsService($this);
        $this->inboundWireDrawdownRequests = new InboundWireDrawdownRequestsService($this);
        $this->checkTransfers = new CheckTransfersService($this);
        $this->inboundCheckDeposits = new InboundCheckDepositsService($this);
        $this->realTimePaymentsTransfers = new RealTimePaymentsTransfersService($this);
        $this->inboundRealTimePaymentsTransfers = new InboundRealTimePaymentsTransfersService($this);
        $this->fednowTransfers = new FednowTransfersService($this);
        $this->inboundFednowTransfers = new InboundFednowTransfersService($this);
        $this->swiftTransfers = new SwiftTransfersService($this);
        $this->checkDeposits = new CheckDepositsService($this);
        $this->lockboxes = new LockboxesService($this);
        $this->inboundMailItems = new InboundMailItemsService($this);
        $this->routingNumbers = new RoutingNumbersService($this);
        $this->externalAccounts = new ExternalAccountsService($this);
        $this->entities = new EntitiesService($this);
        $this->supplementalDocuments = new SupplementalDocumentsService($this);
        $this->programs = new ProgramsService($this);
        $this->accountStatements = new AccountStatementsService($this);
        $this->files = new FilesService($this);
        $this->fileLinks = new FileLinksService($this);
        $this->exports = new ExportsService($this);
        $this->events = new EventsService($this);
        $this->eventSubscriptions = new EventSubscriptionsService($this);
        $this->realTimeDecisions = new RealTimeDecisionsService($this);
        $this->bookkeepingAccounts = new BookkeepingAccountsService($this);
        $this->bookkeepingEntrySets = new BookkeepingEntrySetsService($this);
        $this->bookkeepingEntries = new BookkeepingEntriesService($this);
        $this->groups = new GroupsService($this);
        $this->oauthApplications = new OAuthApplicationsService($this);
        $this->oauthConnections = new OAuthConnectionsService($this);
        $this->oauthTokens = new OAuthTokensService($this);
        $this->intrafiAccountEnrollments = new IntrafiAccountEnrollmentsService($this);
        $this->intrafiBalances = new IntrafiBalancesService($this);
        $this->intrafiExclusions = new IntrafiExclusionsService($this);
        $this->cardTokens = new CardTokensService($this);
        $this->cardPushTransfers = new CardPushTransfersService($this);
        $this->cardValidations = new CardValidationsService($this);
        $this->simulations = new SimulationsService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
