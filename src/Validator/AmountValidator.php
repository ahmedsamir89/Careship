<?php

namespace App\Validator;

use App\Exception\InvalidArgumentException;
use App\Exception\NoteUnavailableException;

class AmountValidator
{

    /**
     * @param $amount
     *
     * @throws \App\Exception\NoteUnavailableException
     */
    public function validate($amount)
    {

        if($amount < 0 || !is_integer($amount)) {
            throw new InvalidArgumentException("should be a number greater than zero");
        }

        if($amount % 10 != 0) {
            throw new NoteUnavailableException('Amounts should be a multiple of 10');
        }
    }

}