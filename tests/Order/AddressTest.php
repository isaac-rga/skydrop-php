<?php

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testToHash()
    {
        $stub = $this->getMock('\Skydrop\Order\AbstractAddress');
        $stub->setName('juan rdz');
        $stub->setEmail('juan@gmail.com');
        $stub->serStreetNameAndNumber('rio rosas 101');
        $stub->setMunicipality('san pedro');
        $stub->setNeighborhood('del valle');
        $stub->setTelephone('81149090');

        $this->assertSame([
            'pickup' => [
                'name' => 'juan rdz',
                'email' => 'juan@gmail.com',
                'street_name_and_number' => 'rio rosas 101',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81149090',
            ],
        ], $stub->toHash('pickup'));
    }
}
