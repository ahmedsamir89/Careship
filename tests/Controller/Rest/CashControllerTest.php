<?php

namespace App\Tests\Controller\Rest;


use App\Exception\InvalidArgumentException;
use App\Exception\NoteUnavailableException;
use App\Helper\Constants;
use App\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CashControllerTest extends WebTestCase
{

    /** @var Client */
    private $client;

    public function setUp()
    {
        $kernel = static::bootKernel();
        $this->client = new Client($kernel);
    }

    /**
     * @param int|null $amount
     * @param array    $result
     * @param int      $code
     * @param string   $message
     * @param string   $type
     *
     * @dataProvider withdrawFunctionData
     */
    public function testWithdrawFunction(?int $amount, array $result, int $code, string $message, string $type)
    {
        $this->client->request('GET', '/api/withdraw', [
            'amount' => $amount
        ]);
        /** @var \Symfony\Component\HttpFoundation\JsonResponse $response */
        $response = $this->client->getResponse();
        $data = json_decode($response->getContent());

        $this->assertEquals($result, $data->result);
        $this->assertEquals($message, $data->message);
        $this->assertEquals($type, $data->type);
        $this->assertEquals($code, $response->getStatusCode());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function withdrawFunctionData(): array
    {
        // amount, note results, status code, message, type
        return [
            [50, [50], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
            [100, [100], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
            [30, [20, 10], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
            [80, [50, 20, 10], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
            [540, [100, 100, 100, 100, 100, 20, 20], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
            [125, [], Constants::$HTTP_CLIENT_ERROR_CODE, Constants::$NOTE_AVAILABLE_EXCEPTION_MESSAGE, Helper::getShortClassName(new NoteUnavailableException())],
            [-120, [], Constants::$HTTP_CLIENT_ERROR_CODE, Constants::$INVALID_ARGUMENT_EXCEPTION_MESSAGE, Helper::getShortClassName(new InvalidArgumentException())],
            [null, [], Constants::$HTTP_SUCCESS_CODE, Constants::$SUCCESS_MESSAGE, Constants::$SUCCESS_MESSAGE],
        ];
    }
}