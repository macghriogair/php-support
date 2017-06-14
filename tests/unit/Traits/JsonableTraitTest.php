<?php
/**
 * @date    2016-10-25
 * @file    JsonableTraitTest.php
 * @author  Patrick Mac Gregor <macgregor.porta@gmail.com>
 */

namespace Macghriogair\Support\Tests;

use Macghriogair\Support\Traits\JsonableTrait;

class JsonableTraitTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function it_returns_all_properties_as_array()
    {
        $m = new MyModel;

        $this->assertEquals(
            [
                'prop1' => 'foo',
                'prop2' => 'bar',
                'prop3' => 'baz'
            ],
            $m->jsonSerialize()
        );
    }

    /** @test */
    public function it_uses_getters_where_they_exist()
    {
        $m = new MyModelWithGetter;

        $this->assertEquals(
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'name' => 'John Doe'
            ],
            $m->jsonSerialize()
        );
    }
}

class MyModel
{
    use JsonableTrait;

    private $prop1 = 'foo';

    protected $prop2 = 'bar';

    public $prop3 = 'baz';
}

class MyModelWithGetter
{
    use JsonableTrait;

    private $firstname = 'John';

    private $lastname = 'Doe';

    private $name = null;

    public function getName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
