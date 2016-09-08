<?php

use ChrisArmitage\ScalewayApi\Domain\Task;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Domain\Task
 */
class TaskTest extends TestCase
{
    public function testMakesTaskFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/task-pending.json'));

        $task = Task::makeFromTaskJson($json->task);

        self::assertEquals('server_batch_poweron', $task->getDescription());
        self::assertEquals(0, $task->getProgress());
        self::assertEquals('pending', $task->getStatus());
    }
}
