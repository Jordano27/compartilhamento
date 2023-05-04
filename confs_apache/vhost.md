# Configurações do Apache (Virtual Host)

C:\xampp\apache\conf\extra\httpd-vhosts.conf

```Listen 8080
<VirtualHost *:8080>
    DocumentRoot "C:\xampp\htdocs\aula1"
</VirtualHost>

<Directory "C:\xampp\htdocs\aula1">
    AllowOverride All
    Require all granted
</Directory>
```