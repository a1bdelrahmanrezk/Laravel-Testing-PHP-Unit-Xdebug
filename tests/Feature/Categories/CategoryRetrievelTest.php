<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryRetrievelTest extends TestCase
{
    use DatabaseTruncation;
    use RefreshDatabase;

    protected function setUp(): void // function run before each test
    {
        parent::setUp(); // Call Testing Environment Methods
        $this->actingAs(User::factory()->create());
    }

    public function test_check_if_categories_page_contains_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 5; // issue in 4 (found in DB) + 5 (count) if we don't use DatabaseTruncation;
        });
    }

    public function test_check_if_pagination_works_successfully()
    {
        Category::factory()->count(15)->create();

        $response = $this->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 10;
        });

        $response = $this->get('/categories?page=2');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 5;
        });
    }

    public function test_check_if_categories_page_opens_successfully(): void
    {

        $response = $this->get('/categories');

        $response
            ->assertStatus(200)
            ->assertViewIs('categories.index')
            ->assertSeeText('Add New Category');
    }

    public function test_check_if_categories_show_page_contains_the_right_content(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.show', $category));

        $response
            ->assertStatus(200)
            ->assertViewIs('categories.show')
            ->assertViewHas('category', $category)
            ->assertSeeText($category->name)
            ->assertSeeText($category->description);
    }
}
