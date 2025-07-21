<?php

namespace Database\Seeders;

use App\Enums\ContentType;
use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'id' => 1,
                'content_type' => ContentType::ABOUT_US,
                'content' => '<p class="leading-normal mt-0 mb-4 p-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p class="leading-normal mt-0 mb-4 p-0">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo. Nemo enim
                                ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                                magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                                dolorem ipsum quia dolor sit amet, consectetur,
                                adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore
                                magnam aliquam quaerat voluptatem.
                            </p>
                            <p class="leading-normal my-0 p-0">
                                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                                reprehenderit qui in ea voluptate velit esse quam nihil molestiae
                                consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                            </p>'
            ],
            [
                'id' => 2,
                'content_type' => ContentType::CONTACT_US,
                'content' => '[
                    {
                        "icon": "pi pi-fw pi-phone",
                        "title": "Phone",
                        "info": "1 (833) 597-7538",
                        "key": "PHONE"
                    },
                    {
                        "icon": "pi pi-fw pi-map-marker",
                        "title": "Our Head Office",
                        "info": "Churchill-laan 16 II, 1052 CD, Amsterdam",
                        "key": "OFFICE"
                    },
                    {
                        "icon": "pi pi-fw pi-print",
                        "title": "Fax",
                        "info": "3 (833) 297-1548",
                        "key": "FAX"
                    }
                ]'
            ],
        ];

        foreach ($records as $record) {
            Content::updateOrCreate(['id' => $record['id']], $record);
        }
    }
}
