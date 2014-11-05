<?php
namespace spec\Bxav\Bundle\ResellerClubBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bxav\Bundle\ResellerClubBundle\Model\ReselerClubClient;
use Bxav\Bundle\ResellerClubBundle\Model\Customer;
use Bxav\Bundle\ResellerClubBundle\Model\Address;
use Bxav\Bundle\ResellerClubBundle\Model\Phone;

class CustomerManagerSpec extends ObjectBehavior
{

    protected $client;

    function it_is_initializable()
    {
        $this->shouldHaveType('Bxav\Bundle\ResellerClubBundle\Model\CustomerManager');
    }

    function let(ReselerClubClient $client)
    {
        $this->beConstructedWith($client);
        $this->client = $client;
    }
    
    function it_should_register_customer(Customer $customer, Address $addr, Phone $phone)
    {
        $customer->getId()->shouldBeCalled();
        $customer->getUsername()->willReturn('superpouetpouet@anal.pain');
        $customer->getPasswd()->willReturn('secret');
        $customer->getName()->willReturn('Superpouetpouet');
        $customer->getCompany()->willReturn('PouetCorp');
        $customer->getAddress()->willReturn($addr);
        $customer->getPhone()->willReturn($phone);
        $customer->getLang()->willReturn('en');        
        $this->client->post('/customers/signup.xml', Argument::type('array'))->willReturn(["123456"]);
            
        $customer->setId(123456)->shouldBeCalled();
        $this->client->get('/contacts/default.json', Argument::type('array'))->willReturn([
            'Contact' => [
                'registrant' => '123456',
                'billing' => '123456',
                'admin' => '123456',
                'tech' => '123456'
            ]
        ]);
        $customer->setContacts(Argument::any())->shouldBeCalled();
        
        $this->register($customer)->shouldReturn($customer);
    }
    
    function it_should_delete_customer(Customer $customer)
    {
        $this->client->get('/customers/delete.json', Argument::type('array'))->willReturn([true]);
    
        $this->delete($customer)->shouldReturn(true);
    }
}
