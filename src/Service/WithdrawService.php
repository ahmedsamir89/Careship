<?php

namespace App\Service;


use App\Helper\Constants;
use App\Validator\AmountValidator;

class WithdrawService implements WithdrawInterface
{

    /**
     * @var \App\Validator\AmountValidator
     */
    private $amountValidator;

    public function __construct(AmountValidator $amountValidator)
    {

        $this->amountValidator = $amountValidator;
    }

    /**
     * @param int $amount
     *
     * @return array
     * @throws \App\Exception\NoteUnavailableException
     */
    function process(int $amount): array
    {
        $this->amountValidator->validate($amount);
        $availableNotes = Constants::$AVAILABLE_NOTES;
        $result         = [];

        for ($i = 0; $i < count($availableNotes) && $amount > 0 ; $i++) {
            $noteValue = $availableNotes[$i];
            $numberOfNums = floor($amount/$noteValue);
            if($numberOfNums > 0) {
                $amount = $amount - ($numberOfNums * $noteValue);
                for ($k = 0; $k < $numberOfNums; $k++) {
                    $result[] = number_format($noteValue, 2);
                }
            }
        }

        return $result;
    }
}