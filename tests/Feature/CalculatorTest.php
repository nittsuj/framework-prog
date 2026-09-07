<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    public function test_calculator_page_renders_at_hitung(): void
    {
        $this->get('/hitung')
            ->assertOk()
            ->assertSee('Kalkulator Dinamis');
    }

    public function test_calculation_route_displays_multiplication_result(): void
    {
        $this->get('/hitung/10/5/kali')
            ->assertOk()
            ->assertSee('Hasil dari 10 kali 5 adalah 50');
    }

    public function test_calculator_form_redirects_to_required_route(): void
    {
        $this->get('/hitung?angka1=10&angka2=5&operasi=kali')
            ->assertRedirect('/hitung/10/5/kali');
    }

    public function test_division_by_zero_shows_a_helpful_message(): void
    {
        $this->get('/hitung/10/0/bagi')
            ->assertOk()
            ->assertSee('Pembagian dengan nol tidak dapat dilakukan.');
    }
}
