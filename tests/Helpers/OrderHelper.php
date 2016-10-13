<?php

class OrdersHelper
{
    public function __construct()
    {
        $this->service = new \Skydrop\Order\Service(
            [
                'serviceCode'  => 'Hoy',
                'vehicleType'  => 'car',
                'scheduleDate' => '2016-10-10',
                'startingHour' => '10:00',
                'endingHour'   => '22:00'
            ]
        );
        $this->package = new \Skydrop\Order\Package(
            [
                'package' => [
                    'cash_on_delivery' => 'true',
                    'cod_amount' => '100',
                ],
            ]
        );
        $this->delivery = new \Skydrop\Order\Address(
            [
                'name' => 'juan rdz',
                'email' => 'juan@gmail.com',
                'streetNameAndNumber' => 'rio rosas 101',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81149090',
            ]
        );
        $this->pickup = new \Skydrop\Order\Address(
            [
                'name' => 'juan pablo',
                'email' => 'pjuan@gmail.com',
                'streetNameAndNumber' => 'rio guadalquivir 422',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81818181818',
            ]
        );
    }

    public function getValidOrder()
    {
        return new \Skydrop\Order\OrderBuilder(
            '' => $this->getValidAddress(),
            '' => $this->getValidAddress(),
            '' => $,
            '' => $package,
        );
    }

    public function getInvalidOrder()
    {
    }

    public function getValidService()
    {
    }

    public function getValidPackage()
    {
    }

    public function getValidAddress()
    {
    }
}
