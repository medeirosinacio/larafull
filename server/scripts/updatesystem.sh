#!/usr/bin/env bash

if [ ! -f /var/updatesystem ]

    then

    sudo su

    source /var/hostvars

	echo http://dl-3.alpinelinux.org/alpine/latest-stable/main > /etc/apk/repositories
    echo http://dl-3.alpinelinux.org/alpine/latest-stable/community >> /etc/apk/repositories

    echo -e "${g}Configurando data e hora...${nc}"
	rm -rf /usr/share/zoneinfo/*
	apk add tzdata
	cp /usr/share/zoneinfo/${TIME_ZONE} /etc/localtime

    echo -e "${g}Atualizando sistema...${nc}"
	apk update
    apk add --upgrade apk-tools
	apk upgrade --available

	echo -e "${g}Reiniciando o sistema...${nc}"
	touch /var/updatesystem

	exit

fi
