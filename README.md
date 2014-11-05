Reseller Club Api Bundle
=============


Client for ResellerClub Http Api


Config
------

```yaml

bxav_reseller_club:
    api:
        url: "%reseller_club.api_url%"
        user_id: "%reseller_club.user_id%"
        key: "%reseller_club.api_key%"
    domain_registration:
        nameservers:
          - '%reseller_club.ns1%'
          - '%reseller_club.ns2%'    


```


Use
---

```php

// resgister new customer
$customer = new Customer($username);
$customer->setName($name)
         ->setPasswd($pass)
         ->etc();
// ...         
$customerManager = $this->getService('bxav_reseller_club.customer_manager');
$customer = $customerManager->register($customer);


// check domain availability
$domainRegister = $this->getService('bxav_reseller_club.domain_register');
$bool = $domainRegister->isDomainAvailable($domain, $tld);

// resgister new domain
$domainRegister = $this->getService('bxav_reseller_club.domain_register');
$registrationResponse = $domainRegister->register($domain, $tld, $customer);



```
Check Behat ResellerClubContext for used details



Test
----

 
Behat:

```yaml

#behat.yml
    suites:
         
          resellerclubbundle:
              contexts:
                - Bxav\Bundle\ResellerClubBundle\Behat\ResellerClubContext:
              filters:
                tags: "@resellerclub"
                
```

bin/behat --lang=en --suite=resellerclubbundle