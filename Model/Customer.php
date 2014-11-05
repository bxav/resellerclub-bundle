<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class Customer
{
    protected $info = [];
    
    public function __construct($username)
    {
        $this->info['username'] = $username;
    }
    
    public function setName($name)
    {
        $this->info['name'] = $name;
        return $this;
    }
    
    public function setPasswd($passwd)
    {
        $this->info['passwd'] = $passwd;
        return $this;
    }
    
    public function setCompany($company)
    {
        $this->info['company'] = $company;
        return $this;
    }
    
    public function setAddress(Address $address)
    {
        $this->info['address'] = $address;
        return $this;
    }
    
    public function setPhone(Phone $phone)
    {
        $this->info['phone'] = $phone;
        return $this;
    }
    
    public function setLang($lang)
    {
        $this->info['lang'] = $lang;
        return $this;
    }
    
    public function setContacts(array $contacts)
    {
        $this->info['contacts'] = $contacts;
        return $this;
    }
    
    public function setId($id)
    {
        $this->info['id'] = $id;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->getProperty('username');
    }
    
    public function getName()
    {
        return $this->getProperty('name');
    }
    
    public function getPasswd()
    {
        return $this->getProperty('passwd');
    }
    
    public function getCompany()
    {
        return $this->getProperty('company');
    }
    
    public function getAddress()
    {
        return $this->getProperty('address');
    }
    
    public function getPhone()
    {
        return $this->getProperty('phone');
    }
    
    public function getLang()
    {
        return $this->getProperty('lang');
    }
    
    public function getId()
    {
        return $this->getProperty('id');
    }
    
    public function getContactBilling()
    {
        $contacts = $this->getProperty('contacts');
        return $contacts['billing_id'];
    }
    
    public function getContactTech()
    {
        $contacts = $this->getProperty('contacts');
        return $contacts['tech_id'];
    }
    
    public function getContactRegistrant()
    {
        $contacts = $this->getProperty('contacts');
        return $contacts['registrant_id'];
    }

    public function getContactAdmin()
    {
        $contacts = $this->getProperty('contacts');
        return $contacts['registrant_id'];
    }
    
    protected function getProperty($propertyName)
    {
        if (!isset($this->info[$propertyName])) {
            throw new \Exception('Attribute not set');
        } else {
            return $this->info[$propertyName];
        }
    }
}
