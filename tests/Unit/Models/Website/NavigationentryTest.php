<?php

namespace Tests\Unit\Models\Website;

use Illuminate\Support\Str;
use App\Models\Website\Navigationentry;
use Tests\Factories\Website\NavigationentryFactory;
use Tests\TestCase;
use Tests\UsesTenant;

class NavigationentryTest extends TestCase
{
    use UsesTenant;

    /** @test */
    public function a_new_order_can_be_set_for_navigationentries()
    {
        $navigationentries = NavigationentryFactory::times(3)();

        // After creating, the order should be the same as the id
        Navigationentry::get(['id', 'order'])
            ->each(fn ($e) => $this->assertSame((int)$e->id, (int)$e->order));

        $reverseOrderedIds = $navigationentries->sortByDesc('order')->values()->pluck('id')->toArray();
        Navigationentry::setNewOrder($reverseOrderedIds);

        // After reordering, the order should be reversed
        Navigationentry::get(['id', 'order'])
            ->each(fn ($e) => $this->assertSame((int)$e->id, 4 - $e->order));
    }

    /** @test */
    public function it_strips_invalid_characters_from_slugs()
    {
        $navigationentry = NavigationentryFactory::new();

        $this->assertEquals(Str::slug($navigationentry->slug), $navigationentry->slug);

        $navigationentry->update(['slug' => 'Slug with space']);
        $this->assertEquals(Str::slug($navigationentry->slug), $navigationentry->slug);

        $navigationentry->update(['slug' => '!Ümlauts aren\'t allowed']);
        $this->assertEquals(Str::slug($navigationentry->slug), $navigationentry->slug);
    }
}
