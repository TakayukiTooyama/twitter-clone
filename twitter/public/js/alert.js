document.addEventListener('DOMContentLoaded', function () {
    // アラートメッセージの要素を取得
    const alertSuccess = document.querySelector('.alert-success');

    // 成功アラートがあれば3秒後に消す
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.display = 'none';
        }, 3000);
    }
})
