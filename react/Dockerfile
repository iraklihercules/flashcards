FROM node:latest

RUN apt update

RUN echo 'alias ll="ls -al"' >> /root/.bashrc
RUN echo 'alias ll="ls -al"' >> /home/node/.bashrc

COPY --chown=node:node src /var/www/html
WORKDIR /var/www/html

RUN npm install

CMD ["npm", "run", "dev"]
