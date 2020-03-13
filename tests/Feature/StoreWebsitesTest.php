<?php

namespace Tests\Feature;

use App\Website;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreWebsitesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test * */
    public function can_create_a_website()
    {
        $rawWebsite = factory(Website::class)->raw();

        $this->json('post', route('websites.store'), $rawWebsite);

        $this->assertDatabaseHas('websites', [
            'name' => $rawWebsite['name'],
            'url' => $rawWebsite['url'],
        ]);
    }

    /** @test **/
    public function cant_create_website_with_dublicate_url()
    {
        $firstRawWebsite = factory(Website::class)->raw(['url' => 'https://google.lt']);

        $this->json('post', route('websites.store'), $firstRawWebsite);

        $secondRawWebsite = factory(Website::class)->raw(['url' => 'https://google.lt']);

        $this->json('post', route('websites.store'), $secondRawWebsite)->assertJsonValidationErrors('url');

        $this->assertDatabaseMissing('websites', ['name' => $secondRawWebsite['name']]);
    }
}
