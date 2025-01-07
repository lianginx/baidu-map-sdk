<?php

use BaiduMapSdk\Yingyan\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{

    private static string $entityName = 'test_entity';
    private static Entity $entity;

    public static function setUpBeforeClass(): void
    {
        $ak = getenv('BAIDU_MAP_API_KEY');
        $serviceId = getenv('TEST_SERVICE_ID');
        self::$entity = new Entity($ak, $serviceId);
    }

    public static function tearDownAfterClass(): void
    {
        self::$entity->delete(self::$entityName);
    }

    public function testAddEntity(): void
    {
        self::$entity->add(self::$entityName);

        $this->assertTrue(true);
    }

    public function testUpdateEntity()
    {
        self::$entity->update(self::$entityName, 'helloworld');

        $this->assertTrue(true);
    }

    public function testEntityList()
    {
        $list = self::$entity->list();

        $this->assertArrayHasKey('entities', $list);
        $this->assertIsArray($list['entities']);
    }

    public function testDeleteEntity()
    {
        self::$entity->delete(self::$entityName);

        $this->assertTrue(true);
    }

}