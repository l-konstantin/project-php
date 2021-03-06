<?php

class studentTarif
{
    const PRICE_PER_ONE_KM = 4; //1км = 4 рубля
    const PRICE_PER_ONE_MINUTE = 1; //1 минута = 1 рубль
    use addGps;

    public function calc($distance, $time, $age, $services = [])
    {
        if ($age < 18 || $age > 25) {
            echo 'Расчет невозможен. Вы уже не студент';
            return null;
        }
        //переводим часы в минуты
        $minutes = $this->calcMinutes($time); //минуты
        $hours = $this->calcHours($time); //часы
        $ageRatio = $this->calcAgeRatio($age);
        $gps = $this->GPS($services);
        //формула расчета цены
        $total_price = (($distance * self::PRICE_PER_ONE_KM) + ($minutes * self::PRICE_PER_ONE_MINUTE) + ($hours * $gps)) * $ageRatio;
        return $total_price;
    }

    private function calcAgeRatio($age)
    {
        if ($age >= 18 && $age <= 21) {
            $result = 1.1;
        } else {
            $result = 1;
        }
        return $result;
    }

    private function calcMinutes($time)
    {
        return $time;
    }
    private function calcHours($time)
    {
        $result = $time / 60;
        return ceil($result);
    }
}
