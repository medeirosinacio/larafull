#!/usr/bin/env bash

if [ ! -f /var/firstboot ]; then

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
	apk add --no-cache python3 python3-dev py-pip
	apk add --no-cache build-base libffi-dev openssl-dev libgcc gcc libc-dev make
	pip install docker-compose

	echo -e "${g}Configure alias docker command...${nc}"
	touch /etc/profile.d/00-aliases.sh
	echo "alias artisan=\"docker exec -it laravel-phpfpm php bin/artisan\"" >> /etc/profile.d/00-aliases.sh
	echo "alias php=\"docker exec -it laravel-phpfpm php\"" >> /etc/profile.d/00-aliases.sh
	echo "alias composer=\"docker run --rm  --volume /app:/app   --volume $HOME/.composer:/tmp   --user $(id -u):$(id -g)  composer\"" >> /etc/profile.d/00-aliases.sh
	echo "alias npm=\"docker run -v /app:/usr/src/app -w /usr/src/app node:8.9.4 npm\"" >> /etc/profile.d/00-aliases.sh

	touch /var/firstboot
	exit

fi
