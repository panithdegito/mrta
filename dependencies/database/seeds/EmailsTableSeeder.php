<?php

use Illuminate\Database\Seeder;
use App\Email;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = new Email();
        $email->receiver_name = "Somename";
        $email->receiver_email = "hello@hello.com";
        $email->sender_name = "Somename";
        $email->sender_host = "smtp.mailtrap.io";
        $email->sender_port = "2525";
        $email->sender_username = "e39181b2556142";
        $email->sender_password = "c207165795fd90";
        $email->save();
    }
}
