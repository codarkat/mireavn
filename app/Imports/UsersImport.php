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

        $image = $this->makeAvatar(strtoupper($name[0]));

        return new User([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
            'image' => $image,
            'status' => $status,
        ]);


    }
    public function makeAvatar($character){
        $file_name = time().'.png';
        $path = 'data/images/upload/users/'.$file_name;
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);

        imagecolorallocate($image, $red, $green, $blue);

        $textcolor = imagecolorallocate($image, 255, 255, 255);
        imagettftext($image, 100, 0, 55, 150, $textcolor, 'public/main/fonts/productsans_bold.ttf', $character);

        header('Content-type: image/png');

        imagepng($image, $path);

        imagedestroy($image);
        return $file_name;
    }
}
