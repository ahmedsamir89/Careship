<?php

namespace App\Service;


use App\Helper\Constants;

class ATMService
{


    /**
     * @var \App\Service\WithdrawInterface
     */
    private $withdrawService;

    public function __construct(WithdrawInterface $atmActions)
    {
        $this->withdrawService = $atmActions;
    }

    /**
     * @param int $amount
     *
     * @return array
     */
    public function withdraw(int $amount): array
    {
        return $this->withdrawService->process($amount);
    }
}