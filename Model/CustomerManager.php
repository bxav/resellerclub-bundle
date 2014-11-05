<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class CustomerManager
{

    protected $client;

    public function __construct(ReselerClubClient $client)
    {
        $this->client = $client;
    }

    public function register(Customer $customer)
    {
        $bodyResponce = $this->client->post('/customers/signup.xml', [
            'username' => $customer->getUsername(),
            'passwd' => $customer->getPasswd(),
            'name' => $customer->getName(),
            'company' => $customer->getCompany(),
            'address-line-1' => $customer->getAddress()->getAddressLine1(),
            'city' => $customer->getAddress()->getCity(),
            'state' => $customer->getAddress()->getState(),
            'country' => $customer->getAddress()->getCountry(),
            'zipcode' => $customer->getAddress()->getZipcode(),
            'phone-cc' => $customer->getPhone()->getCountryCode(),
            'phone' => $customer->getPhone()->getNumber(),
            'lang-pref' => $customer->getLang(),
        ]);
        
        $customer->setId((int)$bodyResponce[0]);
        $customer->setContacts($this->getDefaultContacts($customer));
        return $customer;
    }
    
    public function delete(Customer $customer)
    {
        $bodyResponce = $this->client->get('/customers/delete.json', [
            'customer-id' => $customer->getId()
        ]);
        return $bodyResponce[0];
    }
    
    public function getDefaultContacts(Customer $customer)
    {
        $bodyResponce = $this->client->get('/contacts/default.json', [
            'customer-id' => $customer->getId(),
            'type' => 'Contact'
            
        ]);
        $obj = $bodyResponce;
        return [
            'registrant_id' => (int) $obj['Contact']['registrant'],
            'tech_id' => (int) $obj['Contact']['tech'],
            'billing_id' => (int) $obj['Contact']['billing'],
            'admin_id' => (int) $obj['Contact']['admin']
        ];
    }
}
