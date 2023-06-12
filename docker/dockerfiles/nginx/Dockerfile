FROM nginx:1.22.1

WORKDIR /projects
#WORKDIR /projects7

RUN rm -rf /etc/nginx/conf.d/default.conf

RUN chmod -R 664 /projects
RUN chown 1000:1000 /projects

#RUN chmod -R 664 /projects7
#RUN chown 1000:1000 /projects7

EXPOSE 6001 6002