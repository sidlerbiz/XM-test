FROM debian:jessie

RUN apt-get update && apt-get install -y nginx

ADD nginx.conf /etc/nginx
ADD www.conf /etc/nginx/sites-available

RUN rm /etc/nginx/sites-enabled/default

RUN ln -s /etc/nginx/sites-available/www.conf /etc/nginx/sites-enabled/

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443