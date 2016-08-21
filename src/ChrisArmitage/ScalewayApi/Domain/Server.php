<?php

namespace ChrisArmitage\ScalewayApi\Domain;

class Server
{
    protected $state;

    /**
     * @var Image
     */
    protected $image;
    protected $publicIp;
    protected $privateIp;
    protected $commercialType;
    protected $volumes = [];

    protected function __construct($serverJson) {
        $this->state = $serverJson->state;
        $this->image = Image::makeFromImageJson($serverJson->image);
        $this->publicIp = Ip::makeFromIpJson($serverJson->public_ip);
        $this->privateIp = Ip::makeFromIpAddress($serverJson->private_ip);
        $this->commercialType = $serverJson->commercial_type;
    }

    static public function makeFromServerJson($serverJson) {
        return new static($serverJson);
    }

    /**
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @return Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @return Ip
     */
    public function getPublicIp() {
        return $this->publicIp;
    }

    /**
     * @return Ip
     */
    public function getPrivateIp() {
        return $this->privateIp;
    }

    /**
     * @return mixed
     */
    public function getCommercialType() {
        return $this->commercialType;
    }

    /**
     * @return array
     */
    public function getVolumes() {
        return $this->volumes;
    }


}