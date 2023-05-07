<?php

namespace Tests\Unit\DTO;

use App\DTO\Api\Channel\UpdateChannelDTO;
use App\Exception\DTO\InvalidRequestParameterPassedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class DataTransferObjectTest
 * @pakege Tests\Unit\DTO
 *
 * @author Otinov Ilya
 */
class DataTransferObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testToArray_ObjectConvertingToArray_ArrayIsCorrect(): void
    {
        $testUsername = 'test';
        $dto = new UpdateChannelDTO(username: $testUsername);
        $resultArray = $dto->toArray();

        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('username', $resultArray);
        $this->assertEquals($resultArray['username'], $testUsername);
    }

    /**
     * @return void
     */
    public function testCreateFromRequest_CreatingFromValidRequest_HasValidDTOObject(): void
    {
        $request = Request::create(uri: 'test', content: json_encode(['username' => 'test']));
        $dto = UpdateChannelDTO::createFromRequest($request);
        $this->assertObjectHasProperty('username', $dto);
        $this->assertEquals('test', $dto->username);
    }

    /**
     * @return void
     */
    public function testCreateFromRequest_CreatingFromNotValidRequest_ThrowError(): void
    {
        $request = Request::create(uri: 'test', content: json_encode(['userName' => 'test']));
        try {
            UpdateChannelDTO::createFromRequest($request);
        } catch (InvalidRequestParameterPassedException $exception) {
            $this->assertInstanceOf(InvalidRequestParameterPassedException::class, $exception);
        }
    }

}
