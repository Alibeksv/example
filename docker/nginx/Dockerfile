FROM nginx:alpine

ARG BUILD_ARGUMENT_ENV=env
ENV ENV=$BUILD_ARGUMENT_ENV

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log && \
    rm -rf /etc/nginx/conf.d/*

# put nginx config
COPY ./$BUILD_ARGUMENT_ENV/nginx.conf /etc/nginx/conf.d/default.conf
