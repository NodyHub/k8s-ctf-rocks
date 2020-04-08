FROM php:7.1-apache

# Install supporting tools
RUN apt-get update && apt-get install -y \
    ncat \
    nmap \
    ssh-client \
    socat \
    python \
    iputils-ping \
    && rm -rf /var/lib/apt/lists/* \
    && curl -L -o /usr/local/bin/kubectl https://storage.googleapis.com/kubernetes-release/release/$(curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt)/bin/linux/amd64/kubectl \
    && chmod +x /usr/local/bin/kubectl
    

# Come and get me :p
ARG GHA_EASTER_EGG="DEFAULT-ARG-EASTER-EGG"
RUN echo $GHA_EASTER_EGG > /EGG
RUN rm /EGG


# Define SSH client defaults
COPY etc /etc

# Prepare webpage
ENV APACHE_DOCUMENT_ROOT /entry
COPY web /entry
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /entry

# go for it
CMD ["apache2-foreground"]

EXPOSE 80
