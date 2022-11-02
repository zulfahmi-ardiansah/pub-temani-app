<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BrowserTestCase;

class ReportTest extends BrowserTestCase
{

    public function test_login_with_valid_credential ()
    {
        $this->visit('/login');

        $login_form_data = [
            'us_email' => 'baskara@temani.id',
            'us_password' => '123456'
        ];

        foreach ($login_form_data as $form_key => $form_value) {
            $this->type($form_value, $form_key);
        }

        $this->press('submit-process');
        $this->seePageIs('/home');
    }

    public function test_report_creation_rendered_properly ()
    {
        $this->test_login_with_valid_credential();
        $this->visit('/report/create');
        $this->seePageIs('/report/create');
    }
    
    public function test_report_creation_with_valid_data ()
    {
        $this->test_login_with_valid_credential();

        $this->visit('/report/create');

        $report_form_data = [
            'he_title' => '[Test-' . rand(111,999) . '-' . date('YmdHi') . '] Maraknya Begal Di Tangerang Selatan',
            'he_description' => 'Mohon bagi pihak berwajib untuk menangani maraknya begal saat ini. Beberapa warga telah menjadi korban dan kami sebagai masyarakat tidak ingin ada korban dari pembegalan kembali. Dari beberapa informasi warga menyebutkan aktivitas begal terjadi di pukul 10 malam. Mohon sekali lagi tindak lanjutnya, terimakasih.',
            'he_place' => 'Tangerang Selatan',
            'he_time' => '22:00',
            'he_date' => '2022-11-02',
            'he_place_lat' => '-6.281530',
            'he_place_long' => '106.729871',
            'he_category' => '1',
            'he_image' => public_path('\assets\img\icon\test_case_temani.jpg')
        ];
        
        foreach ($report_form_data as $form_key => $form_value) {
            if ($form_key == 'he_image') {
                $this->attach($form_value, $form_key);
            } else {
                $this->type($form_value, $form_key);
            }
        }
        
        $this->press('submit-process');
        $this->seePageIs('/home');
        $this->seeText($report_form_data['he_title']);
    }

}
