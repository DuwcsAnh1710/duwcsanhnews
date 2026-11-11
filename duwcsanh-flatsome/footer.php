</main>
<footer class="news-foot">
<div class="news-shell">
<div class="news-footer-grid">
<div class="news-footer-about">
<a class="news-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="news-wordmark">DuwcsAnh<span>NEWS</span></span></a>
<p>Văn hóa, đời sống và nghề nghiệp qua các bản tin có nguồn tham khảo rõ ràng.</p>
<p>Dự án tạp chí cá nhân phục vụ học tập.</p>
</div>
<div><h2>Chuyên mục</h2><nav aria-label="Chuyên mục ở chân trang">
<?php foreach ( dan_sections() as $term ) printf( '<a href="%s">%s</a>', esc_url( get_category_link( $term ) ), esc_html( $term->name ) ); ?>
</nav></div>
<div><h2>Về DuwcsAnh News</h2><nav aria-label="Thông tin dự án">
<?php
foreach ( array( 'gioi-thieu', 'lien-he', 'chinh-sach-rieng-tu' ) as $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page && $page->post_status === 'publish' ) printf( '<a href="%s">%s</a>', esc_url( get_permalink( $page ) ), esc_html( $page->post_title ) );
}
?>
<a href="<?php echo esc_url( get_feed_link() ); ?>">Theo dõi qua RSS</a>
</nav></div>
</div>
<div class="news-footer-bottom"><p>© <?php echo esc_html( wp_date( 'Y' ) ); ?> DuwcsAnh News. Nguồn tin và quyền sử dụng ảnh được ghi trong từng bài.</p><a href="#wrapper">Về đầu trang</a></div>
</div>
</footer>
</div>

<button id="news-back-to-top" class="news-back-to-top" aria-label="Về đầu trang" title="Về đầu trang">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
</button>
<div id="news-toast" class="news-toast" aria-live="polite"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var headerWrapper = document.querySelector('.header-wrapper');
    if (headerWrapper) {
        var onScrollHeader = function() {
            if (window.scrollY > 110) {
                headerWrapper.classList.add('news-scrolled');
            } else {
                headerWrapper.classList.remove('news-scrolled');
            }
        };
        window.addEventListener('scroll', onScrollHeader, { passive: true });
        onScrollHeader();
    }

    document.querySelectorAll('.news-sticky-brand').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if ((window.location.pathname === '/' || window.location.pathname === '') && window.location.search === '') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });

    var btt = document.getElementById('news-back-to-top');
    if (btt) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 350) {
                btt.classList.add('visible');
            } else {
                btt.classList.remove('visible');
            }
        }, { passive: true });
        btt.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    var progressBar = document.getElementById('news-progress-bar');
    if (progressBar) {
        window.addEventListener('scroll', function() {
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (docHeight > 0) {
                var ratio = Math.min(1, Math.max(0, window.scrollY / docHeight));
                progressBar.style.transform = 'scaleX(' + ratio + ')';
            }
        }, { passive: true });
    }

    // Article Reader Controls (Font size & Warm Paper Mode)
    var articleReader = document.getElementById('news-article-reader');
    var fontBtns = document.querySelectorAll('.btn-reader-font');
    var paperBtn = document.getElementById('btn-reader-paper');
    var sizeMap = { sm: '1.02rem', md: '1.15rem', lg: '1.32rem' };

    if (articleReader && fontBtns.length) {
        var savedSize = localStorage.getItem('dan_reader_size') || 'md';
        if (sizeMap[savedSize]) {
            articleReader.style.setProperty('--reader-font-size', sizeMap[savedSize]);
            fontBtns.forEach(function(b) {
                b.classList.toggle('is-active', b.getAttribute('data-size') === savedSize);
            });
        }
        fontBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var sz = btn.getAttribute('data-size');
                if (sizeMap[sz]) {
                    articleReader.style.setProperty('--reader-font-size', sizeMap[sz]);
                    localStorage.setItem('dan_reader_size', sz);
                    fontBtns.forEach(function(b) { b.classList.toggle('is-active', b === btn); });
                }
            });
        });
    }

    if (paperBtn) {
        var savedWarm = localStorage.getItem('dan_reader_warm') === '1';
        if (savedWarm) {
            document.body.classList.add('is-warm-paper');
            paperBtn.classList.add('is-active');
            paperBtn.setAttribute('aria-pressed', 'true');
        }
        paperBtn.addEventListener('click', function() {
            var active = document.body.classList.toggle('is-warm-paper');
            paperBtn.classList.toggle('is-active', active);
            paperBtn.setAttribute('aria-pressed', active ? 'true' : 'false');
            localStorage.setItem('dan_reader_warm', active ? '1' : '0');
        });
    }

    var copyBtn = document.querySelector('.btn-copy');
    var toast = document.getElementById('news-toast');
    if (copyBtn && toast) {
        copyBtn.addEventListener('click', function() {
            var url = copyBtn.getAttribute('data-url') || window.location.href;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(function() {
                    toast.textContent = 'Đã sao chép liên kết bài viết!';
                    toast.classList.add('show');
                    setTimeout(function() { toast.classList.remove('show'); }, 2200);
                }).catch(function() {
                    fallbackCopy(url);
                });
            } else {
                fallbackCopy(url);
            }
        });
        function fallbackCopy(text) {
            var input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            toast.textContent = 'Đã sao chép liên kết bài viết!';
            toast.classList.add('show');
            setTimeout(function() { toast.classList.remove('show'); }, 2200);
        }
    }
});
</script>
<?php wp_footer(); ?>
</body></html>
