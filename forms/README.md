
# Kurulum

  

Proje docker üzerinde çalıştığı için öncelikle docker ve docker-compose'u bilgisyarımıza kurmalıyız.

Buradanki talimatlara bakarak kurabilirsiniz https://docs.docker.com/engine/install/

ayrıca git'in de kurulu olması gerekir
https://git-scm.com/downloads

daha sonra terminal yardımıyla projemizi clone edelim
  

	cd ~
    git clone https://github.com/mealinux/forms

 **proje** dosyamızı ana dizinde `projects` adlı bir klasör oluşturup oluşturduğumuz bu `projects` adlı klasörün içine taşıyoruz

    mkdir projects
    mv forms projects/

sonrasın docker klasörümüzün içine gidiyoruz

    cd docker

ve aşağıdaki komutu çalıştırıyoruz

> Not: Bu işlem biraz zaman alabilir

    sudo docker-compose up -d

sonraki aşamada `phpmyadmin` ve istersek profesyonel gözükmesi açısından `forms.test` gibi bir test urli bilgisyarımızda ayarlayabiliriz

editörümüzü açıyoruz
   
    sudo nano /etc/hosts
	
aşşağıdaki urlleri giriyoruz

     127.0.0.1  phpmyadmin.test
     127.0.0.1  forms.test

`ctrl + x` yapıp `y + enter` kombinasyonuyla kaydedip çıkıyoruz

tarayıcımızdan `phpmyadmin.test`'e girip yeni bir `forms` adında veritabanı oluşturuyoruz

phpmyadmin giriş bilgileri

    kullanıcı adı: root
    şifre: secret


sonrasında projemizin ana dizinine girip .env dosyasımızı oluşturuyoruz

    touch .env

ve içine aşşağıdaki kodu yapıştırıyoruz


    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_URL=https://forms.test
    APP_TIMEZONE=Europe/Istanbul
    
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=forms
    DB_USERNAME=root
    DB_PASSWORD=secret
    
    BROADCAST_DRIVER=pusher
    CACHE_DRIVER=redis
    QUEUE_CONNECTION=redis
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    REDIS_HOST=redis
    REDIS_PASSWORD=null
    REDIS_PORT=6379

sonransında tekrar `docker` klaösürünün içine gidip php container'ımızın içine giriyoruz önce `APP_KEY`'imizi oluşturup daha sonra npm'i ve `migration`'larımızı `seed`'lerle beraber çalıştırıyoruz

    cd ~/docker
    sudo docker exec -ti php8 bash
    cd forms
    php artisan key:generate
    php artisan migrate --seed
    
    npm install && npm run build


şimdi sıra google keylerimizi almaya geldi

adresine gidip
https://console.cloud.google.com/apis/dashboard

eğer projemiz yoksa  `NEW PROJECT` diyip yeni bir proje oluşturuyoruz
daha sonra  `ENABLE APIS AND SERVICES` sekmesinden `DRIVE` ve `FORMS` api'lerini enable ediyoruz

sırada soldaki `Credentials` sekmesine gidiyor ve yukardaki `Create credentials` kısmından bir adet `OAuth Client ID` oluşturuyoruz 

**Application type**

    Web Application

**Authorized JavaScript origins**
kısmında `http://localhost:80`


**Authorized redirect URIs**
kısmında `http://localhost:80/auth/google/callback`

adreslerini girip kaydediyoruz

 `OAuth 2.0 Client IDs` listesinden keyimizi bulup en sağdan indir butonuna tıklayarak konfigürasyon json dosyamızı indirip projemizin ana dizinine taşıyoruz ve ismini `client_credentials.json` olarak değiştiriyoruz

işte bu kadar şimdi `https://forms.test` urlimize gidebiliriz

>Not: Çoğu ayarı kendinize göre düzenleyebilirsiniz

Eğer açılışta izin (permission) hatası alırsak php container'ımızın içine girip aşağıdaki kodu çalıştırabiliriz

    chmod -R 777 storage/*


`seed` edilen örnek kullanıcı bilgileri aşağıdadır

    admin: admin@company.com
    şifre: 123123123
    
    Kullanıcı 1: agent@company.com
    şifre: 123123123
    
    Kullanıcı 2: agen2t@company.com
    şifre: 123123123
