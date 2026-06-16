<?php

namespace Database\Seeders;

use App\Models\MaterialCategory;
use Illuminate\Database\Seeder;

class MaterialCategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            [
                'name' => 'Tiếng Anh Cơ Bản', 'slug' => 'tieng-anh-co-ban', 'sort_order' => 1,
                'description' => 'Tài liệu nền tảng dành cho học viên mới bắt đầu và trung cấp, bao gồm từ vựng, ngữ pháp và 4 kỹ năng cơ bản.',
                'children' => [
                    [
                        'name' => 'Từ vựng', 'slug' => 'tu-vung', 'sort_order' => 1,
                        'description' => 'Danh sách từ vựng, flashcard và bài tập theo chủ đề dành cho các cấp độ học.',
                    ],
                    [
                        'name' => 'Ngữ pháp', 'slug' => 'ngu-phap', 'sort_order' => 2,
                        'description' => 'Tài liệu giải thích và luyện tập các cấu trúc ngữ pháp tiếng Anh.',
                        'children' => [
                            [
                                'name' => 'Thì động từ', 'slug' => 'thi-dong-tu', 'sort_order' => 1,
                                'description' => 'Bài tập và bảng tóm tắt các thì: hiện tại, quá khứ, tương lai và hoàn thành.',
                            ],
                            [
                                'name' => 'Modal Verbs', 'slug' => 'modal-verbs', 'sort_order' => 2,
                                'description' => 'Tài liệu về các động từ khiếm khuyết: can, could, must, should, may, might.',
                            ],
                            [
                                'name' => 'Tính từ so sánh', 'slug' => 'tinh-tu-so-sanh', 'sort_order' => 3,
                                'description' => 'Bài tập so sánh hơn và so sánh nhất với tính từ ngắn và dài.',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Kỹ năng nghe', 'slug' => 'ky-nang-nghe', 'sort_order' => 3,
                        'description' => 'File âm thanh, bài nghe hội thoại và bài tập nghe hiểu theo trình độ.',
                    ],
                    [
                        'name' => 'Kỹ năng đọc', 'slug' => 'ky-nang-doc', 'sort_order' => 4,
                        'description' => 'Đoạn văn đọc hiểu kèm câu hỏi và từ vựng mới theo từng chủ đề.',
                    ],
                    [
                        'name' => 'Kỹ năng nói', 'slug' => 'ky-nang-noi', 'sort_order' => 5,
                        'description' => 'Kịch bản hội thoại, câu hỏi thảo luận và bài tập phát âm thực hành.',
                    ],
                    [
                        'name' => 'Kỹ năng viết', 'slug' => 'ky-nang-viet', 'sort_order' => 6,
                        'description' => 'Hướng dẫn viết đoạn văn, bài luận và email theo các dạng bài khác nhau.',
                    ],
                ],
            ],
            [
                'name' => 'Luyện thi IELTS', 'slug' => 'luyen-thi-ielts', 'sort_order' => 2,
                'description' => 'Tài liệu luyện thi IELTS theo từng kỹ năng, từ band 4.0 đến 7.0+, bao gồm đề thi thử và chiến thuật làm bài.',
                'children' => [
                    [
                        'name' => 'IELTS Writing', 'slug' => 'ielts-writing', 'sort_order' => 1,
                        'description' => 'Hướng dẫn và đề luyện tập Writing Task 1 (biểu đồ, sơ đồ) và Task 2 (bài luận).',
                    ],
                    [
                        'name' => 'IELTS Reading', 'slug' => 'ielts-reading', 'sort_order' => 2,
                        'description' => 'Bài đọc dạng học thuật với các dạng câu hỏi True/False/NG, matching và gap-fill.',
                    ],
                    [
                        'name' => 'IELTS Listening', 'slug' => 'ielts-listening', 'sort_order' => 3,
                        'description' => 'Bài nghe 4 section theo format thi thật, có đáp án và transcript.',
                    ],
                    [
                        'name' => 'IELTS Speaking', 'slug' => 'ielts-speaking', 'sort_order' => 4,
                        'description' => 'Câu hỏi mẫu Part 1, 2, 3 kèm bài trả lời tham khảo và từ vựng band cao.',
                    ],
                ],
            ],
            [
                'name' => 'Tài liệu tham khảo', 'slug' => 'tai-lieu-tham-khao', 'sort_order' => 3,
                'description' => 'Nguồn tài nguyên bổ trợ gồm từ điển trực tuyến và các trang học tiếng Anh uy tín.',
                'children' => [
                    [
                        'name' => 'Từ điển', 'slug' => 'tu-dien', 'sort_order' => 1,
                        'description' => 'Liên kết đến các từ điển Anh-Anh uy tín có phiên âm, ví dụ và audio.',
                    ],
                    [
                        'name' => 'Nguồn học trực tuyến', 'slug' => 'nguon-hoc-truc-tuyen', 'sort_order' => 2,
                        'description' => 'Trang web và ứng dụng học tiếng Anh miễn phí được kiểm duyệt bởi giáo viên.',
                    ],
                ],
            ],
        ];

        $this->createCategories($cats);
    }

    private function createCategories(array $cats, ?int $parentId = null): void
    {
        foreach ($cats as $cat) {
            $created = MaterialCategory::create([
                'name'        => $cat['name'],
                'slug'        => $cat['slug'],
                'parent_id'   => $parentId,
                'description' => $cat['description'] ?? null,
                'sort_order'  => $cat['sort_order'] ?? 0,
            ]);

            if (!empty($cat['children'])) {
                $this->createCategories($cat['children'], $created->id);
            }
        }
    }
}
