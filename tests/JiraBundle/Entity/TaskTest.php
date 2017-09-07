<?php
declare(strict_types=1);

namespace JiraBundle\Entity;

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /** @var Task */
    public $task;

    public function setUp()
    {
        $this->task = new Task();
    }

    public function test_getLanguagesAsArray_emptyResultOnEmptyInput() {
        $this->assertEquals(
            [''],
            $this->task->getLanguagesAsArray()
        );
    }

    public function test_getLanguagesAsArray_validResult() {
        $this->task->setLanguages('ES ,IT');
        $this->assertEquals(
            ['ES', 'IT'],
            $this->task->getLanguagesAsArray()
        );
    }
}
