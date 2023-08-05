<?php

namespace Database\Seeders;

use App\Enums\CategoryTypeRequestEnum;
use App\Infrastructure\Eloquent\EloquentAttendance;
use App\Infrastructure\Eloquent\EloquentHoliday;
use App\Infrastructure\Eloquent\EloquentPersonalHoliday;
use App\Infrastructure\Eloquent\EloquentRequest;
use App\Infrastructure\Eloquent\EloquentRequestType;
use App\Infrastructure\Eloquent\EloquentWorkingDayOfWeeks;
use Illuminate\Database\Seeder;
use App\Infrastructure\Eloquent\EloquentUser;
use App\Infrastructure\Eloquent\EloquentDepartment;
use App\Infrastructure\Eloquent\EloquentRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //     $role = EloquentRole::create([
    //         'name' => 'its',
    //         'description' => 'dn'
    //     ]);
    //     $department = EloquentDepartment::create([
    //         'name' => 'its',
    //         'location' => 'dn'
    //     ]);
    //     $user = EloquentUser::create([
    //         'email' => 'test1@gmail.com',
    //         'password' => bcrypt('Asdasd123@'),
    //         'full_name' => 'huy',
    //         'phone_number' => 123,
    //         'address' => 'asd',
    //         'img_url' => 'asddsa',
    //         'role_id' => $role->id,
    //         'country_code' => 84,
    //         'department_id' => $department->id,
    //     ]);

    //     EloquentHoliday::factory(5)->create();


    //     EloquentRequestType::factory()->create([
    //         'id' => CategoryTypeRequestEnum::PARENT_REQ_OFF_REGULAR,
    //         'parent_id' => null,
    //         'category_id' => CategoryTypeRequestEnum::REQUEST_OFF,
    //         'name' => CategoryTypeRequestEnum::PARENT_REQ_OFF_REGULAR_TEXT
    //     ]);

    //     EloquentRequestType::factory()->create([
    //         'id' => CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL,
    //         'parent_id' => null,
    //         'category_id' => CategoryTypeRequestEnum::REQUEST_OFF,
    //         'name' => CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL_TEXT
    //     ]);

    //     EloquentRequestType::factory()->create([
    //         'id' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING,
    //         'parent_id' => CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL,
    //         'category_id' => CategoryTypeRequestEnum::REQUEST_OFF,
    //         'name' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING_TEXT
    //     ]);

    //     EloquentRequestType::factory()->create([
    //         'id' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_ANNIVERSARY,
    //         'parent_id' => CategoryTypeRequestEnum::PARENT_REQ_OFF_PERSONAL,
    //         'category_id' => CategoryTypeRequestEnum::REQUEST_OFF,
    //         'name' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_ANNIVERSARY_TEXT
    //     ]);

    //     EloquentRequestType::factory()->create([
    //         'id' => CategoryTypeRequestEnum::PARENT_OVERTIME_REQUEST_TASK,
    //         'parent_id' => null,
    //         'category_id' => CategoryTypeRequestEnum::REQUEST_OFF,
    //         'name' => CategoryTypeRequestEnum::PARENT_OVERTIME_REQUEST_TASK_TEXT
    //     ]);


    //     for ($i = 0; $i < 5; $i++) {
    //         EloquentAttendance::factory()->create([
    //             'user_id' => $user->id,
    //             'check_in' => now(),
    //             'check_out' => now()->addHours(8),
    //         ]);
    //     }

    //     for ($i = 0; $i < 5; $i++) {
    //         EloquentPersonalHoliday::factory()->create([
    //             'user_id' => $user->id,
    //             'request_type_id' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING,
    //             'day_left' => $i,
    //         ]);
    //     }

    //     EloquentRequest::factory()->create([
    //         'user_id' => $user->id,
    //         'user_accept_id' => $user->id,
    //         'request_type_id' => CategoryTypeRequestEnum::TYPE_REQ_OFF_PERSONAL_WEDDING,
    //         'start_from' => now()->addDays(123123),
    //         'ended_at' => now()->addDays(123123),
    //     ]);

    //     for ($i = 0; $i < 7; $i++) {
    //         EloquentWorkingDayOfWeeks::factory()->create([
    //             'user_id' => $user->id,
    //             'day' => $i,
    //             'time_start_work' => now()->format('H:i:s'),
    //             'time_end_work' => now()->addHours(8)->format('H:i:s'),
    //         ]);
        // }
    }
}
