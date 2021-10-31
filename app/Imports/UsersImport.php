<?php

namespace App\Imports;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $name = $row[0];
        $email = $row[1];
        $password = $row[2];
        $image = $row[3];
        $status = $row[4];

        $details = [
        'name'     => $name,
        'email'    => $email,
        'password' => $password
        ];
        Mail::to($email)->send(new \App\Mail\NotifyNewUser($details));

        return new User([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
            'image' => $image,
            'status' => $status,
        ]);


    }
}
