<?php
namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Học sinh',       'slug' => 'hoc-sinh'],
            ['name' => 'Người lớn',      'slug' => 'nguoi-lon'],
            ['name' => 'IELTS',          'slug' => 'ielts'],
            ['name' => 'Ngữ pháp',       'slug' => 'ngu-phap'],
            ['name' => 'Từ vựng',        'slug' => 'tu-vung'],
            ['name' => 'Phát âm',        'slug' => 'phat-am'],
            ['name' => 'Giao tiếp',      'slug' => 'giao-tiep'],
            ['name' => 'Kinh nghiệm',    'slug' => 'kinh-nghiem'],
            ['name' => 'Khóa học mới',   'slug' => 'khoa-hoc-moi'],
            ['name' => 'Sự kiện',        'slug' => 'su-kien'],
        ];
        foreach ($tags as $tag) {
            ArticleTag::create($tag);
        }
    }
}
