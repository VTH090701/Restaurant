<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class TimeBetween implements Rule
{
  private $earliestTime;
  private $lastTime;


  public function __construct()
  {
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    $pickupDate = Carbon::parse($value);
    $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);
    // thời gian nhà hàng mở cửa

    $earliestTime = Carbon::createFromTimeString('17:00:00');
    $lastTime = Carbon::createFromTimeString('21:00:00');

    $earliestTime1 = Carbon::createFromTimeString('13:00:00');
    $lastTime1 = Carbon::createFromTimeString('16:00:00');

    return $pickupTime->between($earliestTime, $lastTime) || $pickupTime->between($earliestTime1, $lastTime1) ? true : false;

    // return $value >= now() || $value <= $oneWeek;

  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'Hãy chọn thời gian giữa 13:00:00 - 16:00:00 hoặc 17:00:00 - 21:00:00';
  }
}
