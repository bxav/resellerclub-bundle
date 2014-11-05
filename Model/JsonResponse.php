<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class JsonResponse implements Response
{

    private $response = [];

    public function __construct($json)
    {
        $this->response = json_decode($json, true);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->response[] = $value;
        } else {
            $this->response[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->response[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->response[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}
