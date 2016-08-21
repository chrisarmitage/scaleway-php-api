<?php

namespace ChrisArmitage\ScalewayApi\Domain;

class Image
{
    protected $name;
    protected $id;

    protected function __construct($imageJson) {
        $this->name = $imageJson->name;
        $this->id = $imageJson->id;
    }

    /**
     * @param $imageJson
     * @return static
     */
    static public function makeFromImageJson($imageJson) {
        return new static($imageJson);
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }
}
