<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\PhysicalCardProfiles\PhysicalCardProfile;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText;
use Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status;
use Increase\RequestOptions;

/**
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText
 * @phpstan-import-type StatusShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText as FrontTextShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCardProfilesContract
{
    /**
     * @api
     *
     * @param string $carrierImageFileID the identifier of the File containing the physical card's carrier image
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $description a description you can use to identify the Card Profile
     * @param string $frontImageFileID the identifier of the File containing the physical card's front image
     * @param string $programID the identifier for the Program that this Physical Card Profile falls under
     * @param FrontText|FrontTextShape $frontText Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $carrierImageFileID,
        string $contactPhone,
        string $description,
        string $frontImageFileID,
        string $programID,
        FrontText|array|null $frontText = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile;

    /**
     * @api
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to clone
     * @param string $carrierImageFileID the identifier of the File containing the physical card's carrier image
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $description a description you can use to identify the Card Profile
     * @param string $frontImageFileID the identifier of the File containing the physical card's front image
     * @param \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText|FrontTextShape1 $frontText Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     * @param string $programID the identifier of the Program to use for the cloned Physical Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function clone(
        string $physicalCardProfileID,
        ?string $carrierImageFileID = null,
        ?string $contactPhone = null,
        ?string $description = null,
        ?string $frontImageFileID = null,
        \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText|array|null $frontText = null,
        ?string $programID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile;
}
