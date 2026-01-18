<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private function createCategory(): Category
    {
        return Category::create([
            'content' => 'テストカテゴリ',
        ]);
    }

    private function createContact(array $override = []): Contact
    {
        $category = $override['category'] ?? $this->createCategory();

        $data = array_merge([
            'category_id' => $category->id,
            'last_name'   => '山田',
            'first_name'  => '太郎',
            'gender'      => 1,
            'email'       => 'test@example.com',
            'tel'         => '09012345678',
            'address'     => '東京都テスト区1-2-3',
            'building'    => 'テストビル101',
            'detail'      => 'テストお問い合わせ内容',
        ], $override);

        unset($data['category']);

        return Contact::create($data);
    }

    public function test_admin_index_redirects_to_login_when_guest()
    {
        $response = $this->get(route('admin.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_admin_index_is_accessible_when_authenticated()
    {
        $user = User::factory()->create();
        $this->createContact();

        $response = $this->actingAs($user)->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertSee('山田');
    }

    public function test_admin_search_returns_200()
    {
        $user = User::factory()->create();
        $this->createContact(['detail' => 'お問い合わせA']);

        $response = $this->actingAs($user)->get(route('admin.search', [
            'keyword' => 'お問い合わせ',
            'gender' => 1,
            'category' => Category::first()->id,
        ]));

        $response->assertStatus(200);
    }

    public function test_admin_export_returns_csv()
    {
        $user = User::factory()->create();
        $this->createContact();

        $response = $this->actingAs($user)->get(route('admin.export'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition');

        $content = $response->streamedContent();

        $this->assertStringContainsString('ID', $content);
        $this->assertStringContainsString('カテゴリ', $content);
        $this->assertStringContainsString('姓', $content);
        $this->assertStringContainsString('お問い合わせ内容', $content);
    }

    public function test_admin_destroy_deletes_contact()
    {
        $user = User::factory()->create();
        $contact = $this->createContact();

        $response = $this->actingAs($user)->delete(route('admin.destroy', $contact));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.index'));

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
    }
}
