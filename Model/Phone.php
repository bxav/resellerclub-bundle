<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class Phone
{
    protected $cc;
    
    protected $number;
    
    public function __construct($countryCode, $number)
    {
        $this->cc = $countryCode;
        $this->number = $number;
    }
    
    public function getCountryCode()
    {
        return $this->cc;
    }

    public function getNumber()
    {
        return $this->number;
    }
}
