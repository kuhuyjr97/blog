<?php

namespace App\Http\Requests;

use App\Http\Dto\AttendanceDTO;
use Laravel\Sanctum\PersonalAccessToken;


class AttendanceRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'datetime' => [
                'required',
                'string',
                'date_format:Y-m-d H:i:s'
            ],
        ];
    }

    public function toDTO(int $userId, string $countryCode): AttendanceDTO
    {
        $datetimeString = $this->input('datetime');
        $datetimeObject = new \DateTime($datetimeString);

        return new AttendanceDTO(
            $userId,
            $datetimeObject,
            $countryCode
        );
    }
}
