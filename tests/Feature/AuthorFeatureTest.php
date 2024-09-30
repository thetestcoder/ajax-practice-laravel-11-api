<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_all_authors()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        Author::factory()->count(3)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/authors');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_user_can_create_author()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/authors', [
                'name' => 'J.K. Rowling',
            ]);

        $response->assertStatus(201)
            ->assertJson(['name' => 'J.K. Rowling']);
    }

    public function test_user_can_update_author()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $author = Author::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson("/api/authors/{$author->id}", [
                'name' => 'George Orwell',
            ]);

        $response->assertStatus(200)
            ->assertJson(['name' => 'George Orwell']);
    }

    public function test_user_can_delete_author()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $author = Author::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Author deleted successfully']);
    }

    public function test_non_logged_in_person_cant_access_authors_list()
    {
        Author::factory()->count(3)->create();

        $response = $this->getJson('/api/authors');

        $response->assertStatus(401);
    }

    public function test_non_logged_in_person_cant_create_author()
    {
        $response = $this
            ->postJson('/api/authors', [
                'name' => 'J.K. Rowling',
            ]);

        $response->assertStatus(401);
    }

    public function test_non_logged_in_person_cant_update_author()
    {
        $author = Author::factory()->create();
        $response = $this->putJson("/api/authors/{$author->id}", [
                'name' => 'George Orwell',
            ]);

        $response->assertStatus(401);
    }

    public function test_non_logged_in_person_cant_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(401);
    }
}
