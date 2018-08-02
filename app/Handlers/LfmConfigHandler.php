<?php

namespace App\Handlers;
use Auth;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        //return parent::userField();
        // Yönetici olarak login olduktan sonra çalışsın
        // config içerisinde lfm.php içerisinde düzenleme yapıyoruz.
        // 'middlewares' => ['web', 'auth'] alanında auth yerine yonetim yazıyoruz.
        // 'user_field' => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class, lfm.php içerisinde bu alanı şuan bu dosya yolunu gösteriyoruz.
        // 'base_directory' => 'public', ile yüklemelerimizi nereye yapacaksak ona göre ayarlamamız gerekmektedir. public/uploads
        // sadece yönetici girişi yapanların file manager kullanabilmesi için bu işlemleri yapıyoruz.
        return Auth::guard('yonetim')->user()->id;
    }
}
