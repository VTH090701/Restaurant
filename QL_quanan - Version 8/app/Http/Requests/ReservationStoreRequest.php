<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Rules\Time1Between;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'datban_ten' => ['required'],
            'datban_email' => ['required'],
            'datban_sdt' => ['required'],
            'datban_thoigian' => ['required','date', new DateBetween , new TimeBetween ],
            'datban_slnguoi' => ['required'],
            'ban_id' => ['required'],
            'khachhang_id' => ['required'],
            'datban_tinhtrang' => ['required'],
            'datban_kt' => ['required'],

        ];
    }
}
