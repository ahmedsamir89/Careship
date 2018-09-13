<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Samir <ahmed.samir@tajawal.com>
 * Date: 9/10/18
 * Time: 4:59 PM
 */

namespace App\Exception;


use App\Helper\Constants;

class InvalidArgumentException extends \InvalidArgumentException implements CareshipExceptionInterface
{
    /**
     * @return string
     */
    function getExceptionMessage(): string
    {
        return Constants::$INVALID_ARGUMENT_EXCEPTION_MESSAGE;
    }

    /**
     * @return int
     */
    function getExceptionCode(): int
    {
        return Constants::$HTTP_CLIENT_ERROR_CODE;
    }
}