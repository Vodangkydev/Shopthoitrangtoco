// Wishlist toggle (trái tim yêu thích)
document.addEventListener('DOMContentLoaded', function () {
    const wishButtons = document.querySelectorAll('.wishlist-toggle');
    wishButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const productId = btn.getAttribute('data-product-id');
            if (!productId) { return; }
            fetch('pages/main/yeuthich.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(productId) + '&ajax=1'
            })
                .then(res => res.json())
                .then(data => {
                    if (data && data.success) {
                        const isFav = !!data.favorited;
                        btn.classList.toggle('active', isFav);
                        btn.textContent = isFav ? '♥' : '♡';
                    }
                })
                .catch(() => { });
        });
    });
});

// Tự động cuộn nội dung chính ra giữa màn hình (trừ trang chủ index.php mặc định)
document.addEventListener('DOMContentLoaded', function () {
    // Bỏ qua nếu đang ở trang index.php mà không có tham số quanly (trang chủ)
    var path = window.location.pathname || '';
    var params = new URLSearchParams(window.location.search || '');
    if ((path.endsWith('/index.php') || path === '/index.php' || path === '' || path === '/') &&
        !params.has('quanly')) {
        return;
    }

    // Ưu tiên phần được đánh dấu data-scroll-focus, sau đó tới một số khối nội dung chính
    var focusEl = document.querySelector('[data-scroll-focus], .vanchuyen, .maincontent');
    if (!focusEl) return;

    // Nếu có thêm tham số no_scroll_focus=1 thì bỏ qua (dễ tắt nếu cần sau này)
    if (window.location.search.indexOf('no_scroll_focus=1') !== -1) return;

    setTimeout(function () {
        focusEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 200);
});

// Hiển thị hướng dẫn theo phương thức thanh toán (tiền mặt / chuyển khoản)
document.addEventListener('DOMContentLoaded', function () {
    var paymentRadios = document.querySelectorAll('input[name="payment"]');
    if (!paymentRadios.length) return;

    function updatePaymentInfo() {
        var checked = document.querySelector('input[name="payment"]:checked');
        var method = checked ? checked.value : '';
        var bankBox = document.querySelector('.payment-bank-transfer');
        var cashBox = document.querySelector('.payment-cash');

        if (bankBox) bankBox.style.display = (method === 'chuyenkhoan') ? 'block' : 'none';
        if (cashBox) cashBox.style.display = (method === 'tienmat' || method === '' || method === null) ? 'block' : 'none';
    }

    paymentRadios.forEach(function (radio) {
        radio.addEventListener('change', updatePaymentInfo);
    });

    // Gọi lần đầu để set trạng thái ban đầu
    updatePaymentInfo();
});

