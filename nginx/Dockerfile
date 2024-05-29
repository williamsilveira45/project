FROM nginx:alpine

COPY nginx.conf /etc/nginx/nginx.conf
COPY _gzip_static.conf /etc/nginx/_gzip_static.conf
COPY _gzip.conf /etc/nginx/_gzip.conf
COPY _fastcgi.conf /etc/nginx/_fastcgi.conf
COPY _headers.conf /etc/nginx/_headers.conf
COPY sites /etc/nginx/sites

CMD ["nginx", "-g", "daemon off;"]

EXPOSE 80 443