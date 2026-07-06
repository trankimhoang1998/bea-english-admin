<?php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $managerId = User::where('username', 'bea.manager')->value('id');
        $c = fn(string $slug) => ArticleCategory::where('slug', $slug)->value('id');
        $t = fn(string $slug) => ArticleTag::where('slug', $slug)->value('id');

        $articles = [
            [
                'title'    => 'BEA English ra mắt chương trình học tiếng Anh 1 kèm 1 trực tuyến',
                'slug'     => 'bea-english-ra-mat-chuong-trinh-hoc-tieng-anh-1-kem-1',
                'excerpt'  => 'BEA English chính thức ra mắt mô hình dạy học 1 kèm 1 trực tuyến, mang đến trải nghiệm học tập cá nhân hóa hoàn toàn mới.',
                'content'  => '<p>BEA English tự hào giới thiệu chương trình học tiếng Anh 1 kèm 1 trực tuyến – giải pháp học tập được thiết kế riêng cho từng học viên.</p><p>Với mô hình này, mỗi học viên sẽ được học cùng một giáo viên cố định, đảm bảo sự liên tục và nhất quán trong quá trình học tập. Giáo viên có thể theo dõi sát sao tiến độ, điều chỉnh giáo án phù hợp với tốc độ tiếp thu của từng em.</p><p>Đây là mô hình học tập hiệu quả nhất hiện nay, được áp dụng thành công tại nhiều trường ngôn ngữ hàng đầu thế giới.</p>',
                'status'   => 'published',
                'category' => 'tin-tuc-bea',
                'tags'     => ['hoc-sinh', 'nguoi-lon', 'khoa-hoc-moi'],
                'published_at' => '2026-01-10 08:00:00',
            ],
            [
                'title'    => '5 mẹo học từ vựng tiếng Anh hiệu quả cho người mới bắt đầu',
                'slug'     => '5-meo-hoc-tu-vung-tieng-anh-hieu-qua',
                'excerpt'  => 'Học từ vựng không cần phải khô khan và nhàm chán. Hãy khám phá 5 phương pháp thú vị giúp bạn ghi nhớ từ mới lâu hơn.',
                'content'  => '<h2>1. Học theo chủ đề</h2><p>Thay vì học từ ngẫu nhiên, hãy nhóm các từ theo chủ đề như gia đình, đồ ăn, công việc. Não bộ dễ ghi nhớ hơn khi từ vựng có liên kết với nhau.</p><h2>2. Sử dụng flashcard</h2><p>Flashcard là công cụ học từ vựng kinh điển. Viết từ tiếng Anh ở một mặt, nghĩa và ví dụ ở mặt kia.</p><h2>3. Đọc sách thiếu nhi bằng tiếng Anh</h2><p>Sách thiếu nhi sử dụng từ vựng đơn giản, thường kèm hình ảnh minh họa, rất phù hợp cho người mới bắt đầu.</p><h2>4. Nghe nhạc tiếng Anh</h2><p>Chọn các bài hát với lời dễ hiểu và nghe lặp lại nhiều lần. Giai điệu giúp bạn nhớ từ vựng một cách tự nhiên.</p><h2>5. Luyện viết câu ví dụ</h2><p>Với mỗi từ mới, hãy tự đặt ít nhất một câu ví dụ sử dụng từ đó trong ngữ cảnh thực tế.</p>',
                'status'   => 'published',
                'category' => 'meo-hoc-tieng-anh',
                'tags'     => ['tu-vung', 'hoc-sinh', 'kinh-nghiem'],
                'published_at' => '2026-01-15 09:00:00',
            ],
            [
                'title'    => 'Phương pháp 6P-BeA: Bí quyết học tiếng Anh thành công',
                'slug'     => 'phuong-phap-6p-bea-bi-quyet-hoc-tieng-anh',
                'excerpt'  => 'Phương pháp 6P-BeA được phát triển từ nhiều năm nghiên cứu và giảng dạy thực tế, giúp học viên tiến bộ nhanh chóng và bền vững.',
                'content'  => '<p>Phương pháp 6P-BeA là nền tảng của mọi chương trình học tại BEA English. Được xây dựng dựa trên 6 nguyên tắc cốt lõi: Personalized, Practice, Partnership, Purposeful, Progress, và Practical.</p><p>Mỗi nguyên tắc đóng vai trò quan trọng trong hành trình học tiếng Anh của học viên, đảm bảo việc học không chỉ hiệu quả mà còn thú vị và có mục tiêu rõ ràng.</p>',
                'status'   => 'published',
                'category' => 'tin-tuc-bea',
                'tags'     => ['kinh-nghiem', 'hoc-sinh', 'nguoi-lon'],
                'published_at' => '2026-01-20 10:00:00',
            ],
            [
                'title'    => 'IELTS 6.5+ trong 6 tháng: Có thể không?',
                'slug'     => 'ielts-65-trong-6-thang-co-the-khong',
                'excerpt'  => 'Nhiều người đặt mục tiêu IELTS 6.5+ trong thời gian ngắn. Vậy điều này có thực sự khả thi không? Cùng BEA English phân tích.',
                'content'  => '<p>Đạt IELTS 6.5+ trong 6 tháng là mục tiêu của nhiều học viên. Câu trả lời là: Có thể, nhưng phụ thuộc vào nhiều yếu tố.</p><h2>Điều kiện để đạt mục tiêu</h2><ul><li>Trình độ khởi điểm từ 4.5-5.0</li><li>Thời gian học tập ít nhất 3-4 giờ mỗi ngày</li><li>Phương pháp học đúng đắn và có hệ thống</li><li>Giáo viên hướng dẫn chất lượng cao</li></ul><p>Với sự hỗ trợ của BEA English, nhiều học viên đã đạt được mục tiêu này và hơn thế nữa.</p>',
                'status'   => 'published',
                'category' => 'ielts',
                'tags'     => ['ielts', 'kinh-nghiem'],
                'published_at' => '2026-02-01 08:30:00',
            ],
            [
                'title'    => 'Luyện phát âm tiếng Anh chuẩn: Hướng dẫn từ A đến Z',
                'slug'     => 'luyen-phat-am-tieng-anh-chuan-huong-dan',
                'excerpt'  => 'Phát âm đúng là nền tảng để giao tiếp tự tin. Bài viết này hướng dẫn bạn cách luyện phát âm tiếng Anh chuẩn từ bước đầu.',
                'content'  => '<p>Phát âm là một trong những kỹ năng quan trọng nhất trong tiếng Anh, nhưng cũng là kỹ năng mà nhiều người Việt Nam gặp khó khăn nhất.</p><h2>Bước 1: Học bảng phiên âm IPA</h2><p>Bảng phiên âm quốc tế (IPA) gồm 44 âm vị tiếng Anh. Nắm vững IPA giúp bạn đọc đúng bất kỳ từ nào trong từ điển.</p><h2>Bước 2: Luyện các âm khó</h2><p>Người Việt thường gặp khó khăn với các âm như /θ/, /ð/, /æ/, /ə/. Hãy dành thời gian luyện tập riêng cho những âm này.</p>',
                'status'   => 'published',
                'category' => 'meo-hoc-tieng-anh',
                'tags'     => ['phat-am', 'giao-tiep', 'kinh-nghiem'],
                'published_at' => '2026-02-10 09:00:00',
            ],
            [
                'title'    => 'Tại sao học tiếng Anh 1 kèm 1 hiệu quả hơn học nhóm?',
                'slug'     => 'tai-sao-hoc-tieng-anh-1-kem-1-hieu-qua-hon',
                'excerpt'  => 'Học 1 kèm 1 ngày càng được ưa chuộng. Hãy cùng tìm hiểu những lợi thế vượt trội so với hình thức học nhóm truyền thống.',
                'content'  => '<p>Mô hình học 1 kèm 1 mang lại nhiều lợi ích mà học nhóm không thể có được.</p><h2>Cá nhân hóa hoàn toàn</h2><p>Giáo viên có thể điều chỉnh nội dung và tốc độ giảng dạy theo đúng năng lực của từng học viên, không bị ảnh hưởng bởi trình độ chung của lớp.</p><h2>Thời gian thực hành nhiều hơn</h2><p>Trong lớp học nhóm 10 người, mỗi học viên chỉ có khoảng 5 phút để nói. Với 1 kèm 1, bạn có toàn bộ 50 phút để thực hành.</p>',
                'status'   => 'published',
                'category' => 'tin-tuc-bea',
                'tags'     => ['hoc-sinh', 'nguoi-lon', 'kinh-nghiem'],
                'published_at' => '2026-02-20 10:00:00',
            ],
            [
                'title'    => 'Ngữ pháp tiếng Anh: Các thì động từ quan trọng nhất',
                'slug'     => 'ngu-phap-tieng-anh-cac-thi-dong-tu-quan-trong',
                'excerpt'  => 'Nắm vững các thì động từ là chìa khóa để nói và viết tiếng Anh chính xác. Cùng ôn lại những thì quan trọng nhất.',
                'content'  => '<p>Tiếng Anh có 12 thì cơ bản, nhưng trong giao tiếp hằng ngày, chỉ cần thành thạo khoảng 6-7 thì là đủ.</p><h2>Thì hiện tại đơn (Simple Present)</h2><p>Dùng để diễn đạt sự thật hiển nhiên, thói quen, hoặc lịch trình cố định. Ví dụ: "She works every day."</p><h2>Thì hiện tại tiếp diễn (Present Continuous)</h2><p>Dùng cho hành động đang xảy ra tại thời điểm nói. Ví dụ: "I am studying English now."</p><h2>Thì quá khứ đơn (Simple Past)</h2><p>Dùng cho hành động đã hoàn thành trong quá khứ. Ví dụ: "She visited Paris last year."</p>',
                'status'   => 'published',
                'category' => 'ngu-phap',
                'tags'     => ['ngu-phap', 'hoc-sinh'],
                'published_at' => '2026-03-01 09:00:00',
            ],
            [
                'title'    => 'IELTS Writing Task 2: Bí quyết viết bài luận đạt band 7+',
                'slug'     => 'ielts-writing-task-2-bi-quyet-dat-band-7',
                'excerpt'  => 'Writing Task 2 thường là phần khó nhất trong IELTS. Những chiến lược này sẽ giúp bạn cải thiện điểm số đáng kể.',
                'content'  => '<p>IELTS Writing Task 2 yêu cầu viết một bài luận 250+ từ trong 40 phút. Đây là phần chiếm 2/3 điểm Writing.</p><h2>Cấu trúc bài luận chuẩn</h2><ul><li><strong>Introduction (2-3 câu):</strong> Paraphrase đề bài + nêu quan điểm chính</li><li><strong>Body 1 (4-6 câu):</strong> Ý chính 1 + ví dụ</li><li><strong>Body 2 (4-6 câu):</strong> Ý chính 2 + ví dụ</li><li><strong>Conclusion (2-3 câu):</strong> Tóm tắt và nhấn mạnh quan điểm</li></ul>',
                'status'   => 'published',
                'category' => 'ielts',
                'tags'     => ['ielts', 'kinh-nghiem'],
                'published_at' => '2026-03-10 08:00:00',
            ],
            [
                'title'    => '10 cụm từ vựng tiếng Anh thông dụng trong công việc',
                'slug'     => '10-cum-tu-vung-tieng-anh-thong-dung-trong-cong-viec',
                'excerpt'  => 'Tiếng Anh công sở đòi hỏi vốn từ vựng đặc thù. Đây là 10 cụm từ bạn sẽ gặp thường xuyên trong môi trường làm việc quốc tế.',
                'content'  => '<p>Môi trường làm việc quốc tế ngày càng phổ biến. Nắm vững từ vựng công sở giúp bạn tự tin hơn trong giao tiếp.</p><ol><li><strong>Touch base</strong> – liên lạc lại, cập nhật tình hình</li><li><strong>Circle back</strong> – quay lại vấn đề sau</li><li><strong>On the same page</strong> – hiểu nhau, đồng thuận</li><li><strong>Bandwidth</strong> – thời gian/năng lực để xử lý công việc</li><li><strong>Take ownership</strong> – chịu trách nhiệm</li></ol>',
                'status'   => 'published',
                'category' => 'tu-vung',
                'tags'     => ['tu-vung', 'nguoi-lon', 'giao-tiep'],
                'published_at' => '2026-03-20 10:00:00',
            ],
            [
                'title'    => 'Bí quyết luyện Speaking IELTS để đạt band 7.0',
                'slug'     => 'bi-quyet-luyen-speaking-ielts-dat-band-70',
                'excerpt'  => 'Speaking là phần nhiều thí sinh lo lắng nhất. Áp dụng đúng chiến lược, bạn hoàn toàn có thể đạt band 7.0 trong thời gian ngắn.',
                'content'  => '<p>IELTS Speaking được đánh giá theo 4 tiêu chí: Fluency & Coherence, Lexical Resource, Grammatical Range & Accuracy, Pronunciation.</p><h2>Luyện tập hằng ngày</h2><p>Dành ít nhất 20-30 phút mỗi ngày để nói tiếng Anh, kể cả khi một mình. Hãy mô tả những gì bạn thấy xung quanh bằng tiếng Anh.</p><h2>Học cách "filler" tự nhiên</h2><p>Sử dụng các cụm từ như "That\'s an interesting question", "Let me think about that" để có thêm thời gian suy nghĩ mà không bị mất điểm Fluency.</p>',
                'status'   => 'published',
                'category' => 'ielts',
                'tags'     => ['ielts', 'giao-tiep', 'kinh-nghiem'],
                'published_at' => '2026-04-01 09:00:00',
            ],
            [
                'title'    => 'Cách xây dựng thói quen học tiếng Anh mỗi ngày',
                'slug'     => 'cach-xay-dung-thoi-quen-hoc-tieng-anh-moi-ngay',
                'excerpt'  => 'Sự kiên trì và tính nhất quán quan trọng hơn việc học nhiều một lúc. Hãy tạo thói quen học tiếng Anh hằng ngày với những bước đơn giản này.',
                'content'  => '<p>Nghiên cứu cho thấy học 20 phút mỗi ngày hiệu quả hơn học 3 tiếng một lần mỗi tuần. Bí quyết nằm ở sự đều đặn.</p><h2>Bắt đầu nhỏ</h2><p>Đừng đặt mục tiêu quá lớn ngay từ đầu. Bắt đầu với 10-15 phút mỗi ngày, sau đó tăng dần.</p><h2>Gắn việc học vào thói quen sẵn có</h2><p>Học từ vựng trong lúc ăn sáng, nghe podcast khi đi làm, xem phim tiếng Anh buổi tối.</p>',
                'status'   => 'published',
                'category' => 'meo-hoc-tieng-anh',
                'tags'     => ['kinh-nghiem', 'hoc-sinh', 'nguoi-lon'],
                'published_at' => '2026-04-10 08:00:00',
            ],
            [
                'title'    => 'Phân biệt "a" và "an": Quy tắc đơn giản nhưng hay nhầm',
                'slug'     => 'phan-biet-a-va-an-quy-tac-don-gian',
                'excerpt'  => 'Nhiều người vẫn nhầm lẫn khi dùng "a" và "an". Bài viết này giải thích quy tắc một cách dễ hiểu nhất.',
                'content'  => '<p>Quy tắc cơ bản: dùng "an" trước từ bắt đầu bằng âm nguyên âm (/a/, /e/, /i/, /o/, /u/), dùng "a" trước âm phụ âm.</p><p>Lưu ý quan trọng: quy tắc dựa trên <em>âm</em>, không phải <em>chữ cái</em>.</p><ul><li>an hour (/aʊər/ – h câm, bắt đầu bằng nguyên âm)</li><li>a university (/juːnɪˈvɜːsɪti/ – bắt đầu bằng /j/, phụ âm)</li><li>an MBA (bắt đầu bằng /em/, nguyên âm)</li></ul>',
                'status'   => 'published',
                'category' => 'ngu-phap',
                'tags'     => ['ngu-phap', 'hoc-sinh'],
                'published_at' => '2026-04-20 10:00:00',
            ],
            [
                'title'    => 'BEA English tổ chức buổi học thử miễn phí tháng 5/2026',
                'slug'     => 'bea-english-to-chuc-buoi-hoc-thu-mien-phi-thang-5-2026',
                'excerpt'  => 'BEA English mở đăng ký học thử miễn phí trong tháng 5/2026. Cơ hội trải nghiệm phương pháp 6P-BeA trước khi đăng ký chính thức.',
                'content'  => '<p>Nhân dịp khai giảng mùa hè 2026, BEA English tổ chức chương trình học thử miễn phí 1 buổi cho học viên mới.</p><p>Học viên sẽ được trải nghiệm trực tiếp phương pháp 6P-BeA, gặp gỡ giáo viên và nhận tư vấn lộ trình học tập cá nhân hóa hoàn toàn miễn phí.</p><p><strong>Thời gian:</strong> 15/05/2026 – 31/05/2026<br><strong>Đăng ký:</strong> Liên hệ qua fanpage hoặc hotline</p>',
                'status'   => 'published',
                'category' => 'tin-tuc-bea',
                'tags'     => ['su-kien', 'khoa-hoc-moi', 'hoc-sinh', 'nguoi-lon'],
                'published_at' => '2026-05-01 08:00:00',
            ],
            [
                'title'    => 'Câu điều kiện trong tiếng Anh: Type 1, 2, 3 và mixed',
                'slug'     => 'cau-dieu-kien-trong-tieng-anh-type-1-2-3-mixed',
                'excerpt'  => 'Câu điều kiện là một trong những điểm ngữ pháp quan trọng và thường xuất hiện trong IELTS. Nắm vững 4 loại câu điều kiện để tự tin hơn.',
                'content'  => '<p>Câu điều kiện biểu đạt mối quan hệ nhân quả giữa hai mệnh đề. Có 4 loại cơ bản trong tiếng Anh.</p><h2>Type 0: Sự thật hiển nhiên</h2><p>If + simple present, simple present<br>Ví dụ: "If you heat water to 100°C, it boils."</p><h2>Type 1: Điều kiện có thể xảy ra</h2><p>If + simple present, will + V<br>Ví dụ: "If it rains tomorrow, I will stay home."</p><h2>Type 2: Điều kiện không có thật ở hiện tại</h2><p>If + simple past, would + V<br>Ví dụ: "If I were rich, I would travel the world."</p>',
                'status'   => 'published',
                'category' => 'ngu-phap',
                'tags'     => ['ngu-phap', 'ielts'],
                'published_at' => '2026-05-10 09:00:00',
            ],
            [
                'title'    => 'Từ vựng chủ đề môi trường: Chuẩn bị cho IELTS band 7+',
                'slug'     => 'tu-vung-chu-de-moi-truong-chuan-bi-ielts-band-7',
                'excerpt'  => 'Chủ đề môi trường xuất hiện thường xuyên trong IELTS Speaking và Writing. Đây là bộ từ vựng thiết yếu bạn cần nắm.',
                'content'  => '<p>Environmental topics are among the most common in IELTS. Here are essential vocabulary items to boost your score.</p><h2>Key terms</h2><ul><li><strong>Greenhouse gas emissions</strong> – khí thải nhà kính</li><li><strong>Carbon footprint</strong> – dấu chân carbon</li><li><strong>Renewable energy</strong> – năng lượng tái tạo</li><li><strong>Biodiversity</strong> – đa dạng sinh học</li><li><strong>Deforestation</strong> – phá rừng</li><li><strong>Sustainable development</strong> – phát triển bền vững</li></ul>',
                'status'   => 'published',
                'category' => 'tu-vung',
                'tags'     => ['tu-vung', 'ielts'],
                'published_at' => '2026-05-20 10:00:00',
            ],
            [
                'title'    => 'Hướng dẫn đăng ký thi IELTS tại Việt Nam năm 2026',
                'slug'     => 'huong-dan-dang-ky-thi-ielts-tai-viet-nam-2026',
                'excerpt'  => 'Bạn đã sẵn sàng thi IELTS? Bài viết này hướng dẫn chi tiết cách đăng ký thi, lịch thi và các địa điểm thi IELTS ở Việt Nam.',
                'content'  => '<p>IELTS được tổ chức hằng tháng tại nhiều thành phố lớn ở Việt Nam, bao gồm Hà Nội, TP.HCM, Đà Nẵng và một số tỉnh thành khác.</p><h2>Cách đăng ký</h2><ol><li>Truy cập website của British Council hoặc IDP Vietnam</li><li>Tạo tài khoản và điền thông tin cá nhân</li><li>Chọn ngày thi và địa điểm thi phù hợp</li><li>Thanh toán lệ phí (khoảng 4.5 triệu đồng)</li><li>Mang CMND/hộ chiếu đến ngày thi</li></ol>',
                'status'   => 'published',
                'category' => 'ielts',
                'tags'     => ['ielts', 'kinh-nghiem'],
                'published_at' => '2026-06-01 09:00:00',
            ],
            [
                'title'    => 'Collocations với "make" và "do": Phân biệt một lần và nhớ mãi',
                'slug'     => 'collocations-voi-make-va-do-phan-biet',
                'excerpt'  => '"Make" hay "do"? Đây là một trong những điểm nhầm lẫn phổ biến nhất. Học collocations giúp bạn dùng đúng một cách tự nhiên.',
                'content'  => '<p>Không có quy tắc tuyệt đối để phân biệt "make" và "do". Cách tốt nhất là học theo nhóm collocation.</p><h2>Dùng "make"</h2><ul><li>make a decision</li><li>make a mistake</li><li>make an effort</li><li>make progress</li><li>make a suggestion</li></ul><h2>Dùng "do"</h2><ul><li>do homework</li><li>do business</li><li>do the dishes</li><li>do research</li><li>do your best</li></ul>',
                'status'   => 'published',
                'category' => 'tu-vung',
                'tags'     => ['tu-vung', 'ngu-phap', 'hoc-sinh'],
                'published_at' => '2026-06-10 10:00:00',
            ],
            [
                'title'    => 'Lịch khai giảng khóa học hè 2026 tại BEA English',
                'slug'     => 'lich-khai-giang-khoa-hoc-he-2026-bea-english',
                'excerpt'  => 'Mùa hè là thời điểm vàng để tăng tốc tiếng Anh. BEA English mở đăng ký các khóa học hè 2026 với nhiều ưu đãi hấp dẫn.',
                'content'  => '<p>BEA English thông báo lịch khai giảng các khóa học hè 2026. Đây là cơ hội tuyệt vời để học viên tập trung cải thiện tiếng Anh trong thời gian nghỉ hè.</p><h2>Các khóa học</h2><ul><li>Tiếng Anh cho học sinh (A1 – B2): Khai giảng 15/06/2026</li><li>Tiếng Anh người lớn (A1 – B2): Khai giảng 20/06/2026</li><li>IELTS Intensive: Khai giảng 01/07/2026</li></ul><p>Đăng ký sớm nhận ưu đãi đặc biệt.</p>',
                'status'   => 'published',
                'category' => 'tin-tuc-bea',
                'tags'     => ['su-kien', 'khoa-hoc-moi', 'hoc-sinh', 'nguoi-lon'],
                'published_at' => '2026-06-15 08:00:00',
            ],
            [
                'title'    => 'Bài viết nháp: Kỹ năng đọc hiểu IELTS nâng cao',
                'slug'     => 'bai-viet-nhap-ky-nang-doc-hieu-ielts-nang-cao',
                'excerpt'  => 'Đây là bản nháp, chưa hoàn thiện.',
                'content'  => '<p>Nội dung đang được biên soạn...</p>',
                'status'   => 'draft',
                'category' => 'ielts',
                'tags'     => ['ielts'],
                'published_at' => null,
            ],
            [
                'title'    => 'Archived: Chương trình học offline năm 2025',
                'slug'     => 'archived-chuong-trinh-hoc-offline-nam-2025',
                'excerpt'  => 'Bài viết về chương trình cũ, đã lưu trữ.',
                'content'  => '<p>Chương trình học offline năm 2025 đã kết thúc. Cảm ơn sự quan tâm của các bạn.</p>',
                'status'   => 'archived',
                'category' => 'tin-tuc-bea',
                'tags'     => ['su-kien'],
                'published_at' => '2025-12-01 08:00:00',
            ],
        ];

        foreach ($articles as $row) {
            $article = Article::create([
                'title'               => $row['title'],
                'slug'                => $row['slug'],
                'excerpt'             => $row['excerpt'],
                'content'             => $row['content'],
                'status'              => $row['status'],
                'article_category_id' => $c($row['category']),
                'author_id'           => $managerId,
                'published_at'        => $row['published_at'],
            ]);

            if (!empty($row['tags'])) {
                $ids = array_filter(array_map($t, $row['tags']));
                $article->tags()->sync($ids);
            }
        }
    }
}
