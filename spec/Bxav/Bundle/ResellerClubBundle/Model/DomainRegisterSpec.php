<?php

namespace spec\Bxav\Bundle\ResellerClubBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bxav\Bundle\ResellerClubBundle\Model\ReselerClubClient;
use Bxav\Bundle\ResellerClubBundle\Model\JsonResponse;
use Bxav\Bundle\ResellerClubBundle\Model\Customer;
use Bxav\Bundle\ResellerClubBundle\Model\Response;

class DomainRegisterSpec extends ObjectBehavior
{
    protected $client;
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Bxav\Bundle\ResellerClubBundle\Model\DomainRegister');
    }
    
    function let(ReselerClubClient $client)
    {
        $this->beConstructedWith($client);
        $this->client = $client;
    }
   
    function it_should_check_the_availability_of_a_domain(JsonResponse $response)
    {
        $domain = "tralala";
        $tld = "email";
        
        $response->offsetGet("$domain.$tld")->willReturn(['status' => 'available']);
        $this->client
             ->get("/domains/available.json", ['domain-name' => $domain, 'tlds' => $tld])
             ->willReturn($response);
        $this->isDomainAvailable($domain, $tld)->shouldReturn(true);
    }

    function it_should_register_a_domain(Customer $customer, Response $response)
    {
        //ResellerClub has weird api sometime json, sometime xml
        //Response is un interface to handle it in the same way
        //But the resultut can be a little strange
        $response->offsetGet('entry')->willReturn([
            [
                'string' => ['status', 'Success']
            ],
            [
                'string' => ['actionstatus', 'Success']
            ]
        ]);
        $this->client->post('/domains/register.xml', Argument::type('array'))->willReturn($response);
        
        $this->register("tralala", "email", $customer)->shouldReturn(true);
    }
}
