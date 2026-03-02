# VERTEX© Frontend — Vue.js 3 + Vite
FROM node:20-alpine

WORKDIR /app

# Installer les dépendances
COPY package.json package-lock.json* ./
RUN npm install

# Copier le code source
COPY . .

# Port exposé
EXPOSE 3000

# Serveur de développement Vite
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "3000"]
