# Dockerfile for moodle instance. more dockerish version of https://github.com/sergiogomez/docker-moodle
FROM ubuntu:16.04
MAINTAINER Daniel Tomé Fernández <danieltomefer@gmail.com>

EXPOSE 80 443 3306

ADD ./foreground.sh /etc/apache2/foreground.sh

RUN apt-get update && \
	apt-get -y install vim mysql-client pwgen python-setuptools curl git unzip apache2 php7.0 \
		php7.0-gd libapache2-mod-php7.0 wget supervisor php7.0-pgsql curl libcurl3 \
		libcurl3-dev php7.0-curl php7.0-xmlrpc php7.0-intl php7.0-mysql git-core && \
	rm /var/www/html/index.html && \
	chown -R www-data:www-data /var/www/html && \
	chmod +x /etc/apache2/foreground.sh

# Enable SSL, moodle requires it
RUN a2enmod ssl && a2ensite default-ssl # if using proxy, don't need actually secure connection
CMD ["/etc/apache2/foreground.sh"]

