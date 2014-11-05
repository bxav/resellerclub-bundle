<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class Address
{
    protected $addressLine1;
    protected $city;
    protected $state;
    protected $country;
    protected $zipcode;
    
    public function __construct($addressLine1, $city, $state, $country, $zipcode)
    {
        $this->addressLine1 = $addressLine1;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipcode = $zipcode;
    }
    
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    public function getcity()
    {
        return $this->city;
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    public function getZipcode()
    {
        return $this->zipcode;
    }
}
