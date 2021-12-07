FROM node:lts-alpine

# Install a simple HTTP Server
RUN npm install -g http-server

WORKDIR /app

COPY package*.json ./

# Install dependencies
RUN npm install

# Copy source files
COPY . .

RUN mv .env.example .env

# Build app
RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]