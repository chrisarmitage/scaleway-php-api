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
        return new static($ipJson->id, $ipJson->address);
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