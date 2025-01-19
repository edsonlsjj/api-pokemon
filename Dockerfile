# Base image
FROM webdevops/php-nginx-dev:8.3

# Define o diretório de trabalho
WORKDIR /app

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia o arquivo de configuração do PHP personalizado
#COPY ./docker/php/local.ini /opt/docker/etc/php/php.ini

# Copia o arquivo de configuração do Nginx personalizado
COPY ./docker/nginx/vhost.conf /opt/docker/etc/nginx/vhost.common.conf

# Expor as portas do contêiner
EXPOSE 80 443

# Comando padrão para o contêiner
CMD ["supervisord"]
