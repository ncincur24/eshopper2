<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                "name" => "John",
                "email" => "john@hotmail.de",
                "message" => "This is first message"
            ],
            [
                "name" => "Monica",
                "email" => "monica22@yahoo.com",
                "message" => "What are you doing?"
            ],
            [
                "name" => "Justin",
                "email" => "jstin@gmail.com",
                "message" => "I hope that professor will give good grade to me on my website :)"
            ]
        ];
        foreach ($messages as $m){
            Message::create([
                "name" => $m["name"],
                "email" => $m["email"],
                "message" => $m["message"]
            ]);
        }
    }
}
