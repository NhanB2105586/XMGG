<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Hangmuc;

class HangmucController extends Controller
{
    private $hangmucModel;

    public function __construct()
    {
        parent::__construct();
        $this->hangmucModel = new Hangmuc($this->db);
    }

    public function showHangmucPage($slug)
    {
        $pageData = $this->hangmucModel->getHangmucPageBySlug($slug);
        
        if (!$pageData) {
            // Nếu không tìm thấy dữ liệu, hiển thị trang mặc định
            $this->sendPage("user/{$slug}", []);
            return;
        }

        // Hiển thị trang với dữ liệu từ database
        $this->sendPage("user/hangmuc_template", [
            'pageData' => $pageData,
            'slug' => $slug
        ]);
    }

    public function showTran()
    {
        $this->showHangmucPage('tran');
    }

    public function showLam()
    {
        $this->showHangmucPage('lam');
    }

    public function showSan()
    {
        $this->showHangmucPage('san');
    }

    public function showVach()
    {
        $this->showHangmucPage('vach');
    }

    public function showCua()
    {
        $this->showHangmucPage('cua');
    }

    public function showCauthang()
    {
        $this->showHangmucPage('cauthang');
    }

    public function showHangrao()
    {
        $this->showHangmucPage('hangrao');
    }

    public function showBonhoa()
    {
        $this->showHangmucPage('bonhoa');
    }
}
