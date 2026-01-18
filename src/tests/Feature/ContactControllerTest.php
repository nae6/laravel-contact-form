<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createCategory(): Category
    {
        return Category::create([
            'content' => 'テストカテゴリ',
        ]);
    }

    private function validInput(array $override = []): array
    {
        $category = $override['category'] ?? $this->createCategory();

        $data = [
            'last_name'   => '山田',
            'first_name'  => '太郎',
            'gender'      => 1,
            'email'       => 'test@example.com',
            'tel1'        => '090',
            'tel2'        => '1234',
            'tel3'        => '5678',
            'address'     => '東京都テスト区1-2-3',
            'building'    => 'テストビル101',
            'category_id' => $category->id,
            'detail'      => 'テストお問い合わせ内容',
        ];

        unset($override['category']);

        return array_merge($data, $override);
    }

    public function test_index_shows_contact_form()
    {
        $this->createCategory();

        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertSee('お問い合わせ');
    }

    public function test_confirm_stores_contact_in_session_and_shows_confirm_view()
    {
        $input = $this->validInput();

        $response = $this->post(route('confirm'), $input);

        $response->assertStatus(200);

        $response->assertSessionHas('contact');

        $contact = session('contact');

        $this->assertSame('09012345678', $contact['tel']);
        $this->assertSame('テストカテゴリ', $contact['category_name']);
        $this->assertSame('山田', $contact['last_name']);
        $this->assertSame('太郎', $contact['first_name']);
    }

    public function test_store_returns_419_when_session_missing()
    {
        $response = $this->post(route('thanks'));
        $response->assertStatus(419);
    }

    public function test_store_creates_contact_and_forgets_session()
    {
        $input = $this->validInput();

        $this->post(route('confirm'), $input)->assertStatus(200);

        $response = $this->post(route('thanks'));

        $response->assertStatus(200);

        $this->assertDatabaseHas('contacts', [
            'last_name'  => '山田',
            'first_name' => '太郎',
            'email'      => 'test@example.com',
            'tel'        => '09012345678',
            'detail'     => 'テストお問い合わせ内容',
        ]);

        $this->assertNull(session('contact'));
    }

    public function test_back_returns_419_when_session_missing()
    {
        $response = $this->post(route('contacts.back'));
        $response->assertStatus(419);
    }

    public function test_back_redirects_to_index_with_old_input()
    {
        $input = $this->validInput();

        $this->post(route('confirm'), $input)->assertStatus(200);

        $response = $this->post(route('contacts.back'));

        $response->assertStatus(302);
        $response->assertRedirect(route('index'));

        $response->assertSessionHasInput('last_name', '山田');
        $response->assertSessionHasInput('tel1', '090');
        $response->assertSessionHasInput('tel2', '1234');
        $response->assertSessionHasInput('tel3', '5678');

        $response->assertSessionMissing('tel');
        $response->assertSessionMissing('gender_label');
        $response->assertSessionMissing('category_name');
    }
}
