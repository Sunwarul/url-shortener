<?php

namespace Tests\Feature;

use App\Models\Url;
use Tests\TestCase;
use App\Models\User;
use App\Services\ShortCodeGeneratorInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlShortenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_only_urls_belonging_to_authenticated_user()
    {
        $user = User::factory()->create();
        Url::factory()
            ->for($user, 'creator')
            ->create(['original_url' => 'https://example.com', 'short_code' => 'a12345']);

        $this->actingAs($user)
            ->get(route('urls.index'))
            ->assertInertia(
                fn($page) => $page
                    ->component('Urls/Index')
                    ->has('urls', 1) // Only one URL should be returned
                    ->where('urls.0.original_url', 'https://example.com')
            );
    }

    public function test_it_allows_guest_user_to_store_valid_url()
    {
        $mockShortCode = 'short123';

        // Mock the ShortCodeGeneratorInterface
        $mock = $this->mock(ShortCodeGeneratorInterface::class, function ($mock) use ($mockShortCode) {
            $mock->shouldReceive('generate')->once()->andReturn(
                Url::factory()->make(['short_code' => $mockShortCode])
            );
        });

        $this->withoutExceptionHandling();

        $this
            ->post(route('urls.store'), ['original_url' => 'https://example.com'])
            ->assertRedirect(route('urls.generated', $mockShortCode));
    }

    public function test_it_allows_authenticated_user_to_store_valid_url()
    {
        $user = User::factory()->create();
        $mockShortCode = 'short123';

        // Mock the ShortCodeGeneratorInterface
        $mock = $this->mock(ShortCodeGeneratorInterface::class, function ($mock) use ($mockShortCode) {
            $mock->shouldReceive('generate')->once()->andReturn(
                Url::factory()->make(['short_code' => $mockShortCode])
            );
        });

        $this->withoutExceptionHandling();

        $this->actingAs($user)
            ->post(route('urls.store'), ['original_url' => 'https://example.com'])
            ->assertRedirect(route('urls.index'));
    }
}
