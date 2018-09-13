<?php


namespace App\Controller\Rest;
use App\Exception\CareshipExceptionInterface;
use App\Helper\Constants;
use App\Helper\Helper;
use App\Service\ATMService;
use FOS\RestBundle\FOSRestBundle;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class CashController extends FOSRestBundle
{
    /**
     * @Rest\Get("/withdraw")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Service\ATMService                   $ATMService
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function withdraw(Request $request, ATMService $ATMService)
    {
        $amount = $request->get('amount');
        try {
            $type    = Constants::$SUCCESS_MESSAGE;;
            $status  = Constants::$HTTP_SUCCESS_CODE;
            $message = Constants::$SUCCESS_MESSAGE;
            $result  = [];
            if(!empty($amount)) {
                $amount = (int) $amount;
                $result = $ATMService->withdraw($amount);
            }
        } catch (CareshipExceptionInterface $careshipException) {
            $type = Helper::getShortClassName($careshipException);
            $status = $careshipException->getExceptionCode();
            $message = $careshipException->getExceptionMessage();
        }
        return  new JsonResponse([
            'type' => $type,
            'status' => $status,
            'result' => $result,
            'message' => $message],
            $status, ['Content-Type' => 'application/json']);
    }
}