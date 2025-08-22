FROM httpd:2.4

RUN sed -i \
    -e 's/#LoadModule rewrite_module/LoadModule rewrite_module/' \
    -e 's/#LoadModule proxy_module/LoadModule proxy_module/' \
    -e 's/#LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' \
    /usr/local/apache2/conf/httpd.conf

RUN echo 'Include conf/extra/yii2-vhost.conf' >> /usr/local/apache2/conf/httpd.conf

WORKDIR /app