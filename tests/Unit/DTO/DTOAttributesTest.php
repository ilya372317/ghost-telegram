<?php

namespace Tests\Unit\DTO;

use App\Exception\DTO\InvalidRequestParameterPassedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class DTOAttributesTest
 * @pakege Tests\Unit\DTO
 *
 * @author Otinov Ilya
 */
class DTOAttributesTest extends TestCase
{
    private const TEST_URI = 'http://test.com';

    /**
     * @return void
     */
    public function testDTOAttribute_GiveRequestWithBodyAndParamsToDTOWithAllAttributes_ObjectCorrectInitialize(): void
    {
        $testContent = [
            'field1' => 'test1',
            'field2' => 'test2',
        ];
        $testParams = [
            'field3' => 'test3',
        ];
        $request = Request::create(
            uri: self::TEST_URI,
            parameters: $testParams,
            content: json_encode($testContent),
        );
        try {
            $dto = DTOWithAllRequestAttributes::createFromRequest($request);
            $this->assertEquals($testContent['field1'], $dto->field1);
            $this->assertEquals($testContent['field2'], $dto->field2);
            $this->assertEquals($testParams['field3'], $dto->field3);
        } catch (InvalidRequestParameterPassedException) {
            $this->fail();
        }
    }

    /**
     * @return void
     */
    public function testDTOAttribute_GiveRequestWithOnlyBodyToDTOWithGetFromBodyAttribute_ObjectCorrectCreated(): void
    {
        $testContent = [
            'field1' => 'test1',
            'field2' => 'test2',
            'field3' => 'test3',
        ];
        $testParams = [
            'field4' => 'test4',
            'field5' => 'test5',
            'field6' => 'test6',
        ];
        $request = Request::create(
            uri: self::TEST_URI,
            parameters: $testParams,
            content: json_encode($testContent),
        );

        try {
            $dto = DTOWithGetFromBodyAttribute::createFromRequest($request);
            $this->assertEquals($testContent['field1'], $dto->field1);
            $this->assertEquals($testContent['field2'], $dto->field2);
            $this->assertEquals($testContent['field3'], $dto->field3);
        } catch (InvalidRequestParameterPassedException) {
            $this->fail();
        }
    }

    public function testDTOAttribute_GiveRequestWithOnlyParamsToDTOWithOnlyGetFromBodyAttribute_ObjectCreatingFailed(): void
    {
        $testParams = [
            'field1' => 'test1',
            'field2' => 'test2',
            'field3' => 'test3',
        ];
        $request = Request::create(
            uri: self::TEST_URI,
            parameters: $testParams
        );

        try {
            DTOWithGetFromBodyAttribute::createFromRequest($request);
            $this->fail();
        } catch (InvalidRequestParameterPassedException) {
            $this->assertTrue(true);
        }
    }

    public function testDTOAttribute_GiveRequestWithOnlyParamsToDTOWithGetFromParametersAttribute_ObjectCreated(): void
    {
        $testParams = [
            'field1' => 'test1',
            'field2' => 'test2',
            'field3' => 'test3',
        ];

        $testBody = [
            'field4' => 'test4',
            'field5' => 'test5',
            'field6' => 'test6',
        ];
        $request = Request::create(
            uri: self::TEST_URI,
            parameters: $testParams,
            content: json_encode($testBody)
        );

        try {
            $dto = DTOWithGetFromParametersAttribute::createFromRequest($request);
            $this->assertEquals($testParams['field1'], $dto->field1);
            $this->assertEquals($testParams['field2'], $dto->field2);
            $this->assertEquals($testParams['field3'], $dto->field3);
        } catch (InvalidRequestParameterPassedException) {
            $this->fail();
        }
    }

    /**
     * @return void
     */
    public function testDTOAttribute_GiveRequestWithOnlyBodyToDTOWithOnlyGetFromParametersAttribute_ObjectCreatingFailed(): void
    {
        $testBody = [
            'field1' => 'test1',
            'field2' => 'test2',
            'field3' => 'test3',
        ];
        $request = Request::create(
            uri: self::TEST_URI,
            content: json_encode($testBody),
        );

        try {
            DTOWithGetFromParametersAttribute::createFromRequest($request);
            $this->fail();
        } catch (InvalidRequestParameterPassedException) {
            $this->assertTrue(true);
        }
    }
}
