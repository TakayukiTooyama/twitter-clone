document.addEventListener('DOMContentLoaded', function() {
    // アラートメッセージの要素を取得
    const alertSuccess = document.querySelector('.alert-success');

    // 成功アラートがあれば3秒後に消す
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.display = 'none';
        }, 3000);
    }

    // 入力フィールド全てにイベントリスナーを設定
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', () => {
            // フォームにフォーカスがあたった際にアラートを消す
            if (alertSuccess) {
                alertSuccess.style.display = 'none';
            }
        });
    });

    // 更新ボタン以外でのEnterを無効化
    const form = document.getElementById('user-form');
    form.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && e.target.type !== 'submit') {
            e.preventDefault();
        }
    });

    // パスワードの表示/非表示を切り替える
    function togglePasswordVisibility(passwordFieldId, iconFieldId) {
        const passwordField = document.getElementById(passwordFieldId);
        const passwordIcon = document.getElementById(iconFieldId);

        passwordIcon.addEventListener('click', () => {
            // パスワード入力のtype属性を切り替える
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            // アイコンのクラスを切り替える
            passwordIcon.classList.toggle('fa-eye');
            passwordIcon.classList.toggle('fa-eye-slash');
        });
    }

    // 新しいパスワードと確認フィールドの表示/非表示切り替え
    togglePasswordVisibility('password', 'togglePasswordIcon');
    togglePasswordVisibility('password_confirmation', 'togglePasswordConfirmationIcon');
});
