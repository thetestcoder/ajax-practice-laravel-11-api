<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_get_the_list_of_books()
    {
        $response = $this->get('/api/books');
        $response->assertJsonStructure([
            'books' => [
                '*' => ['id', 'title', 'author'],
            ],
        ]);
        $response->assertStatus(200);
    }

    public function test_it_can_get_a_single_book(){
        $book = \App\Models\Book::factory()->create();
        $response = $this->get('/api/books/'.$book->id);
        $response->assertJsonStructure([
            'book' => ['id', 'title', 'author'],
        ]);
        $response->assertStatus(200);
    }

    public function test_it_can_create_a_new_book(){
        $response = $this->post('/api/books', [
            'title' => 'Test Book',
            'author' => 'Test Author'
        ]);

        $response->assertJsonStructure([
            'book' => ['id', 'title', 'author'],
        ]);

        $response->assertStatus(201);
    }

    public function test_it_can_return_404_for_non_existent_book(){
        $response = $this->get('/api/books/100');
        $response->assertStatus(404);
    }

    public function test_it_can_return_422_for_invalid_book_data(){
        $response = $this->json('POST', '/api/books', [
            'title' => '',
            'author' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'title',
                'author',
            ],
        ]);
    }

    public function test_it_can_delete_a_book(){
        $book = \App\Models\Book::factory()->create();
        $response = $this->delete('/api/books/'.$book->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_it_can_update_a_book(){
        $book = \App\Models\Book::factory()->create();
        $response = $this->put('/api/books/'.$book->id, [
            'title' => 'Updated Test Book',
            'author' => 'Updated Test Author'
        ]);

        $response->assertJsonStructure([
            'book' => ['id', 'title', 'author'],
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Updated Test Book', 'author' => 'Updated Test Author']);
    }
}
