<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Guests should be redirected from the home page to the login page.
     */
    public function test_guest_is_redirected_to_login_from_home_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }
}