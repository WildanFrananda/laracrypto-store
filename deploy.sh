#!/bin/bash

set -e

echo "🚀 Starting production deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Pull latest code
echo -e "${YELLOW}📦 Pulling latest code...${NC}"
git pull origin main

# Step 2: Create required directories
echo -e "${YELLOW}📁 Creating required directories...${NC}"
mkdir -p docker/nginx/conf.d
mkdir -p docker/php
mkdir -p docker/mysql
mkdir -p docker/redis

# Step 3: Build Docker images
echo -e "${YELLOW}🔨 Building Docker images...${NC}"
docker compose -f docker-compose.prod.yml build --no-cache

# Step 4: Stop old containers
echo -e "${YELLOW}🛑 Stopping old containers...${NC}"
docker compose -f docker-compose.prod.yml down

# Step 5: Start new containers
echo -e "${YELLOW}🚀 Starting new containers...${NC}"
docker compose -f docker-compose.prod.yml up -d

# Step 6: Wait for services to be healthy
echo -e "${YELLOW}⏳ Waiting for services to be ready...${NC}"
sleep 10

# Step 7: Run migrations
echo -e "${YELLOW}🗄️  Running database migrations...${NC}"
docker compose -f docker-compose.prod.yml exec -T app php artisan migrate:fresh --seed --force

# Step 8: Clear and optimize caches
echo -e "${YELLOW}🧹 Optimizing application...${NC}"
docker compose -f docker-compose.prod.yml exec -T app php artisan optimize:clear
docker compose -f docker-compose.prod.yml exec -T app php artisan config:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan route:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan view:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan event:cache

# Step 9: Generate media conversions (if needed)
echo -e "${YELLOW}🖼️  Checking media conversions...${NC}"
docker compose -f docker-compose.prod.yml exec -T app php artisan media-library:regenerate --force || true

# Step 10: Set permissions
echo -e "${YELLOW}🔐 Setting permissions...${NC}"
docker compose -f docker-compose.prod.yml exec -T app chown -R www-data:www-data /var/www/html/storage
docker compose -f docker-compose.prod.yml exec -T app chown -R www-data:www-data /var/www/html/bootstrap/cache

# Step 11: Restart queue workers
echo -e "${YELLOW}👷 Restarting queue workers...${NC}"
docker compose -f docker-compose.prod.yml restart queue

# Step 12: Health check
echo -e "${YELLOW}🏥 Running health checks...${NC}"
sleep 5

HEALTH_CHECK=$(curl -s -o /dev/null -w "%{http_code}" http://localhost/health)
if [ "$HEALTH_CHECK" = "200" ]; then
    echo -e "${GREEN}✅ Application is healthy!${NC}"
else
    echo -e "${RED}❌ Health check failed! Status code: $HEALTH_CHECK${NC}"
    exit 1
fi

# Step 13: Show container status
echo -e "${YELLOW}📊 Container status:${NC}"
docker compose -f docker-compose.prod.yml ps

echo -e "${GREEN}✅ Deployment completed successfully!${NC}"
echo -e "${GREEN}🌐 Application is running at: http://localhost${NC}"
echo ""
echo -e "${YELLOW}📝 Useful commands:${NC}"
echo "  View logs:     docker-compose -f docker-compose.prod.yml logs -f"
echo "  Enter app:     docker-compose -f docker-compose.prod.yml exec app sh"
echo "  Restart:       docker-compose -f docker-compose.prod.yml restart"
echo "  Stop:          docker-compose -f docker-compose.prod.yml down"