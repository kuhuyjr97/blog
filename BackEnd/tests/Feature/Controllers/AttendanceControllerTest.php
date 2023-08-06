<?php

namespace Tests\Feature\Controllers;

use App\Enums\CategoryTypeRequestEnum;
use App\Enums\ResponseEnum;
use App\Infrastructure\Eloquent\EloquentAttendance;
use App\Infrastructure\Eloquent\EloquentDepartment;
use App\Infrastructure\Eloquent\EloquentHoliday;
use App\Infrastructure\Eloquent\EloquentRequest;
use App\Infrastructure\Eloquent\EloquentWorkingDayOfWeeks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\ApiTestCase;

use App\Infrastructure\Eloquent\EloquentRole;
use App\Infrastructure\Eloquent\EloquentUser;

class AttendanceControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    private $phoneNumber;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->phoneNumber = '09012345678';

        $role = EloquentRole::factory()->create();

        $department = EloquentDepartment::factory()->create();

        $this->user = EloquentUser::factory()->create([
            'role_id' => $role->id,
            'department_id' => $department->id,
            'country_code' => 'VN',
        ]);

        EloquentWorkingDayOfWeeks::factory()->create([
            'user_id' => $this->user->id,
            'day' => now()->dayOfWeek,
            'time_start_work' => now()->setHour(7)->toDateTimeString(),
            'time_end_work' => now()->setHour(17)->toDateTimeString(),
        ]);

        EloquentHoliday::factory()->create([
            'name' => 'Test Holiday',
            'day' => now()->addDays(2)->day,
            'month' => now()->addDays(2)->month,
            'country_code' => 'VN',
        ]);

        EloquentRequest::factory()->create([
            'user_id' => $this->user->id,
            'request_type_id' => CategoryTypeRequestEnum::PARENT_OVERTIME_REQUEST_TASK,
            'category_id' => CategoryTypeRequestEnum::OVERTIME_REQUEST,
            'start_from' => now()->addDay()->setHour(7)->toDateTimeString(),
            'ended_at' => now()->addDay()->setHour(17)->toDateTimeString(),
        ]);
    }

    public function testStoreSuccessBeforeStartTime(): void
    {
        $params = [
            'datetime' => now()->setHour(5)->toDateTimeString(),
        ];
        $token = $this->user->createToken('myapptoken')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_SUCCESS);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => []
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
            'response_body' => [],
        ]);
    }

    public function testStoreSuccessCorrectStartTime(): void
    {
        $params = [
            'datetime'
            => now()->setHour(7)->toDateTimeString(),
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_SUCCESS);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => []
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
            'response_body' => [],
        ]);
    }

    public function testStoreSuccessWhenOverTime(): void
    {
        $params = [
            'datetime'
            => now()->addDay()->toDateTimeString(),
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_SUCCESS);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => []
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
            'response_body' => [],
        ]);
    }

    public function testStoreSuccessWhenHoliday(): void
    {
        EloquentRequest::factory()->create([
            'user_id' => $this->user->id,
            'request_type_id' => CategoryTypeRequestEnum::PARENT_OVERTIME_REQUEST_TASK,
            'category_id' => CategoryTypeRequestEnum::OVERTIME_REQUEST,
            'start_from' => now()->addDays(2)->setHour(7)->toDateTimeString(),
            'ended_at' => now()->addDays(2)->setHour(17)->toDateTimeString(),
        ]);

        $params = [
            'datetime'
            => now()->addDay()->toDateTimeString(),
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_SUCCESS);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => []
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
            'response_body' => [],
        ]);
    }

    public function testStoreFailDuplicate(): void
    {
        $params = [
            'datetime'
            => now()->toDateTimeString(),
        ];

        EloquentAttendance::factory()->create([
            'user_id' => $this->user->id,
            'check_in' => Carbon::now()->setHour(6)
        ]);
        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_CONFLICT);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => [
                'message' => [
                    'error'
                ]
            ]
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_CONFLICT_CHECKIN,
            'response_body' => [
                'message' => [
                    'error' => ResponseEnum::RES_MSG_ERR_CONFLICT_CHECKIN
                ]
            ]
        ]);
    }

    public function testStoreFailNotWorkingDay(): void
    {
        $params = [
            'datetime'
            => now()->addDays(10)->setHour(7)->toDateTimeString(),
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_FORBIDDEN);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => [
                'message' => [
                    'error'
                ]
            ]
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_BAD_CHECKIN,
            'response_body' => [
                'message' => [
                    'error' => ResponseEnum::RES_MSG_BAD_CHECKIN_OVERTIME
                ]
            ]
        ]);
    }

    public function testStoreFailIsHoliday(): void
    {
        EloquentWorkingDayOfWeeks::factory()->create([
            'user_id' => $this->user->id,
            'day' => now()->addDays(10)->dayOfWeek,
            'time_start_work' => now()->addDays(10)->setHour(7)->toDateTimeString(),
            'time_end_work' => now()->addDays(10)->setHour(17)->toDateTimeString(),
        ]);
        EloquentHoliday::factory()->create([
            'id' => 2,
            'name' => 'Test Holiday',
            'day' => now()->addDays(10)->day,
            'month' => now()->addDays(10)->month,
            'country_code' => 'VN',
        ]);

        $params = [
            'datetime'
            => now()->addDays(10)->setHour(7)->toDateTimeString(),
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->json('POST', $this->apiUrl . "/attendance/checkin", $params, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_FORBIDDEN);
        $response->assertJsonStructure([
            'response_status',
            'response_body' => [
                'message' => [
                    'error'
                ]
            ]
        ]);
        $response->assertJson([
            'response_status' => ResponseEnum::RES_STATUS_BAD_CHECKIN,
            'response_body' => [
                'message' => [
                    'error' => ResponseEnum::RES_MSG_BAD_CHECKIN_HOLIDAY
                ]
            ]
        ]);
    }

    public function testUpdateFailWithoutCheckin()
    {

        $data = [
            'datetime' => now()->format('Y-m-d H:i:s')
        ];

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->postJson('/api/v1/attendance/checkout', $data, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_FORBIDDEN)
            ->assertJson([
                'response_status' => ResponseEnum::RES_STATUS_BAD_CHECKOUT,
                'response_body' => [
                    'message' => [
                        'error' => ResponseEnum::RES_MSG_BAD_CHECKOUT_WITHOUT_CHECKIN
                    ]
                ]
            ]);
    }

    public function testUpdateFailConflictCheckout()
    {

        $data = [
            'datetime' => now()->format('Y-m-d H:i:s')
        ];

        EloquentAttendance::factory()->create([
            'user_id' => $this->user->id,
            'check_in' => Carbon::now()->setHour(6),
            'check_out' => Carbon::now()->setHour(18)
        ]);
        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->postJson('/api/v1/attendance/checkout', $data, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_CONFLICT)
            ->assertJson([
                'response_status' => ResponseEnum::RES_STATUS_CONFLICT_CHECKOUT,
                'response_body' => [
                    'message' => [
                        'error' => ResponseEnum::RES_MSG_ERR_CONFLICT_CHECKOUT
                    ]
                ]
            ]);
    }

    public function testUpdateSuccessfully()
    {

        $data = [
            'datetime' => now()->setHour(14)->setMinute(5)->format('Y-m-d H:i:s')
        ];

        EloquentAttendance::factory()->create([
            'user_id' => $this->user->id,
            'check_in' => Carbon::now()->setHour(8),
            'check_out' => null,
        ]);

        $token = $this->user->createToken('Test Token')->plainTextToken;

        $response = $this->postJson('/api/v1/attendance/checkout', $data, [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(ResponseEnum::HTTP_STATUS_SUCCESS)
            ->assertJson([
                'response_status' => ResponseEnum::RES_STATUS_SUCCESS,
                'response_body' => []
            ]);
    }
}
