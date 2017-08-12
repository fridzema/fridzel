<p align="center">
  <a href="https://fridzema.com"><img src="https://static.fridzema.com/img/fridzel.svg" alt="Fridzel logo" title="Fridzel" width="150" height="150" /></a>
</p>

# Fridzel
Fridzel | Minimalistic photo CMS 📸

## 🖼 Screenshots
<img src="https://static.fridzema.com/img/s1.jpg?v=2" alt="Frontend" title="Frontend"/>
<img src="https://static.fridzema.com/img/s2.jpg?v=2" alt="Login" title="Login"/>
<img src="https://static.fridzema.com/img/s3.jpg?v=2" alt="Admin" title="Admin"/>

## ⚙️ Features
* Basic Drag and Drop File upload (Dropzone)
* Cleanest possible frontend code
* Photo EXIF data extraction (Not displayed yet)
* Optional CDN Support
* Optional Google Analytics Support
* Envoy deploy script

## 🚧  Roadmap
* Better responsive css, at the moment almost as minimal/showable possible
* Multiple themes, different grids
* Optional abums
* Photo search/filtering
* Reordering photos
* Configuration options
* Lightroom publishing plugin
* Photo stories and EXIF information
* Photo comments
* Photo votes
* Photo social media sharing
* Google AMP Pages
* SEO
* Ansible provision script

## Installation

Recommended:

`composer create-project fridzema/fridzel `

Or:

`git clone https://github.com/fridzema/fridzel && cd fridzel && composer install && cp .env.example .env`

Fill the `.env` file with your own values, and then do not forget to seed the database

`php artisan migrate --seed`

If there are no photos found yet you will be redirected to the login page, you can login with following default credentials:

`user@fridzel.dev`

`password`

## Deploying
Make sure you have [Laravel Envoy](https://laravel.com/docs/5.4/envoy#installation "Envoy installation") installed on you machine.
Check the Envoy.blade.php and replace the server ip with your own server ip and check all the commands before you proceed, please keep in mind this is just a starting <strong>boilerplate</strong> and works well for my server setup!

`envoy run setup` this will setup the application the first time.

`envoy run update` this is what i use for a quick site update without emptying everything.

## Recommendations

Currently my website runs on a cheap [Digital Ocean](https://m.do.co/c/0c0123980463) VPS with 1 CPU, 500MB RAM and have response times of approximately 30ms~

Also this scripts must be checked and modified to your personal preferences this is just a <strong>boilerplate</strong> and works well for my server setup!

My complete optimized nginx configuration (suggestions are welcome):
```
server_tokens off;
add_header X-Frame-Options SAMEORIGIN;
add_header X-Content-Type-Options nosniff;
add_header X-XSS-Protection "1; mode=block";
add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://ssl.google-analytics.com https://assets.zendesk.com https://connect.facebook.net; img-src 'self' https://ssl.google-analytics.com https://s-static.ak.facebook.com https://assets.zendesk.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://assets.zendesk.com; font-src 'self' https://themes.googleusercontent.com; frame-src https://assets.zendesk.com https://www.facebook.com https://s-static.ak.facebook.com https://tautt.zendesk.com; object-src 'none'";

gzip on;
gzip_vary on;
gzip_min_length 10240;
gzip_proxied expired no-cache no-store private auth;
gzip_disable "MSIE [1-6]\.";

server {
 server_name 188.226.137.26;
 return 301 https://fridzema.com;
}

server {
	listen 80 default_server;
	listen [::]:80 default_server;
	server_name .fridzema.com;
	return 301 https://$host$request_uri;
}

server {
	listen 443 ssl http2;
	listen [::]:443 ssl http2 ipv6only=on;
	server_name fridzema.com;

	root /var/www/html/fridzel/public;
	index index.php;

	ssl_certificate /etc/letsencrypt/live/fridzema.com/fullchain.pem;
	ssl_certificate_key /etc/letsencrypt/live/fridzema.com/privkey.pem;
	include snippets/ssl-params.conf;

	charset utf-8;
	add_header "X-UA-Compatible" "IE=Edge";

	location / {
		# try_files $uri $uri/ /index.php$is_args$args;
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
    	try_files $uri =404;
    	fastcgi_split_path_info ^(.+\.php)(/.+)$;
    	fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
    	fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    	include fastcgi_params;
	}
}


server {
	listen 443 ssl http2;
	server_name static.fridzema.com;

	root /var/www/html/fridzel/public;

	ssl_certificate /etc/letsencrypt/live/fridzema.com/fullchain.pem;
	ssl_certificate_key /etc/letsencrypt/live/fridzema.com/privkey.pem;
	include snippets/ssl-params.conf;

	location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
	  expires 365d;
  }

	fastcgi_hide_header Set-Cookie;
}
```

snippets/ssl-params.conf
```
	ssl_dhparam /etc/ssl/certs/dhparam.pem;
	ssl_session_cache shared:SSL:50m;
	ssl_session_timeout 1d;
	ssl_session_tickets off;
	ssl_prefer_server_ciphers on;
	ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
	ssl_ciphers "ECDHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-SHA384:ECDHE-RSA-AES128-SHA256:ECDHE-RSA-AES256-SHA:ECDHE-RSA-AES128-SHA:DHE-RSA-AES256-SHA256:DHE-RSA-AES128-SHA256:DHE-RSA-AES256-SHA:DHE-RSA-AES128-SHA:ECDHE-RSA-DES-CBC3-SHA:EDH-RSA-DES-CBC3-SHA:AES256-GCM-SHA384:AES128-GCM-SHA256:AES256-SHA256:AES128-SHA256:AES256-SHA:AES128-SHA:DES-CBC3-SHA:HIGH:!aNULL:!eNULL:!EXPORT:!DES:!MD5:!PSK:!RC4:@STRENGTH";
	resolver 8.8.8.8 8.8.4.4;
	ssl_stapling on;
	ssl_stapling_verify on;
	add_header Strict-Transport-Security "max-age=31536000; includeSubdomains; preload";
```

snippets/fastcgi.conf
```
fastcgi_split_path_info ^(.+\.php)(/.+)$;
try_files $fastcgi_script_name =404;
set $path_info $fastcgi_path_info;
fastcgi_param PATH_INFO $path_info;
fastcgi_index index.php;
include fastcgi.conf;
```

## Questions?
Feel free to make an issue about whatever you want!

## Extra
[Photo samples](https://static.fridzema.com/downloads/fridzel-samples.zip)
