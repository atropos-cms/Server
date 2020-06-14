<?php

namespace Tests\Unit\Models\Website;

use App\Enums\ContentType;
use App\Models\Website\Navigationentry;
use Tests\GraphQLTestCase;
use Illuminate\Support\Str;
use Tests\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Website\NavigationentryFactory;

class NavigationentryTest extends GraphQLTestCase
{
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
}
