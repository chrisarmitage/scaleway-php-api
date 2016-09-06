<?php

namespace ChrisArmitage\ScalewayApi\Domain;

class Task
{
    protected $description;
    protected $progress;
    protected $status;

    protected function __construct($description, $progress, $status) {
        $this->description = $description;
        $this->progress = $progress;
        $this->status = $status;
    }

    static public function makeFromTaskJson($taskJson) {
        return new static(
            $taskJson->description,
            $taskJson->progress,
            $taskJson->status
        );
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getProgress() {
        return $this->progress;
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }
}