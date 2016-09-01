<?php

namespace ChrisArmitage\ScalewayApi;

use GuzzleHttp\Client as Guzzle;

class Client
{
    protected $endpoint;
    protected $token;
    protected $resource;
    protected $method;
    protected $parameters = [];

    public function __construct($endpoint, $token) {
        $this->endpoint = $endpoint;
        $this->token = $token;
    }

    public function setResource($resource) {
        $this->resource = $resource;
        return $this;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    public function setParameters($parameters) {
        $this->parameters = $parameters;
        return $this;
    }

    public function call() {
        $guzzle = new Guzzle;

        $options = [
            'headers' => [
                'X-Auth-Token' => $this->token,
            ],
        ];

        switch ($this->method) {
            case 'GET':
                $response = $guzzle->get("{$this->endpoint}{$this->resource}", $options);
                break;
            case 'POST':
                $options['json'] = $this->parameters;
                $response = $guzzle->post("{$this->endpoint}{$this->resource}", $options);
                break;
            case 'DELETE':
                $response = $guzzle->delete("{$this->endpoint}{$this->resource}", $options);
                break;
            default:
                throw new \RuntimeException('No valid method set');
        }

        return json_decode($response->getBody()->getContents());
    }
}