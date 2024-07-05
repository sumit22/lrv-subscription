<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([
        //     WebsiteSeeder::class,
        //     UserSeeder::class,
        // ]);
        $count = 0;

        while($count<50) {
            $webSiteId = random_int(1, 20);
            $userId = random_int(1, 100);

            $checkExists = \App\Models\WebsiteSubscriber::where('website_id', $webSiteId)
                ->where('user_id', $userId)
                ->exists();

                //ensure uniqueness
            if(!$checkExists) {
                \App\Models\WebsiteSubscriber::create([
                    'website_id' => $webSiteId,
                    'user_id' => $userId,
                    'is_active' => 1,
                ]);
                $count++;
            }
        }
    }
}
