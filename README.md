# teste-infotv
Teste InfoTV

Instalação do servidor WEB (CentOs 7)

Instale o Apache
Instale o PHP >= 7.1.3
Inslate o postres >= 11

Instale os seguintes módulos requeridos pelo Laravel.

BCMath PHP Extension
Ctype PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension

Configure o vhost

/etc/httpd/conf.d/vhost.conf

<VirtualHost *:80>
    ServerName app.test.com.br
    DocumentRoot /var/www/html/teste-infotv/public
    ErrorLog logs/app-error_log
    CustomLog logs/app-access_log "%h %l %u %t \"%r\" %>s %b"
</VirtualHost>


systemctl restart httpd 

Clone projeto do github:

git clone https://github.com/fabiocarlosvasconcelos/teste-infotv.git

Instalação do laravel:

No diretório do projeto execute composer.phar install

renomeie o arquivo .env.example para .env

php artisan key:generate

Permissões:

chown apache. teste-infotv
chmod 775 teste-infotv -R

Criando a estrutura de dados

php artisan migrate

Populando o banco

php artisan db:seed











