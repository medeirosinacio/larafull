#!/usr/bin/env bash

if [ ! -f /var/firstboot ]

    then

    sudo su

    source /var/hostvars

    echo -e "${g}Instalando serviços essenciais...${nc}"
	apk add zip unzip curl wget vim tree net-tools

    echo -e "${g}Instalando Git...${nc}"
    apk add git

	echo -e "${g}Instalando Docker...${nc}"
	apk add docker
	rc-update add docker boot
	service docker start
	adduser vagrant docker
	addgroup -S vagrant docker

	echo -e "${g}Instalando docker-compose...${nc}"
	apk add docker-compose

	echo -e "${g}Setando alias...${nc}"
    echo "alias artisan=\"docker exec laravel-phpfpm php bin/artisan\"" >> /home/vagrant/.bash_profile
    echo "alias composer=\"docker run --rm --interactive --volume /app:/app --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp --user $(id -u):$(id -g) composer\"" >> /home/vagrant/.bash_profile
    echo "alias artisan=\"docker exec laravel-phpfpm php bin/artisan\"" >> /home/vagrant/.bash_profile
    echo "alias cache=\"docker exec laravel-phpfpm php bin/artisan config:cache && docker exec laravel-phpfpm php bin/artisan config:clear\"" >> /home/vagrant/.bash_profile
    echo "alias npm=\"docker run -v /app:/usr/src/app -w /usr/src/app node:alpine npm\"" >> /home/vagrant/.bash_profile

    touch /var/firstboot
	exit

fi
