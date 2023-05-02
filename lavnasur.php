RewriteEngine On
# RewriteCond %{SERVER_PORT} 80
# RewriteRule ^(.*)$ https://eauction.ipsupport.in/$1 [R,L]



#RewriteCond %{HTTP_HOST} !^www\. [NC]
#RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [R=301,L]



RewriteCond %{ENV:REDIRECT_STATUS} ^$
RewriteRule ^(.+/)?index\.php(/|$) /$1 [R=301,L]


RewriteCond %{SERVER_PORT} 80
RewriteRule ^(.*)$ https://eauction.ipsupport.in/$1 [R,L]