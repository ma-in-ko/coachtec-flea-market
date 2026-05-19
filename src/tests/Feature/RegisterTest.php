<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    /** @test */
    public function 名前が未入力の場合バリデーションエラー()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください',
        ]);
    }

    /** @test */
    public function メールアドレスが未入力の場合バリデーションエラー()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => '',
            'password' => 'password',
            'password_confirmation' =>'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください',
        ]);
    }

    /** @test */
    public function パスワードが未入力の場合バリデーションエラー()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@email.com',
            'password' => '',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください',
        ]);
    }

    /** @test */
    public function パスワード7文字以下の場合バリデーションエラー()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@email.com',
            'password' => 'pass',
            'password_confirmation' => 'pass'
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードは8文字以上で入力してください',
        ]);
    }

    /** @test */
    public function パスワード不一致の場合バリデーションエラー()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'passwort',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードと一致しません',
        ]);
    }

    /** @test */
    public function 正常入力の場合会員登録できる()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@email.com',
        ]);

        $response->assertRedirect('/email/verify');

    }

    /** @test */
    public function メールアドレスなしの場合バリデーションエラー()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください',
            ]);
    }

    /** @test */
    public function パスワードなしの場合バリデーションエラー()
    {
        $response = $this->post('/login', [
            'email' => 'test@email.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください',
        ]);
    }

    /** @test */
    public function 入力情報が間違っている場合バリデーションエラー()
    {
        $response = $this->post('/login', [
            'email' => 'tester@email.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }

    /** @test */
    public function 正しい情報が入力された場合ログインできる()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'login_test@email.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email' => 'login_test@email.com',
            'password' => 'password',
            ]);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect('/mypage/profile');

    }

    /** @test */
    public function ログアウトできる()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();

        $response->assertRedirect('/login');
    }

    /** @test */
    public function 全商品を取得できる()
    {
        $user = User::factory()->create();

        Item::create([
            'user_id' => $user->id,
            'name' => '腕時計',
            'brand' => 'Rolax',
            'condition' => '良好',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
        ]);

        Item::create([
            'user_id' => $user->id,
            'name' => 'HDD',
            'brand' => '西芝',
            'condition' => '目立った傷や汚れなし',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000,
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('腕時計');
        $response->assertSee('HDD');
    }

    /** @test */
    public function 購入済み商品はsoldと表示される()
    {
        $item = \App\Models\Item::factory()->create();

        \App\Models\Purchase::factory()->create([
            'item_id' => $item->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('sold');
    }

    /** @test */
    public function 自分が出品した商品は表示されない()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $myItem = \App\Models\Item::factory()->create([
            'user_id' => $user->id,
            'name' => '自分の商品',
        ]);

        $otherItem = \App\Models\Item::factory()->create([
            'name' => '他人の商品',
        ]);

        $response = $this->get('/');

        $response->assertDontSee('自分の商品');

        $response->assertSee('他人の商品');
    }

    /** @test */
    public function いいねした商品だけが表示される()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $likedItem = \App\Models\Item::factory()->create([
            'name' => 'いいね商品',
        ]);

        $notLikedItem = \App\Models\Item::factory()->create([
            'name' => '未いいね商品',
        ]);

        \App\Models\Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $likedItem->id,
        ]);

        $response = $this->get('/mylist');

        $response->assertSee('いいね商品');

        $response->assertDontSee('未いいね商品');
    }

    /** @test */
    public function マイリストの購入済み商品はSoldと表示される()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create([
            'name' => 'いいね商品',
        ]);

        \App\Models\Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        \App\Models\Purchase::factory()->create([
            'item_id' => $item->id,
        ]);

        $response = $this->get('/mylist');

        $response->assertSee('SOLD');
    }

    /** @test */
    public function 未承認の場合マイリストには何も表示されない()
    {
        $item = \App\Models\Item::factory()->create([
            'name' => 'テスト商品',
        ]);

        $response = $this->get('/mylist');

        $response->assertDontSee('テスト商品');
    }

    /** @test */
    public function 商品名で部分一致検索ができる()
    {
        \App\Models\Item::factory()->create([
            'name' => '赤いバッグ',
        ]);

        \App\Models\Item::factory()->create([
            'name' => '白い靴',
        ]);

        $response = $this->get('/?keyword=バッグ');

        $response->assertSee('赤いバッグ');

        $response->assertDontSee('白い靴');
    }

    /** @test */
    public function 検索状態がマイリストでも保持されている()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $response = $this->get('/mylist?keyword=バッグ');

        $response->assertSee('value="バッグ"', false);
    }

    /** @test */
    public function 商品詳細ページに必要な情報が表示される()
    {
        $user = \App\Models\User::factory()->create();

        $item = \App\Models\Item::factory()->create([
            'name' => '腕時計',
            'brand' => 'Rolax',
            'price' => 15000,
            'description' => 'テスト用商品です',
            'condition' => 1,
        ]);

        $category = \App\Models\Category::factory()->create([
            'name' => 'ファッション',
        ]);

        $item->categories()->attach($category->id);

        \App\Models\Like::factory()->create([
            'item_id' => $item->id,
        ]);

        \App\Models\Comment::factory()->create([
            'item_id' => $item->id,
            'user_id' => $user->id,
            'comment' => 'コメントです',
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('腕時計');

        $response->assertSee('Rolax');

        $response->assertSee('15,000');

        $response->assertSee('テスト用商品です');

        $response->assertSee('良好');

        $response->assertSee('ファッション');

        $response->assertSee('コメントです');

        $response->assertSee($user->name);
    }

    /** @test */
    public function 複数選択されたカテゴリが表示される()
    {
        $item = \App\Models\Item::factory()->create();

        $category1 = \App\Models\Category::factory()->create([
            'name' => 'ファッション',
        ]);

        $category2 = \App\Models\Category::factory()->create([
            'name' => '家電',
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('ファッション');

        $response->assertSee('家電');
    }

    /** @test */
    public function いいねした商品として登録できる()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        $response = $this->post("/item/{$item->id}/like");

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('1');
    }

    /** @test */
    public function 追加済みのいいねアイコンは色が変化する()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        \App\Models\Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('heart-pink.png');
    }

    /** @test */
    public function いいねを解除できる()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        \App\Models\Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->delete("/item/{$item->id}/like");

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('0');
    }

    /** @test */
    public function ログイン済みユーザーはコメントを送信できる()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        $this->post("/item/{$item->id}/comment", [
            'comment' => 'テストコメント',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('テストコメント');

        $response->assertSee('(1)');
    }

    /** @test */
    public function ログイン前ユーザーはコメントを送信できない()
    {
        $item = \App\Models\Item::factory()->create();

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => 'テストコメント',
        ]);

        $this->assertDatabaseMissing('comments', [
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function コメントが255文字以上の場合バリデーションエラー()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        $comment = str_repeat('a', 256);

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => $comment,
        ]);

        $response->assertSessionHasErrors([
            'comment'=> 'コメントは255文字以内で入力してください',
        ]);
    }

    /** @test */
    public function コメントが未入力の場合バリデーションエラー()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => '',
        ]);

        $response->assertSessionHasErrors([
            'comment',
        ]);
    }

    /** @test */
    public function 商品を購入できる()
    {
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        \App\Models\Profile::factory()->create([
            'user_id' => $user->id,
            'postal_code' => '123-4567',
            'address' => '東京都',
            'building' => 'テストビル',
        ]);

        $this->actingAs($user);

        $item = \App\Models\Item::factory()->create();

        \App\Models\Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->post("/purchase/{$item->id}", [
            'payment_method' => 1,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション',
        ]);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function 購入した商品はsoldと表示される()
    {
        $user = User::factory()->create();

        $item =Item::factory()->create();

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertSee('SOLD');
    }

    /** @test */
    public function 購入した商品がプロフィールの購入一覧に追加されている()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'name' => 'テスト商品',
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertSee('テスト商品');

    }

    /** @test */
    public function 支払い方法選択が反映される()
    {
        $user = User::factory()->create();

        Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)->withSession([
            'payment_method' => 1,
        ])->get('/purchase/' .$item->id);

        $response->assertSee('コンビニ支払い');
    }

    /**@test */
    public function 変更した住所が購入画面に反映される()
    {
        $user = User::factory()->create();

        Profile::factory()->create([
            'user_id' => $user->id,
            'postal_code' => '111-1111',
            'address' => '変更前住所',
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user)->put('/purchase/address/' . $item->id, [
            'postal_code' => '222-2222',
            'address' => '変更後住所',
            'building' => 'テストマンション',
        ]);

        $response = $this->actingAs($user)
            ->get('/purchase/' . $item->id);

        $response->assertSee('222-2222');
        $response->assertSee('変更後住所');
        $response->assertSee('テストマンション');
    }

    /** @test */
    public function 購入時に配送先住所が保存される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $this->actingAs($user)->withSession([
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル',
        ])
        ->post('/purchase/' . $item->id, [
            'payment_method' => 1,
        ]);

        $this->actingAs($user)->post('/purchase/' . $item->id, [
            'payment_method' => 1,
        ]);

        $this->assertDatabaseHas('purchases', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル',
        ]);
    }

    /** @test */
    public function プロフィール情報が正しく表示されるか()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
        ]);

        Profile::factory()->create([
            'user_id' => $user->id,
            'image' => 'test.jpeg',
        ]);

        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品',
        ]);

        $buyItem = Item::factory()->create([
            'name' =>'購入商品',
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $buyItem->id,
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertSee('テストユーザー');

        $response->assertSee('購入商品');
    }

    /** @test */
    public function プロフィール編集画面に初期値が表示される()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
        ]);

        Profile::factory()->create([
            'user_id' => $user->id,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'image' => 'test.jpeg',
        ]);

        $response = $this->actingAs($user)->get('/mypage/profile');

        $response->assertSee('テストユーザー');

        $response->assertSee('123-4567');

        $response->assertSee('東京都渋谷区');

        $response->assertSee('test.jpeg');
    }

    /** @test */
    public function 商品出品情報が保存される()
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->create('test.jpeg');

        $response = $this->actingAs($user)->post('/sell', [
            'image' => $image,
            'categories' => [1],
            'condition' => 1,
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 5000,
        ]);

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 5000,
            'condition' => 1,
        ]);
    }

    /** @test */
    public function 会員登録後に認証メールが送信される()
    {
        Notification::fake();
        
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = \App\Models\User::first();

        Notification::assertSentTo(
            $user,
            VerifyEmail::class
        );
    }
    /** @test */
    public function 認証はこちらからボタンを押すとメール認証サイトに遷移する()
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertSee('認証はこちらから');

        $response->assertSee(
            'href="http://localhost:8025"',
            false
        );
    }

    /** @test */
    public function メール認証完了後プロフィール設定画面に遷移する()
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('/mypage/profile');
    }
}