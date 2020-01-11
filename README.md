# teste-infotv
Teste InfoTV

Instalação do servidor WEB (CentOs 7)

Instale o Apache
Instale o PHP >= 7.1.3

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






