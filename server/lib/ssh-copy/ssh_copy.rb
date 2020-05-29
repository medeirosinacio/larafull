#!/usr/bin/ruby
# @Author: Douglas Medeiros

def copy_ssh_keys(dependencies)

    skip_ssh_copy = false

    ARGV.each_with_index do |value, index|
        case value
            when '--skip_ssh_copy'
                skip_ssh_copy = true
        end
    end

	if ['up', 'reload'].include?(ARGV[0]) && !skip_ssh_copy

       puts "\033[0;32m" << "Resgatando chave SSH da maquina local em \"" << dependencies << "\"..." << "\e[0m"

       ssh_key = %x[cat #{dependencies}]

       if !ssh_key.to_s.empty?
         return ssh_key
       end

       puts "\033[0;31m" << "Não foi possivel resgatar a chave SSH informada (O caminho informado é invalido)..." << "\e[0m"
       exit -1

    end

    if ARGV.include?('--skip_ssh_copy')
    		ARGV.delete_at(ARGV.index('--skip_ssh_copy'))
    end

    return 0

end
