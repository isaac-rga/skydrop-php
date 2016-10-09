<?php

namespace Skydrop\ShippingRate\Modifier;

class ServiceName
{
    public function __construct($rates = [], $options = array())
    {
        $this->rates = $rates;
        if (array_key_exists('shipping', $options)) {
            $this->shop = $options['shipping']['shop'];
        }
    }

    public function call()
    {
        foreach ($this->rates as $rate) {
            $rate->service_name = $this->modifiedServiceName($rate);
        }
        return $this->rates;
    }

    private function modifiedServiceName($rate)
    {
        switch ($rate->service_code) {
        case 'EExps':
            return $this->eexpsName($rate);
            break;
        case 'Hoy':
            return $this->sameDayName;
            break;
        case 'next_day':
            return $this->nextDayName;
            break;
        default:
            return $rate->service_name;
        }
    }

    private function sameDayName()
    {
        return "Skydrop - Mismo Dia, te llega antes de las 10:00 pm{$this->shopServiceName('same_day')}";
    }

    private function eexpsName($rate)
    {
        return "Skydrop - Express, te llega antes de las {$this->toAmPm($rate->ending_hour)}{$this->shopServiceName('eexps')}";
    }

    private function nextDayName
    {
        return "Skydrop - Siguiente Día, te llega el día #{$this->nextDayDate} antes de las 10:00 pm{$this->shopServiceName('next_day')}";
    }

    private function toAmPm($timeStr)
    {
        return DateTime.parse($timeStr).strftime("%I:%M %P");
    }

    private function nextDayDate
    {
        return I18n.l((Time.zone.now + 1.day), format: :short_date);
    }

    private function shopServiceName($type)
    {
        if ($this->rawServiceNames[$type]) {
            return " ({$this->rawServiceNames[$type]})";
        } else {
            return '' ;
        }
    }

    private function rawServiceNames
    {
        if ($this->shop && $this->shop->settings['service_name']) {
            return $this->shop->settings['service_name'];
        } else {
            return [];
        }
    }
}
