FROM nginx:latest

ADD ./vhost.conf /etc/nginx/conf.d/default.conf
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
