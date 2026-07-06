<?php
namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tin tức BEA',       'slug' => 'tin-tuc-bea',       'sort_order' => 1],
            ['name' => 'Mẹo học tiếng Anh', 'slug' => 'meo-hoc-tieng-anh', 'sort_order' => 2],
            ['name' => 'IELTS',              'slug' => 'ielts',              'sort_order' => 3],
            ['name' => 'Ngữ pháp',           'slug' => 'ngu-phap',           'sort_order' => 4],
            ['name' => 'Từ vựng',            'slug' => 'tu-vung',            'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            ArticleCategory::create($cat);
        }
    }
}
