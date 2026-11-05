let currentRating = 1; // Mặc định là 1 sao

// Hàm dùng chung để đổi màu các ngôi sao (dùng toggle cho ngắn gọn)
function highlightStars(rating) {
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById('star' + i);
        if (star) {
            star.classList.toggle('text-yellow-400', i <= rating);
            star.classList.toggle('text-gray-300', i > rating);
        }
    }
}

// 1. Mở Modal (tự động reset về 1 sao khi mở)
window.openReviewModal = function () {
    const modal = document.getElementById('reviewModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Đảm bảo mở lên luôn mặc định là 1 sao
    window.selectRating(1);
};

// 2. Đóng Modal
window.closeReviewModal = function () {
    const modal = document.getElementById('reviewModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

// 3. Khi bấm CHỌN số sao
window.selectRating = function (star) {
    currentRating = star;
    
    // Gán giá trị vào thẻ input (hỗ trợ cả id="rating" hoặc id="ratingValue")
    const ratingInput = document.getElementById('rating') || document.getElementById('ratingValue');
    if (ratingInput) {
        ratingInput.value = star;
    }
    
    highlightStars(star);
};

// 4. Khi RÊ CHUỘT vào sao
window.previewRating = function (star) {
    highlightStars(star);
};

// 5. Khi RÊ CHUỘT RA NGOÀI
window.resetRating = function () {
    highlightStars(currentRating);
};