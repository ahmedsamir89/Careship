<?php

namespace App\Exception;

use App\Helper\Constants;

class NoteUnavailableException extends \Exception implements CareshipExceptionInterface
{

    /**
     * @return string
     */
    function getExceptionMessage(): string
    {
        return Constants::$NOTE_AVAILABLE_EXCEPTION_MESSAGE;
    }

    /**
     * @return int
     */
    function getExceptionCode(): int
    {
        return Constants::$HTTP_CLIENT_ERROR_CODE;
    }
}