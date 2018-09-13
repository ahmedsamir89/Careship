<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Samir <ahmed.samir@tajawal.com>
 * Date: 9/11/18
 * Time: 4:16 AM
 */

namespace App\Tests\Helper;


use App\Exception\NoteUnavailableException;
use App\Helper\Constants;
use App\Helper\Helper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testGetShortClassName()
    {
        $invalidArgumentException = new InvalidArgumentException();
        $this->assertEquals('InvalidArgumentException', Helper::getShortClassName($invalidArgumentException));

        $noteUnavailableException = new NoteUnavailableException();
        $this->assertEquals('NoteUnavailableException', Helper::getShortClassName($noteUnavailableException));

        $constants = new Constants();
        $this->assertEquals('Constants', Helper::getShortClassName($constants));

        $this->expectException(\Exception::class);
        Helper::getShortClassName('x');
    }
}