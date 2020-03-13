<?php

namespace Tests\Feature;

use App\Website;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexWebsitesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test * */
    public function can_get_list_of_all_websites()
    {
        $websites = factory(Website::class, 5)->create();

        $this->json('get', route('websites.index'))
            ->assertJson([
                'data' => $websites->map(function (Website $website) {
                    return $website->only('id', 'name', 'url');
                })->toArray(),
            ]);
    }

    /** @test * */
    public function can_order_by_fields()
    {
        $websites = factory(Website::class, 5)->create();

        $this->json('get', route('websites.index', ['order_field' => 'created_at']))
            ->assertJson([
                'data' => $websites->map(function (Website $website) {
                    return $website->only('id', 'name', 'url');
                })->toArray(),
            ]);
    }

    /** @test * */
    public function can_order_in_descending_order()
    {
        $websites = factory(Website::class, 5)->create();

        $this->json('get', route('websites.index', ['order_field' => 'created_at', 'order_direction' => 'desc']))
            ->assertJson([
                'data' => $websites->sortByDesc('created_at')
                    ->map(function (Website $website) {
                        return $website->only('id', 'name', 'url');
                    })
                    ->values()
                    ->toArray(),
            ]);
    }

    /** @test * */
    public function can_filter_by_name()
    {
        factory(Website::class)->create(['name' => 'the text is here']);

        $this->json('get', route('websites.index', ['q' => 'here']))
            ->assertSee('the text is here');

        $this->json('get', route('websites.index', ['q' => 'heree']))
            ->assertDontSee('the text is here');
    }
}
