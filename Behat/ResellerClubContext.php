<?php
namespace Bxav\Bundle\ResellerClubBundle\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use GuzzleHttp\Client;
use Bxav\Component\ResellerClub\Model\Customer;
use Bxav\Component\ResellerClub\Model\Address;
use Bxav\Component\ResellerClub\Model\Phone;
use Symfony\Component\HttpKernel\KernelInterface;


class ResellerClubContext extends RawMinkContext implements KernelAwareContext, SnippetAcceptingContext
{
    
    protected $domainRegisterLastResponce;
    
    /**
     * @Given I have a reseller club account
     */
    public function iHaveAResellerClubAccount()
    {
        return true;
    }
    
    /**
     * @When I check availability for :domain on :tld
     */
    public function iCheckAvailabilityForOn($domain, $tld)
    {
        $domainRegister = $this->getService('bxav_reseller_club.domain_register');
        $this->domainRegisterLastResponce = $domainRegister->isDomainAvailable($domain, $tld);
    }

    /**
     * @Then I should get available
     */
    public function iShouldGetAvailable()
    {
        if (!$this->domainRegisterLastResponce) {
            throw new \Exception("Non available");
        }
    }    
    
    /**
     * @When I register :domain on :tld
     */
    public function iRegisterOn($domain, $tld)
    {
        $domainRegister = $this->getService('bxav_reseller_club.domain_register');
        $this->domainRegisterLastResponce = $domainRegister->register($domain . '-' . uniqid(), $tld, $this->customer);
    }
    
    /**
     * @Then I should get register
     */
    public function iShouldGetRegister()
    {
        if (!$this->domainRegisterLastResponce['status'] === 'Success') {
            throw new \Exception("Not registered");
        }
    }
    
    /**
     * @Given I have a customer :name
     */
    public function iHaveACustomer($name)
    {
        $customer = new Customer($name . '_' . uniqid() . '@example.com');
        $customer->setName($name)
            ->setPasswd('passpass666')
            ->setCompany('company')
            ->setAddress(new Address('addressLine1', 'city', 'state', 'US', '000000'))
            ->setPhone(new Phone('33', '0666666666'))
            ->setLang('en');
        
        $customerManager = $this->getService('bxav_reseller_club.customer_manager');
        $this->customer = $customerManager->register($customer);
    }
    
    
    /**
     * @var KernelInterface
     */
    protected $kernel;
    
    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }
    
    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }
}
