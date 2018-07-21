<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Kullanici;

class KullaniciKayitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kullanici;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Kullanici $kullanici)
    {
        // mail şablonu içerisinde değişken kullanılacak ise bu şekilde tanımlama yapılması lazım.
        // buradaki değişken otomatik olarak view dosyasına gonderilir. Bizim ekstradan göndermemize gerek yoktur.
        $this->kullanici = $kullanici;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            // from kısmını kapattık cunku .env dosyası icerisinde tanımladık.
            //->from('topcueser@gmail.com')
            ->subject(config('app.name') . ' - Kullanıcı Kaydı')
            ->view('mails.kullanici_kayit');
    }
}
