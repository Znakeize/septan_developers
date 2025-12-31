<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroImageSeeder extends Seeder
{

    public function run(): void
    {
        $heroImages = [
            [
                'page_type' => 'home',
                'images' => [
                    "hero_images/X8WSAU1LGwtUS7knEfNu30JTnchaidlEDrwdhtXd.jpg",
                    "hero_images/znQgHHGQD0pB8P9ADrf6bXqnFlGsfo9dUZRn938T.jpg",
                    "hero_images/Q7pKVmbenTgfcTb8nlGyaUYYTm5FYGkgVw5GnVK7.jpg",
                    "hero_images/W5sXJ443hZjjke5aLGZUfVTbvu051i7ejKSpeLzF.png",
                    "hero_images/4oWfSBGw2wPnZVNQwBXD5ZWTQnH9c3QjxJXzA49I.png",
                    "hero_images/duBzgtkERtxfuYEBxszs21UxwUFgxwz3x027Tyjh.png",
                    "hero_images/t4ugFcDTYX00OmQSb5HU7tUQJcjMDwXPi9UXRJT4.png",
                    "hero_images/259UlRg3LwNAqBa9aNkuHBVKgQn1lFNmdLB4b2Iw.png",
                    "hero_images/4MmbzXoKi5RXiYpd1VdtA1Arb6qFAnnKZcYdkkGa.png",
                    "hero_images/s6Uamm5GPoDYiNxwWWXrmAcdHeDmihaE55Ctqj1R.png"
                ],
            ],
            [
                'page_type' => 'architectural-design',
                'images' => ["hero_images/WYBidCdN90lzSJ1hqTjRh3fLMH03OdMkHqGC3f7j.jpg"],
            ],
            [
                'page_type' => 'structural-design',
                'images' => [
                    "hero_images/XthPtvDcaEwhQcDp0Y79zVp0YvhpFd4hMf5buYAe.jpg",
                    "hero_images/POE0g7YrMVGymdvHU0PvZoJEL2u227JmpFLK39vN.jpg"
                ],
            ],
            [
                'page_type' => 'bim-page',
                'images' => [
                    "hero_images/LgoWknflyRSl4OvfQeGdqBRToHz7uylE45ZpCSsp.jpg",
                    "hero_images/nQHUlDtXcJkO3JJM4MT5gl7IT5Jf6n5W2sQSv65n.jpg"
                ],
            ],
            [
                'page_type' => 'interior-design',
                'images' => [
                    "hero_images/e3LeGOmVvHhPghqfQ1CqpXcheifwzQ4yIIwyf77v.png",
                    "hero_images/b1qs3usvFoR4hIMWNFcpA09V4aZGIUJCP9OnRIO3.png",
                    "hero_images/e5Zpyw6hoLz45T9aoMHdhq1u6TwxJG5XTDAzlsrg.png",
                    "hero_images/Az5qcF1Dsqrq3P530uN4ZfRsdkbT2hiuCzjPdipO.png"
                ],
            ],
            [
                'page_type' => '3d-rendering',
                'images' => ["hero_images/WkMrwfqKQJWL6f5FIsnz7eVu7PIup98oFIYBsdK6.jpg"],
            ],
        ];

        foreach ($heroImages as $data) {
             DB::table('hero_images')->updateOrInsert(
                ['page_type' => $data['page_type']],
                [
                    'images' => json_encode($data['images']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
             );
        }
    }
}
