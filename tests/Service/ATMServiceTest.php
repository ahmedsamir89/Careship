<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Samir <ahmed.samir@tajawal.com>
 * Date: 9/11/18
 * Time: 4:24 AM
 */

namespace App\Tests\Service;

use App\Exception\InvalidArgumentException;
use App\Exception\NoteUnavailableException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ATMServiceTest extends WebTestCase
{
    public $appContainer;

    public function setUp()
    {
            self::bootKernel();
            $container = self::$kernel->getContainer();
            $this->appContainer = self::$container;
    }

    /**
     * @param int   $amount
     * @param array $expected
     *
     * @dataProvider withdrawTestData
     */
    public function testWithdrawCorrectCasses(int $amount, array $expected)
    {
        $atmService = $this->appContainer->get('app.service.atm_service');
        $this->assertEquals($expected, $atmService->withdraw($amount));
    }

    /**
     * @return array
     */
    public function withdrawTestData(): array
    {
        return [
            [0, []],
            [10, [10]],
            [20, [20]],
            [100, [100]],
            [30, [20, 10]],
            [120, [100, 20]],
            [80,  [50,20,10]],
            [540,  [100,100,100,100,100,20,20]],
            [500,  [100,100,100,100,100]],
        ];
    }

    public function testWithdrawWrongCasses()
    {
        $atmService = $this->appContainer->get('app.service.atm_service');
        $this->expectException(InvalidArgumentException::class);
        $atmService->withdraw(-20);
        $this->expectException(InvalidArgumentException::class);
        $atmService->withdraw(-120);

        $this->expectException(NoteUnavailableException::class);
        $atmService->withdraw(22);
        $this->expectException(NoteUnavailableException::class);
        $atmService->withdraw(125);
    }
}