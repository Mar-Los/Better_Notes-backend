<?php

use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folders = [
            [
                'user_id' => 1,
                'name' => 'Main Folder (depth 0)',
                'children' => [
                    [
                        'user_id' => 1,
                        'name' => 'Folder 1 (depth 1)'
                    ],
                    [
                        'user_id' => 1,
                        'name' => 'Folder 2 (depth 1)'
                    ],
                    [
                        'user_id' => 1,
                        'name' => 'Folder 3 (depth 1)',
                        'children' => [
                            [
                                'user_id' => 1,
                                'name' => 'Folder 1 (depth 2)'
                            ],
                            [
                                'user_id' => 1,
                                'name' => 'Folder 2 (depth 2)'
                            ],
                        ]
                    ]
                ]
            ]
        ];

        foreach ($folders as $folder) {
            App\Folder::create($folder);
        }
    }
}
