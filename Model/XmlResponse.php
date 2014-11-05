<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class XmlResponse implements Response
{

    private $response;

    public function __construct(\SimpleXMLElement $response)
    {
        $this->response = json_decode(json_encode((array) $response), true);
    }

    public function offsetSet($offset, $value)
    {
        throw new \Exception('read access only');
    }

    public function offsetExists($offset)
    {
        return isset($this->response[$offset]);
    }

    public function offsetUnset($offset)
    {
        throw new \Exception('read access only');
    }

    public function offsetGet($offset)
    {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}
