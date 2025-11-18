#!/bin/bash

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🌐 Setting up Ngrok for Laravel...${NC}"

# Get ngrok URL
echo -e "${YELLOW}Getting ngrok public URL...${NC}"
NGROK_URL=$(curl -s http://localhost:4040/api/tunnels | grep -o 'https://[a-zA-Z0-9.-]*\.ngrok-free\.app' | head -1)

if [ -z "$NGROK_URL" ]; then
    echo -e "${RED}❌ Ngrok is not running!${NC}"
    echo -e "${YELLOW}Start ngrok first with: ngrok http 80${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Ngrok URL found: $NGROK_URL${NC}"

# Backup .env
echo -e "${YELLOW}📦 Backing up .env...${NC}"
cp .env .env.backup.$(date +%Y%m%d_%H%M%S)

# Update .env
echo -e "${YELLOW}📝 Updating .env file...${NC}"
sed -i.bak "s|^APP_URL=.*|APP_URL=$NGROK_URL|" .env
sed -i.bak "s|^ASSET_URL=.*|ASSET_URL=$NGROK_URL|" .env

# Add ASSET_URL if not exists
if ! grep -q "^ASSET_URL=" .env; then
    echo "ASSET_URL=$NGROK_URL" >> .env
fi

# Add APP_FORCE_HTTPS if not exists
if ! grep -q "^APP_FORCE_HTTPS=" .env; then
    echo "APP_FORCE_HTTPS=true" >> .env
else
    sed -i.bak "s|^APP_FORCE_HTTPS=.*|APP_FORCE_HTTPS=true|" .env
fi

# Clear Laravel caches
echo -e "${YELLOW}🧹 Clearing Laravel caches...${NC}"
docker compose -f docker-compose.prod.yml exec -T app php artisan config:clear
docker compose -f docker-compose.prod.yml exec -T app php artisan cache:clear
docker compose -f docker-compose.prod.yml exec -T app php artisan view:clear
docker compose -f docker-compose.prod.yml exec -T app php artisan route:clear

# Rebuild assets with correct URL
echo -e "${YELLOW}🏗️  Rebuilding assets...${NC}"
npm ci --production=false
npm run build && rm -rf node_modules

echo -e "${GREEN}✅ Ngrok setup completed!${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${GREEN}🌐 Public URL: $NGROK_URL${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo ""
echo -e "${YELLOW}📝 Next steps:${NC}"
echo "1. Open $NGROK_URL in your browser"
echo "2. Click through ngrok warning page"
echo "3. Your application should now load with CSS/JS"
echo ""
echo -e "${YELLOW}💡 Tips:${NC}"
echo "- Run this script every time ngrok restarts"
echo "- Or use ngrok premium for static domain"
echo "- Assets are now served via: $NGROK_URL/build/assets/"