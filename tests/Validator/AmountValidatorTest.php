<?php

namespace App\Validator;

use App\Exception\InvalidArgumentException;
use App\Exception\NoteUnavailableException;
use PHPUnit\Framework\TestCase;

class AmountValidatorTest extends TestCase
{

    public function testValidate()
    {
        $validator = new AmountValidator();
        $this->expectException(NoteUnavailableException::class);
        $validator->validate(22);
        $this->expectException(NoteUnavailableException::class);
        $validator->validate(107);
        $this->expectException(InvalidArgumentException::class);
        $validator->validate(-20);
    }

}