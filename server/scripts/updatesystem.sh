#!/usr/bin/env bash

if [ ! -f /var/updatesystem ]

    then

    sudo su

    source /var/hostvars

	echo http://dl-cdn.alpinelinux.org/alpine/latest-stable/community >> /etc/apk/repositories

    echo -e "${g}Configurando data e hora...${nc}"
	rm -rf /usr/share/zoneinfo/*
	apk add tzdata
	cp /usr/share/zoneinfo/${TIME_ZONE} /etc/localtime

    echo -e "${g}Atualizando sistema...${nc}"
	apk update
	apk upgrade

    if [ "${VB_GUEST_FIX}" = true ] || [ "${VB_GUEST_FIX}" = 'true' ]

        then

        echo -e "${g}Configurando adicionais de convidado do VirtualBox...${nc}"
        apk add virtualbox-guest-additions=${VB_GUEST_ADD_VERSION}
	    apk add virtualbox-guest-modules-virt=${VB_GUEST_MOD_VIRT_VERSION}

    fi

	echo -e "${g}Reiniciando o sistema...${nc}"
	touch /var/updatesystem

	exit

fi
