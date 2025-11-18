#!/bin/bash

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}🚀 Quick Start - Development with Nginx Caching${NC}"

# Create directory structure
echo -e "${YELLOW}📁 Creating directories...${NC}"
mkdir -p docker/nginx

# Create dev nginx config
cat > docker/nginx/dev.conf << 'EOF'
server {
    listen 80;
    server_name localhost;
    root /var/www/html/public;
    index index.php index.html;

    location ~* \.(jpg|jpeg|png|gif|ico|svg|webp|avif)$ {
        expires 1y;
        add_header Cache-Control "public, max-age=31536000, immutable";
        access_log off;
        try_files $uri =404;
    }

    location ~* \.(css|js|woff|woff2|ttf)$ {
        expires 1y;
        add_header Cache-Control "public, max-age=31536000";
        access_log off;
        try_files $uri =404;
    }

    location ^~ /storage/ {
        expires 1y;
        add_header Cache-Control "public, max-age=31536000";
        access_log off;
        try_files $uri =404;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass laravel.test:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF

# Start Sail
echo -e "${YELLOW}🐳 Starting Laravel Sail...${NC}"
./vendor/bin/sail up -d

# Start Nginx
echo -e "${YELLOW}🌐 Starting Nginx...${NC}"
docker run -d \
    --name sabimul-nginx \
    --network sabimul_sail \
    -p 8080:80 \
    -v "$(pwd):/var/www/html:ro" \
    -v "$(pwd)/docker/nginx/dev.conf:/etc/nginx/conf.d/default.conf:ro" \
    nginx:alpine

# Wait for services
echo -e "${YELLOW}⏳ Waiting for services...${NC}"
sleep 5

# Run optimizations
echo -e "${YELLOW}🔧 Running optimizations...${NC}"
./vendor/bin/sail artisan config:cache
./vendor/bin/sail artisan route:cache
./vendor/bin/sail artisan view:cache

echo -e "${GREEN}✅ Setup complete!${NC}"
echo -e "${GREEN}🌐 Application URLs:${NC}"
echo -e "   Direct (Sail):  http://localhost"
echo -e "   Via Nginx:      http://localhost:8080 ${YELLOW}(Cached - Use this!)${NC}"
echo ""
echo -e "${YELLOW}📝 Useful commands:${NC}"
echo -e "   Stop all:       ./vendor/bin/sail down && docker stop sabimul-nginx"
echo -e "   View logs:      ./vendor/bin/sail logs -f"
echo -e "   Nginx logs:     docker logs -f sabimul-nginx"
echo -e "   Restart Nginx:  docker restart sabimul-nginx"