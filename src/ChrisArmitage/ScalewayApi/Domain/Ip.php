<?php

namespace ChrisArmitage\ScalewayApi\Domain;

class Ip
{
    protected $id;
    protected $address;

    protected function __construct($id, $address) {
        $this->id = $id;
        $this->address = $address;
    }

    static public function makeFromIpJson($ipJson) {
        return new static(
            isset($ipJson->id) ? $ipJson->id : null,
            isset($ipJson->address) ? $ipJson->address : null
        );
    }

    static public function makeFromIpAddress($ipAddress) {
        return new static(null, $ipAddress);
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAddress() {
        return $this->address;
    }
}