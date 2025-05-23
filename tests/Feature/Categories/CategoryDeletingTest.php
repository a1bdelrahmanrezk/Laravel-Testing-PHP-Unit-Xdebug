<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDeletingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_delete_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('categories.destroy', $category));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success', 'Category deleted successfully');

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
