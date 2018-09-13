<?php

namespace App\Service;


interface WithdrawInterface
{
    function process(int $amount);
}