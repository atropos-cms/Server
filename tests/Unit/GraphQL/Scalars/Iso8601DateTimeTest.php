<?php

namespace Tests\Unit\GraphQL\Scalars;

use Carbon\Carbon;
use Tests\TestCase;
use App\GraphQL\Scalars\Iso8601DateTime;

class Iso8601DateTimeTest extends TestCase
{
    /** @test */
    public function it_serializes_a_carbon_instance_to_an_iso8601_string()
    {
        $knownDate = Carbon::create(2001, 5, 21, 12);

        $instance = new Iso8601DateTime();
        $result = $instance->serialize($knownDate);

        $this->assertEquals('2001-05-21T12:00:00+00:00', $result);
    }

    /** @test */
    public function it_serializes_a_string_to_an_iso8601_string()
    {
        $instance = new Iso8601DateTime();
        $result = $instance->serialize('2001-05-21T12:00:00+00:00');

        $this->assertEquals('2001-05-21T12:00:00+00:00', $result);
    }

    /** @test */
    public function it_can_parse_an_iso8601_string()
    {
        $knownDate = Carbon::create(2001, 5, 21, 12);

        $instance = new Iso8601DateTime();
        $result = $instance->parseValue('2001-05-21T12:00:00+00:00');

        $this->assertTrue($result->equalTo($knownDate));
    }

    /** @test */
    public function it_throws_a_graphql_error_when_parsing_fails()
    {
        $this->expectException(\GraphQL\Error\Error::class);

        $instance = new Iso8601DateTime();
        $instance->parseValue('2001-05-21 12:00:00');
    }
}
