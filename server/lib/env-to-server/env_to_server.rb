#!/usr/bin/ruby
# @Author: Douglas Medeiros

def set_env(rootdir)

    def initial
        self[0,1]
    end

    envdir = rootdir << "/.env"

    skip_env_to_host = false

    ARGV.each_with_index do |value, index|
        case value
            when '--skip_env_to_host'
                skip_env_to_host = true
        end
    end

	if ['up', 'reload'].include?(ARGV[0]) && !skip_env_to_host

       puts "\033[0;32m" << "Resgatando arquivo .env...\e[0m"

       if File.exist?(envdir)

        script = ""

         data = File.read(envdir)
         datacolors = File.read((Dir.pwd) + "/lib/env-to-server/colors.env")

         data.split("\n").each do |item|

             if item.initial != "#" && !item.to_s.empty?
                script = script << "echo \"" << item << "\n\" >> /var/hostvars \n"
             end

         end

         datacolors.split("\n").each do |item|

            if item.initial != "#" && !item.to_s.empty?
                script = script << "echo \"" << item << "\" >> /var/hostvars \n"
            end

         end

         return script

       end

       puts "\033[0;31m" << "Não foi possivel resgatar o arquivo .env..." << "\e[0m"
       exit -1

    end

    if ARGV.include?('--skip_env_to_host')
    		ARGV.delete_at(ARGV.index('--skip_env_to_host'))
    end

    return 0

end
