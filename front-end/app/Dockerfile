FROM node:18-alpine

WORKDIR /

COPY . .

RUN npm install

EXPOSE 8080

CMD ["npm", "run", "serve"]