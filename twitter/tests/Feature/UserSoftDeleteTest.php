<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testUserSoftDelete()
    {
        // 新しいユーザーを作成
        $user = User::factory()->create();

        // ユーザーを削除
        $user->delete();

        // 削除されたユーザーがデータベースに存在するかを確認
        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);

        // ソフトデリートされたユーザーを取得
        $deletedUser = User::withTrashed()->find($user->id);

        // ソフトデリートされたユーザーが存在するかを確認
        $this->assertNotNull($deletedUser);

        // ソフトデリートされたユーザーが確かに削除されているかを確認
        $this->assertNotNull($deletedUser->deleted_at);
    }
}
