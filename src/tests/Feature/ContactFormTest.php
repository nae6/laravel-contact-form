<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private function validData()
    {
        $category = Category::create([
            'content' => 'テストカテゴリ',
        ]);

        return [
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
    }

    public function test_can_move_to_confirm_page_with_valid_input()
    {
        $response = $this->post(route('confirm'), $this->validData());

        $response->assertStatus(200);
        $response->assertSee('Confirm');
    }

    public function test_contact_is_saved_after_thanks_post()
    {
        $data = $this->validData();

        $this->post(route('confirm'), $data)->assertStatus(200);
        $response = $this->post(route('thanks'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('contacts', [
            'last_name'  => '山田',
            'first_name' => '太郎',
            'email'      => 'test@example.com',
            'detail'     => 'テストお問い合わせ内容',
        ]);
    }

    public function test_validation_error_when_required_fields_are_missing()
    {
        $response = $this->post(route('confirm'), []);

        $response->assertSessionHasErrors([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'category_id',
            'detail',
        ]);
    }

    public function test_validation_error_when_email_is_invalid()
    {
        $data = $this->validData();
        $data['email'] = 'invalid-email';

        $response = $this->post(route('confirm'), $data);

        $response->assertSessionHasErrors(['email']);
    }
}
