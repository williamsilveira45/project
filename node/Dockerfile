FROM node:18.18

#Update + Install dependencies.
RUN apt-get -y update && apt-get -y install bash rsync git openssh-client ca-certificates

#Set default path
WORKDIR /usr/app

COPY post-build.sh /usr/post-build.sh
RUN chmod +x /usr/post-build.sh


