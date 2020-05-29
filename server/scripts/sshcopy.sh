#!/usr/bin/env bash

    source /var/hostvars

    echo -e "${g}Configurando SSH remoto com as credenciais locais...${nc}"

    # Copia chave para o arquivo do usuario
    echo  "$1" >  /home/vagrant/.ssh/id_rsa
    echo  "$2" >  /home/vagrant/.ssh/id_rsa.pub

    # seta as permissões para o uso da chave clonada SSH
    touch /home/vagrant/.ssh/known_hosts
    chown vagrant:vagrant /home/vagrant/.ssh/*
    chmod 600 /home/vagrant/.ssh/id_rsa
    chmod 644 /home/vagrant/.ssh/id_rsa.pub


    # seta os hosts confiaveis para automatizar ações com o git
    ssh-keygen -F github.com || ssh-keyscan github.com >> /home/vagrant/.ssh/known_hosts
    ssh-keygen -F gitlab.com || ssh-keyscan gitlab.com >> /home/vagrant/.ssh/known_hosts
    ssh-keygen -F bitbucket.org || ssh-keyscan bitbucket.org >> /home/vagrant/.ssh/known_hosts
