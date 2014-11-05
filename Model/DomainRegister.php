<?php
namespace Bxav\Bundle\ResellerClubBundle\Model;

class DomainRegister
{

    protected $client;
    
    protected $defaultNameservers = [];

    public function __construct(ReselerClubClient $client, array $defaultNameservers = null)
    {
        $this->client = $client;
        $this->defaultNameservers = $defaultNameservers;
    }

    public function isDomainAvailable($domain, $tld)
    {
        $bodyResponce = $this->client->get('/domains/available.json', [
            'domain-name' => $domain,
            'tlds' => $tld
        ]);
        return ($bodyResponce[$domain . "." . $tld]['status'] === "available");
    }

    public function register($domain, $tld, Customer $customer, array $nameservers = null, $invoiceOption = 'KeepInvoice')
    {
        $arrayNs = is_null($nameservers) ? $this->defaultNameservers : $nameservers;
        
        $bodyResponce = $this->client->post('/domains/register.xml', [
            'domain-name' => $domain . '.' . $tld,
            'years' => 1,
            'ns' => $arrayNs,
            'customer-id' => $customer->getId(),
            'reg-contact-id' => $customer->getContactRegistrant(),
            'admin-contact-id' => $customer->getContactAdmin(),
            'tech-contact-id' => $customer->getContactTech(),
            'billing-contact-id' => $customer->getContactBilling(),
            'invoice-option' => $invoiceOption
        ]);
        $response = new RegistrationResponse($bodyResponce);
        return ($response->getStatus() === 'Success');
    }
}
