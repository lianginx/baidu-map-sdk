<?php

use BaiduMapSdk\Config;
use BaiduMapSdk\Yingyan\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{

    private static int $serviceId;
    private static string $entityName = 'test_entity';

    public static function setUpBeforeClass(): void
    {
        Config::setApiKey(getenv('BAIDU_MAP_API_KEY'));
        self::$serviceId = getenv('TEST_SERVICE_ID');
    }

    public static function tearDownAfterClass(): void
    {
        Entity::delete(self::$serviceId, self::$entityName);
    }

    public function testAddEntity(): void
    {
        Entity::add(self::$serviceId, self::$entityName, 'hello');

        $this->assertTrue(true);
    }

    public function testUpdateEntity()
    {
        Entity::update(self::$serviceId, self::$entityName, 'helloworld');

        $this->assertTrue(true);
    }

    public function testEntityList()
    {
        $list = Entity::list(self::$serviceId);

        $this->assertArrayHasKey('entities', $list);
        $this->assertIsArray($list['entities']);
    }

    public function testDeleteEntity()
    {
        Entity::delete(self::$serviceId, self::$entityName);

        $this->assertTrue(true);
    }

}