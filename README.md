# DuwcsAnh News

## Phiên bản dùng Flatsome

Cài theme cha Flatsome từ bộ cài của bạn, sau đó tải lên **dist/duwcsanh-flatsome.zip** và kích hoạt **DuwcsAnh News – Flatsome**. WordPress cần cả hai thư mục theme. Trên site mới, đặt múi giờ thành Thành phố Hồ Chí Minh, cài **dist/duwcsanh-demo.zip** rồi bấm **Cập nhật nội dung có nguồn** tại Công cụ → DuwcsAnh News. Bộ nhập tạo 8 bài có nguồn, 3 trang thông tin và chuyển 25 bài thực hành của bản cũ về nháp.

Sửa bài và ảnh trong Bài viết/Media. Menu dùng vị trí Primary của Flatsome, mặc định lấy năm chuyên mục khi chưa gán menu. Ghim bài để chọn cho cột biên tập. Các layout báo nằm trong child theme, gồm trang chủ, lưu trữ chuyên mục và bài đơn. Hướng dẫn Site Editor bên dưới dành cho block theme độc lập ở phiên bản trước.


Tạp chí WordPress dành cho người trẻ Việt. Bản đầu dùng Gutenberg, nền giấy kem, chữ Georgia/Arial có sẵn trên máy và tranh minh họa theo chuyên mục.

## Chạy bằng Local trên Windows

1. Mở **Local** đã có trên máy. Bấm **+ → Create a new site**, đặt tên *DuwcsAnh News* và chọn môi trường Preferred. Tạo tài khoản quản trị riêng và lưu mật khẩu trong trình quản lý mật khẩu. Chọn Start site rồi WP Admin.
2. Trong Settings → General, đặt Site Title thành **DuwcsAnh News**, ngôn ngữ Tiếng Việt và múi giờ Thành phố Hồ Chí Minh. Các nhãn do WordPress cung cấp sẽ theo ngôn ngữ site.
3. Cài Flatsome, sau đó cài và kích hoạt child theme từ ZIP như hướng dẫn phía trên.
4. Cài plugin nội dung và chạy **Cập nhật nội dung có nguồn** một lần. Có thể tắt plugin sau khi nhập.
5. Trên **site mới**, chuyển bài “Hello world!” và trang “Sample Page” sang nháp nếu còn. Đặt Cài đặt → Đọc → Trang chủ hiển thị **bài viết mới nhất**. Chọn 3 bài mỗi trang để thử phân trang chuyên mục. Tại Đường dẫn tĩnh, chọn **Tên bài viết**, lưu rồi thử mở một bài từ trang chủ.
6. Chọn Open site trong Local. Lần sau chỉ cần mở Local và chọn Start site. Có thể sửa bố cục bằng Giao diện → Trình chỉnh sửa.

**Mã và dữ liệu nằm ở đâu?** Repo chứa mã nguồn theme trong `duwcsanhnews/`, plugin cùng dữ liệu mẫu trong `duwcsanh-demo/`, gói cài trong `dist/`. Trong Local, chọn Go to site folder: `app/public` là WordPress, `wp-content/themes` chứa theme, `wp-content/uploads` chứa ảnh đã nhập. Bài viết, tài khoản, cấu hình và các chỉnh sửa Site Editor nằm trong database riêng của site. Mở thẻ Database trong Local để xem. Khi sửa mã repo, đóng gói lại rồi cài gói mới hoặc đồng bộ thư mục theme vào site phát triển.

## Quản trị tạp chí

- **Đăng bài** tại Bài viết → Thêm mới. Viết tiêu đề, mô tả ngắn trong Tóm tắt, nội dung theo các khối tiêu đề cấp 2 và đoạn văn. Chọn một chuyên mục chính, thẻ liên quan và ảnh đại diện. Trong Media, nhập văn bản thay thế theo nội dung ảnh. Ghi nguồn và điều kiện sử dụng trong chú thích; nếu ảnh yêu cầu hiển thị ghi công công khai, thêm dòng ghi công ngay đầu nội dung bài.
- **Chọn bài trang bìa.** Tiêu điểm lấy bài mới nhất và hai bài liền sau. “Ban biên tập chọn” lấy tối đa ba bài ghim, theo ngày đăng. Dùng Sửa nhanh → Ghim bài viết để thay lựa chọn. “Đọc tiếp” bắt đầu từ bài thứ tư theo ngày đăng. Các mục còn lại lọc theo slug chuyên mục; giữ slug khi đổi tên hiển thị.
- **Sửa bố cục** trong Giao diện → Trình chỉnh sửa → Mẫu → Trang chủ (Front Page). Dùng danh sách khối để chọn vòng lặp truy vấn, ảnh hoặc tiêu đề. Xem trước ở trang thật sau khi lưu, nhất là các vòng lặp lọc chuyên mục và bài liên quan bằng PHP. Thay đổi lưu trong database ưu tiên hơn file theme; sao lưu trước khi xóa tùy chỉnh của mẫu.
- **Menu** đầu trang tự lấy năm chuyên mục đã nhập. Để đổi thứ tự, sửa phần mẫu Header, chọn khối Điều hướng và di chuyển liên kết. Nếu đã lưu Header trước khi nhập dữ liệu, thêm lại liên kết chuyên mục trong khối này. Footer dùng danh sách trang công khai; có thể thay bằng liên kết chọn tay.
- **Sửa chuyên mục** tại Bài viết → Chuyên mục. Mô tả xuất hiện ở trang lưu trữ. Chọn trang chính sách đã nhập trong Cài đặt → Riêng tư. Thay nội dung Liên hệ sau khi xác nhận có kênh tiếp nhận thật.
- **Bình luận** đóng ở bài mẫu. Nếu bật cho bài khác, vào Cài đặt → Thảo luận, yêu cầu duyệt thủ công rồi kiểm tra bằng cửa sổ riêng tư. Liên kết chia sẻ mở ứng dụng email của người đọc.
- **Chạy lại bộ nhập** bảo toàn bài đã sửa nhờ khóa riêng trong post meta. Những trang trùng slug có sẵn được giữ lại. Dữ liệu mẫu dùng tác giả là tài khoản thao tác nhập và ngày tháng 4/2025 giả lập; có thể đổi tên hiển thị trong Hồ sơ. Không có lượt xem hay bình luận được tạo bởi plugin.
- Nếu nhập lỗi, giữ plugin, kiểm tra dung lượng và quyền ghi uploads, rồi chạy lại lượt hiện tại. Nếu tiến trình PHP bị ngắt và khóa vẫn còn, xác nhận mọi lượt nhập đã dừng, sao lưu database rồi chạy `wp option delete dan_demo_lock` trong Site Shell của Local. Trên hosting không có WP-CLI, nhờ quản trị viên xóa đúng option này trong bảng options của site.

## Bàn giao

- [Cài mới lên InfinityFree và khôi phục](docs/hosting.md)
- [Nguồn nội dung và hình ảnh](docs/nguon.md)
- [Kết quả kiểm thử, ảnh chụp và checklist](docs/nghiem-thu.md)

## Nâng cấp lên 1.1

Cài đè cả hai ZIP, vào Công cụ → DuwcsAnh News và bấm một lượt nhập để bổ sung năm tin vào site đã có dữ liệu. Tin được tuyển chọn cho kỳ 05/11/2026. Ngày đăng của tin theo bài nguồn. Bộ nhập không tự lấy tin định kỳ. Nếu từng lưu mẫu Trang chủ hoặc Header riêng, sao lưu bản tùy chỉnh và đối chiếu mẫu mới trong Site Editor.
