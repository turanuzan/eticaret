# Laravel ile Eticaret

# proje içerisinde .env ve node_modules bulunmuyor. node_modules aşağıdaki gibi kurulur.

# npm -v
# rm -rf node_modules (eskisini silmek için)
# npm cache clear --force (eskisini silmek için)
# rm -rf package-lock.json (eskisini silmek için)
# npm install (tekrar kurulum yapılıyor.)
# bootstrap-sass kurulu gelmez ise ayri olarak; npm install bootstrap-sass --save-dev komutu ile kuruldu.
# npm run dev (çalıştırmak için)

# ------------------------
# composer require unisharp/laravel-filemanager:~1.8 ile paketin kurulması
# filemanager kurulum : https://unisharp.github.io/laravel-filemanager/installation (Adımlar : 1,3,4)
# php artisan vendor:publish --tag=lfm_handler ile Handler altına config dosyasını alıyoruz.
# Sunucuya gözat denildiğinde Auth Middleware kullanmakta ama biz Yonetim middleware kullandık buna göre güncellememiz gerekmektedir.
