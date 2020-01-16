# teste-infotv
Teste InfoTV

Instalação do servidor WEB (Foi utilizado CentOs 7)

Inatalar o Apache
instalar o PHP >= 7.1.3
Instalar o postres >= 11

Instale os seguintes módulos requeridos pelo Laravel.

*BCMath PHP Extension
*Ctype PHP Extension
*JSON PHP Extension
*Mbstring PHP Extension
*OpenSSL PHP Extension
*PDO PHP Extension
*Tokenizer PHP Extension
*XML PHP Extension

Como instalar as dependências os laravel?
https://laravel.com/docs/6.x

Configure o virtual host 
```
/etc/httpd/conf.d/vhost.conf
```

```
<VirtualHost *:80>
    ServerName app.test.com.br
    DocumentRoot /var/www/html/teste-infotv/public
    ErrorLog logs/app-error_log
    CustomLog logs/app-access_log "%h %l %u %t \"%r\" %>s %b"
</VirtualHost>
```

Reinicie o httpd
```
systemctl restart httpd 
```

Clonar o projeto do github em /var/www/html/ (ou seu diretório de preferência):
```
git clone https://github.com/fabiocarlosvasconcelos/teste-infotv.git
```

Instalação do laravel e dependências: No diretório do projeto execute
```
 composer.phar install
```

Renomeie o arquivo .env.example para .env

Gere uma key para o projeto
```
php artisan key:generate
```

Definas as permissões:
```
chown apache. teste-infotv
chmod 775 teste-infotv -R
```

Crie uma database no postgres
```
create database teste
```
Configure os dados do posgres no .env

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=teste
DB_USERNAME=postgres
DB_PASSWORD=
```

Crie a estrutura de dados
```
php artisan migrate
```

Popule o banco de dados. Casa execução insere 10 itens por tabela.

```
php artisan db:seed
```











