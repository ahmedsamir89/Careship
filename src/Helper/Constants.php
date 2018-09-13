<?php

namespace App\Helper;


class Constants
{
    // exception messages
    static $INVALID_ARGUMENT_EXCEPTION_MESSAGE = 'Amount should be a number greater than zero';
    static $NOTE_AVAILABLE_EXCEPTION_MESSAGE   = 'Amounts should be a multiple of 10';
    static $GENERAL_EXCEPTION_MESSAGE          = 'Error While Serving your request please contact support';

    //http needed codes
    static $HTTP_CLIENT_ERROR_CODE = 400;
    static $HTTP_SERVER_ERROR_CODE = 503;
    static $HTTP_SUCCESS_CODE      = 200;


    //success message
    static $SUCCESS_MESSAGE = 'Success';

    // available notes
    static $AVAILABLE_NOTES = [100, 50, 20, 10];
}