<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run()
    {
        $majors = [
            ['major_name' => 'Law', 'degree_level' => 'Bachelor', 'khmer_name' => 'និតិសាស្រ្ត'],
            ['major_name' => 'Agricultural Economics', 'degree_level' => 'Bachelor', 'khmer_name' => 'សេដ្ឋកិច្ចកសិកម្ម'],
            ['major_name' => 'Economics and Taxation', 'degree_level' => 'Bachelor', 'khmer_name' => 'សេដ្ឋកិច្ច និងពន្ធដា'],
            ['major_name' => 'Psychology', 'degree_level' => 'Bachelor', 'khmer_name' => 'ចិត្តវិទ្យា'],
            ['major_name' => 'Public Administration and Governance', 'degree_level' => 'Bachelor', 'khmer_name' => 'រដ្ឋបាលសាធារណៈ និងអភិបាលកិច្ច'],
            ['major_name' => 'Economics and Data Science', 'degree_level' => 'Bachelor', 'khmer_name' => 'សេដ្ឋកិច្ច និងវិទ្យាសាស្រ្តទិន្នន័យ'],
            ['major_name' => 'Development and Regional Studies', 'degree_level' => 'Bachelor', 'khmer_name' => 'ជំនាញ អភិវឌ្ឍន៍ និងតំបន់'],
            ['major_name' => 'Food Technology', 'degree_level' => 'Bachelor', 'khmer_name' => 'កែច្នៃអាហារ'],
            ['major_name' => 'Animal Science', 'degree_level' => 'Bachelor', 'khmer_name' => 'វិទ្យាសាស្រ្តសត្វ'],
            ['major_name' => 'Education Science', 'degree_level' => 'Bachelor', 'khmer_name' => 'វិទ្យាសាស្រ្តអប់រំ'],
            ['major_name' => 'Khmer Literature', 'degree_level' => 'Bachelor', 'khmer_name' => 'អក្សរសាស្រ្តខ្មែរ'],
            ['major_name' => 'Cultural Studies', 'degree_level' => 'Bachelor', 'khmer_name' => 'សាកវប្បកម្ម'],
            ['major_name' => 'Civil Engineering', 'degree_level' => 'Bachelor', 'khmer_name' => 'វិស្វកម្មសំណង់ស៊ីវិល'],
            ['major_name' => 'Information Technology', 'degree_level' => 'Bachelor', 'khmer_name' => 'បច្ចេកវិទ្យាពត៌មាន'],
            ['major_name' => 'Business Management', 'degree_level' => 'Bachelor', 'khmer_name' => 'គ្រប់គ្រងអាជីវកម្ម'],
            ['major_name' => 'Finance and Banking', 'degree_level' => 'Bachelor', 'khmer_name' => 'ហិរញ្ញវត្ថុ និងធនាគារ'],
            ['major_name' => 'Marketing', 'degree_level' => 'Bachelor', 'khmer_name' => 'ទីផ្សារ'],
            ['major_name' => 'Accounting', 'degree_level' => 'Bachelor', 'khmer_name' => 'គណនេយ្យ'],
            ['major_name' => 'Tourism', 'degree_level' => 'Bachelor', 'khmer_name' => 'ទេសចរណ៍'],
            ['major_name' => 'English Literature', 'degree_level' => 'Bachelor', 'khmer_name' => 'អក្សរសាស្រ្តអង់គ្លេស'],
            ['major_name' => 'Korean Literature', 'degree_level' => 'Bachelor', 'khmer_name' => 'អក្សរសាស្រ្តកូរ៉េ'],
            ['major_name' => 'Chinese Literature', 'degree_level' => 'Bachelor', 'khmer_name' => 'អក្សរសាស្រ្តចិន'],
            ['major_name' => 'French Literature', 'degree_level' => 'Bachelor', 'khmer_name' => 'អក្សរសាស្រ្តបារាំង'],
            ['major_name' => 'Digital Business Management', 'degree_level' => 'Master', 'khmer_name' => 'គ្រប់គ្រងអាជីវកម្មឌីជីថល'],
            ['major_name' => 'Entrepreneurship and Innovation Management', 'degree_level' => 'Master', 'khmer_name' => 'គ្រប់គ្រងសហគ្រិនភាពនិងនវានុវត្តន៍'],
            ['major_name' => 'Public Administration', 'degree_level' => 'Master', 'khmer_name' => 'រដ្ឋបាលសាធារណៈ'],
            ['major_name' => 'Governance and Public Policy', 'degree_level' => 'Master', 'khmer_name' => 'អភិបាលកិច្ចនិងគោនយោបាយសាធារណៈ'],
            ['major_name' => 'Education Management', 'degree_level' => 'Master', 'khmer_name' => 'គ្រប់គ្រងអប់រំ'],
            ['major_name' => 'English Teaching', 'degree_level' => 'Master', 'khmer_name' => 'បង្រៀនភាសាអង់គ្លេស'],
            ['major_name' => 'Sustainable Agriculture', 'degree_level' => 'Master', 'khmer_name' => 'និរន្តរភាពកសិកម្ម'],
            ['major_name' => 'Ecology Management Systems', 'degree_level' => 'Master', 'khmer_name' => 'និរន្តរភាពនៃការគ្រប់គ្រងប្រព័ន្ធ អេកូឡូស៊ី'],
            ['major_name' => 'Education Management', 'degree_level' => 'PhD', 'khmer_name' => 'គ្រប់គ្រងអប់រំ'],
            ['major_name' => 'Ecology', 'degree_level' => 'PhD', 'khmer_name' => 'អេកូឡូសី'],
        ];

        DB::table('majors')->insert($majors);
    }
}
