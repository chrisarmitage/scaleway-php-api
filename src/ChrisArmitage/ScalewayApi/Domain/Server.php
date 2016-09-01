<?php

namespace ChrisArmitage\ScalewayApi\Domain;

class Server
{
    protected $id;
    protected $state;

    /**
     * @var Image
     */
    protected $image;
    protected $publicIp;
    protected $privateIp;
    protected $commercialType;
    protected $volumes = [];

    protected function __construct($server) {
        $this->id = $server->id;
        $this->state = $server->state;
        $this->image = Image::makeFromImageJson($server->image);
        $this->publicIp = Ip::makeFromIpJson($server->public_ip);
        $this->privateIp = Ip::makeFromIpAddress($server->private_ip);
        $this->commercialType = $server->commercial_type;
    }

    /**
     * @param $serverJson
     * @return static
     */
    static public function makeFromServerJson($serverJson) {
        return new static($serverJson);
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
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