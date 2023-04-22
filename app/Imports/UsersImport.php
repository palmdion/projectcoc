<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            "name" => $row['firstname'],
            "last_name" => $row['lastname'],
            "email" => $row['email'],
            "role_id" => 2,
            "status" => 1,
            "password" => Hash::make($row['firstname'].'@'.$row['lastname'])
        ]);

        // Delete Any Existing Role
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();

        // Assign Role To User
        $user->assignRole($user->role_id);

        return $user;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
