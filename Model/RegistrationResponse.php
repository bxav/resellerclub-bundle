<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class RegistrationResponse
{
    
    protected $response;
    
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
    
    public function getDescription()
    {
        return $this->getAttribute('description');        
    }
    
    public function getEntityId()
    {
        return $this->getAttribute('entityid');  
    }
    
    public function getActionType()
    {
        return $this->getAttribute('actiontype');   
    }
    
    public function getActionTypeDesc()
    {
        return $this->getAttribute('actiontypedesc');   
    }
    
    public function getEaqid()
    {
        return $this->getAttribute('eaqid');   
    }
    
    public function getActionStatus()
    {
        return $this->getAttribute('actionstatus');  
    }
    
    public function getStatus()
    {
        return $this->getAttribute('status');
    }
    
    public function getActionStatusDesc()
    {
        return $this->getAttribute('actionstatusdesc');   
    }
    
    public function getInvoiceId()
    {
        return $this->getAttribute('invoiceid');   
    }
    
    public function getSellingCurrencySymbol()
    {
        return $this->getAttribute('sellingcurrencysymbol');
    }
    
    public function getSellingAmount()
    {
        return $this->getAttribute('sellingamount');
    }
    
    public function getUnutilisedSellingAmount()
    {
        return $this->getAttribute('unutilisedsellingamount');  
    }
    
    public function getCustomerId()
    {
        return $this->getAttribute('customerid');
    }
    
    protected function getAttribute($attribute)
    {
        foreach ($this->response['entry'] as $entry) {
            if ($entry['string'][0] === $attribute) {
                return $entry['string'][1];
            }
        }
        throw new \Exception('Attribute not defined');
    }  
}
