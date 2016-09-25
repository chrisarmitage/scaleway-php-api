<?php

namespace ChrisArmitage\ScalewayApi;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected $guzzle;
    protected $endpoint;
    protected $token;
    protected $resource;
    protected $method;
    protected $parameters = [];

    public function __construct(GuzzleClient $guzzle, $endpoint, $token) {
        $this->guzzle = $guzzle;
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
        $options = [
            'headers' => [
                'X-Auth-Token' => $this->token,
            ],
        ];

        switch ($this->method) {
            case 'GET':
                $response = $this->guzzle->get("{$this->endpoint}{$this->resource}", $options);
                break;
            case 'POST':
                $options['json'] = $this->parameters;
                $response = $this->guzzle->post("{$this->endpoint}{$this->resource}", $options);
                break;
            case 'DELETE':
                $response = $this->guzzle->delete("{$this->endpoint}{$this->resource}", $options);
                break;
            default:
                throw new \RuntimeException('No valid method set');
        }

        return $response->getBody()->getContents();
    }
}
