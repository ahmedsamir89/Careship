<?php

namespace App\Exception;


interface CareshipExceptionInterface
{

    function getExceptionMessage();
    function getExceptionCode();
}