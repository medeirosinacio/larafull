# Alpine Docker - Agenda

Está é uma Vagrant Box completa para começar a desenvolver com Docker! Este setup automatico foi baseado no projeto [Alpine Docker | Server by Vagrant Box](https://github.com/medeirosinacio/alpine-docker).

Ela gera uma VM com linux Alpine de 100mb com todos os recursos essenciais instalados (Git, Composer, PHP7, Docker, Docker Compose e utilitarios do unix).

Este setup automaticamente ira subir a aplicação e suas dependências fazendo o desenvolvimento começar imediatamente sem maiores dores de cabeça. 

##  Pré-requisitos

* [VirtualBox (6.1.*)](http://www.virtualbox.org/)
* [Vagrant (2.2.*)](http://downloads.vagrantup.com/)
* Arquivos de dump dos bancos para importar apos a instalação

## Subindo o Servidor
    
 * Execute o comando:

> vagrant up

 * Apos a instalação, acesse a maquina com:
 
> vagrant ssh

## NOTAS:

 * Você pode mudar qualquer configuração inicial no arquivo .env;
 * Por se tratar de um server local, esse projeto já consta um arquivo .env com as configurações iniciais;
 * O IP de resposta do servidor é 192.168.70.90 e o SSL é configurado para o host https://local.masternetrs.com.br;
