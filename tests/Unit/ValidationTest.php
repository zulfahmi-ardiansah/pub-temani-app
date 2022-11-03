<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

use Tests\TestCase;

use Validator;

class ValidationTest extends TestCase
{
    /**
     * Login validation with valid data
     *
     * @return void
     */
    public function test_login_validation_with_valid_data ()
    {
        $validator = Validator::make([
            'us_email' => 'baskara@temani.id',
            'us_password' => '123456'
        ], [
            'us_email' => 'required',
            'us_password' => 'required',
        ]);

        $this->assertFalse($validator->fails());
    }

    
    /**
     * Login validation with invalid data
     *
     * @return void
     */
    public function test_login_validation_with_invalid_data ()
    {
        $validator = Validator::make([
            'us_email' => 'baskara@temani.id',
        ], [
            'us_email' => 'required',
            'us_password' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }

    /**
     * Report creation validation with valid data
     *
     * @return void
     */
    public function test_report_creation_validation_with_valid_data ()
    {
        $validator = Validator::make([
            'he_title' => '[Test-' . rand(111,999) . '-' . date('YmdHi') . '] Maraknya Begal Di Tangerang Selatan',
            'he_description' => 'Mohon bagi pihak berwajib untuk menangani maraknya begal saat ini. Beberapa warga telah menjadi korban dan kami sebagai masyarakat tidak ingin ada korban dari pembegalan kembali. Dari beberapa informasi warga menyebutkan aktivitas begal terjadi di pukul 10 malam. Mohon sekali lagi tindak lanjutnya, terimakasih.',
            'he_place' => 'Tangerang Selatan',
            'he_time' => '22:00',
            'he_date' => '2022-11-02',
            'he_place_lat' => '-6.281530',
            'he_place_long' => '106.729871',
            'he_category' => '1',
            'he_image' => public_path('\assets\img\icon\test_case_temani.jpg')
        ], [
            'he_title' => 'required',
            'he_description' => 'required',
            'he_place' => 'required',
            'he_image' => 'required',
            'he_time' => 'required',
            'he_date' => 'required',
        ]);

        $this->assertFalse($validator->fails());
    }

    
    /**
     * Report creation validation with invalid data
     *
     * @return void
     */
    public function test_report_creation_validation_with_invalid_data ()
    {
        $validator = Validator::make([
            'he_title' => '[Test-' . rand(111,999) . '-' . date('YmdHi') . '] Maraknya Begal Di Tangerang Selatan',
            'he_place' => 'Tangerang Selatan',
            'he_date' => '2022-11-02',
            'he_place_lat' => '-6.281530',
            'he_place_long' => '106.729871',
            'he_category' => '1',
        ], [
            'he_title' => 'required',
            'he_description' => 'required',
            'he_place' => 'required',
            'he_image' => 'required',
            'he_time' => 'required',
            'he_date' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }
}
