<?php

namespace Tests\Unit;

use App\Http\Controllers\RiwayatController;
use App\Models\Riwayat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; // Import the correct TestCase class
use Illuminate\Http\Request;

class viewRiwayattest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the filter method in RiwayatController.
     *
     * @return void
     */
    public function testFilter()
    {
        // Create sample data using model factory
        $riwayat1 = Riwayat::factory()->create([
            'tanggal' => '2022-01-01',
            'ruangan' => 'RoomA',
        ]);

        $riwayat2 = Riwayat::factory()->create([
            'tanggal' => '2022-01-02',
            'ruangan' => 'RoomB',
        ]);

        // Call the filter method in RiwayatController with real data
        $riwayatController = new RiwayatController();
        $request = new Request([
            'start_date' => '2022-01-01',
            'end_date' => '2022-01-02',
            'room' => 'RoomA',
        ]);

        $response = $riwayatController->filter($request);

        // Assert that the response is a view
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        // Assert that the view contains the filtered data
        $this->assertViewHas('data', [$riwayat1]);

        // Assert that the view contains the available rooms for dropdown
        $this->assertViewHas('ruangans', ['RoomA', 'RoomB']);
    }
}
