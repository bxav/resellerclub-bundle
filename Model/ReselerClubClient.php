<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface as GuzzleResponse;

class ReselerClubClient
{

    protected $client;
    
    protected $apiUrl;
    
    protected $userId;
    
    protected $apiKey;
    
    public function __construct(Client $client, $apiUrl, $userId, $apiKey)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->userId = $userId;
        $this->apiKey = $apiKey;
    }

    public function get($resource, array $params = [])
    {
        return $this->getResponse($this->request('get', $resource, $params));
    }

    public function post($resource, array $params = [])
    {
        return $this->getResponse($this->request('post', $resource, $params));
    }
    
    protected function request($word, $resource, $params)
    {
        $queryParams = [
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
        ];
        $queryParams = array_merge($queryParams, $params);
        
        $query = http_build_query($queryParams);
        
        // Reseller club have wierd way to handle tables in the Uri
        // TODO Check better way 
        $query = preg_replace('/%5B[0-9]+%5D/simU', '', $query);
        $response = $this->client->{$word}($this->apiUrl . '' . $resource . '?'. $query);
        return $response;
    }
    
    protected function getResponse(GuzzleResponse $response)
    {
        if (strpos($response->getHeader('Content-Type'), 'json')) {
            $returnResponse = new JsonResponse($response->getBody());
        } elseif (strpos($response->getHeader('Content-Type'), 'xml')) {
            $returnResponse = new XmlResponse($response->xml());
        } else {
            throw new \Exception('Unknow return type');
        }
        return $returnResponse;
    }
}
