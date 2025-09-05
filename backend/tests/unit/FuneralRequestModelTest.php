<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\FuneralRequestModel;

class FuneralRequestModelTest extends TestCase
{
    public function testModelConfiguration()
    {
        $model = new FuneralRequestModel();

        $ref = new \ReflectionClass($model);

        $tableProp = $ref->getProperty('table');
        $tableProp->setAccessible(true);
        $this->assertEquals('funeral_requests', $tableProp->getValue($model));

        $allowedProp = $ref->getProperty('allowedFields');
        $allowedProp->setAccessible(true);
        $allowed = $allowedProp->getValue($model);
        $this->assertIsArray($allowed);
        $this->assertContains('first_name', $allowed);
        $this->assertContains('last_name', $allowed);

        $tsProp = $ref->getProperty('useTimestamps');
        $tsProp->setAccessible(true);
        $this->assertTrue((bool) $tsProp->getValue($model));

        $rtProp = $ref->getProperty('returnType');
        $rtProp->setAccessible(true);
        $this->assertEquals(\App\Entities\FuneralRequest::class, $rtProp->getValue($model));
    }
}
