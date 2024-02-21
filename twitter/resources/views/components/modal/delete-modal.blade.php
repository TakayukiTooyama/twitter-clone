@props(['label' => '', 'route' => '', 'userId' => null, 'tweetId' => null])

<div id="deleteModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $label }}削除の確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                本当に削除してもよろしいですか？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary -mr-4" data-bs-dismiss="modal">閉じる</button>
                <form method="POST"
                    action={{ route($route, array_filter(['userId' => $userId, 'tweetId' => $tweetId])) }}>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
