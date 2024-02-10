<?php

namespace App\Containers\AppSection\InquiryQuotation\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\InquiryQuotation\Actions\CreateInquiryQuotationAction;
use App\Containers\AppSection\InquiryQuotation\Actions\DeleteInquiryQuotationAction;
use App\Containers\AppSection\InquiryQuotation\Actions\FindInquiryQuotationByIdAction;
use App\Containers\AppSection\InquiryQuotation\Actions\GetNotificationByUseridAction;
use App\Containers\AppSection\InquiryQuotation\Actions\GetAllInquiryQuotationsAction;
use App\Containers\AppSection\InquiryQuotation\Actions\GetAllInquiryQuotationsBySearchAction;
use App\Containers\AppSection\InquiryQuotation\Actions\GetAllQuotationsBySearchAction;
use App\Containers\AppSection\InquiryQuotation\Actions\UpdateInquiryQuotationAction;
use App\Containers\AppSection\InquiryQuotation\Actions\UpdateFollowupNotificationAction;
use App\Containers\AppSection\InquiryQuotation\Entities\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\CreateInquiryQuotationRequest;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\DeleteInquiryQuotationRequest;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\FindInquiryQuotationByIdRequest;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\GetAllInquiryQuotationsRequest;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\UpdateInquiryQuotationRequest;
use App\Containers\AppSection\InquiryQuotation\UI\API\Transformers\InquiryQuotationTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createInquiryQuotation(CreateInquiryQuotationRequest $request)
    {
        $InputData = new InquiryQuotation($request);
        $inquiryquotation = app(CreateInquiryQuotationAction::class)->run($request, $InputData);

        return $inquiryquotation;
    }


    public function findInquiryQuotationById(FindInquiryQuotationByIdRequest $request)
    {
        $inquiryquotation = app(FindInquiryQuotationByIdAction::class)->run($request);

        return $inquiryquotation;
    }
    public function getNotificationByUserid(FindInquiryQuotationByIdRequest $request)
    {

        $inquiryquotation = app(GetNotificationByUseridAction::class)->run($request);
        return $inquiryquotation;
    }



    public function getAllInquiryQuotations(GetAllInquiryQuotationsRequest $request)
    {
        $inquiryquotations = app(GetAllInquiryQuotationsAction::class)->run($request);

        return $inquiryquotations;
    }


    public function GetAllInquiryQuotationsBySearch(GetAllInquiryQuotationsRequest $request)
    {
        $InputData = new InquiryQuotation($request);
        $inquiryquotations = app(GetAllInquiryQuotationsBySearchAction::class)->run($request, $InputData);
        return $inquiryquotations;
    }


    public function GetAllQuotationsBySearch(GetAllInquiryQuotationsRequest $request)
    {
        $InputData = new InquiryQuotation($request);
        $inquiryquotations = app(GetAllQuotationsBySearchAction::class)->run($request, $InputData);
        return $inquiryquotations;
    }

    public function updateInquiryQuotation(UpdateInquiryQuotationRequest $request)
    {
        $InputData = new InquiryQuotation($request);
        $inquiryquotation = app(UpdateInquiryQuotationAction::class)->run($request, $InputData);
        return $inquiryquotation;
    }

    public function updateFollowupNotification(UpdateInquiryQuotationRequest $request)
    {
        $InputData = new InquiryQuotation($request);
        $inquiryquotation = app(UpdateFollowupNotificationAction::class)->run($request, $InputData);
        return $inquiryquotation;
    }


    public function deleteInquiryQuotation(DeleteInquiryQuotationRequest $request)
    {
        $inquiryquotation = app(DeleteInquiryQuotationAction::class)->run($request);
        return $inquiryquotation;
    }
}
