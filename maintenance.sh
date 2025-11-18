#!/bin/bash

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

COMPOSE_FILE="docker-compose.prod.yml"

# Function to show menu
show_menu() {
    echo -e "${BLUE}╔════════════════════════════════════════╗${NC}"
    echo -e "${BLUE}║   Production Maintenance Menu          ║${NC}"
    echo -e "${BLUE}╚════════════════════════════════════════╝${NC}"
    echo ""
    echo "1. Update .env only"
    echo "2. Update code (git pull)"
    echo "3. Clear all caches"
    echo "4. Restart services"
    echo "5. Run migrations"
    echo "6. Rebuild images"
    echo "7. View logs"
    echo "8. Enter app container"
    echo "9. Database backup"
    echo "10. Full deployment"
    echo "0. Exit"
    echo ""
}

# 1. Update .env
update_env() {
    echo -e "${YELLOW}🔧 Updating .env...${NC}"
    nano .env
    docker compose -f $COMPOSE_FILE exec -T app php artisan config:clear
    docker compose -f $COMPOSE_FILE exec -T app php artisan config:cache
    docker compose -f $COMPOSE_FILE restart app queue
    echo -e "${GREEN}✅ .env updated!${NC}"
}

# 2. Update code
update_code() {
    echo -e "${YELLOW}📥 Updating code...${NC}"
    git pull origin main
    docker compose -f $COMPOSE_FILE exec -T app composer install --no-dev
    docker compose -f $COMPOSE_FILE exec -T app npm ci && npm run build
    docker compose -f $COMPOSE_FILE exec -T app php artisan migrate --force
    docker compose -f $COMPOSE_FILE exec -T app php artisan optimize
    docker compose -f $COMPOSE_FILE restart app queue
    echo -e "${GREEN}✅ Code updated!${NC}"
}

# 3. Clear caches
clear_caches() {
    echo -e "${YELLOW}🧹 Clearing caches...${NC}"
    docker compose -f $COMPOSE_FILE exec -T app php artisan cache:clear
    docker compose -f $COMPOSE_FILE exec -T app php artisan config:clear
    docker compose -f $COMPOSE_FILE exec -T app php artisan route:clear
    docker compose -f $COMPOSE_FILE exec -T app php artisan view:clear
    docker compose -f $COMPOSE_FILE exec -T app php artisan optimize:clear
    echo -e "${GREEN}✅ Caches cleared!${NC}"
}

# 4. Restart services
restart_services() {
    echo -e "${YELLOW}🔄 Restarting services...${NC}"
    docker compose -f $COMPOSE_FILE restart
    echo -e "${GREEN}✅ Services restarted!${NC}"
}

# 5. Run migrations
run_migrations() {
    echo -e "${YELLOW}🗄️  Running migrations...${NC}"
    docker compose -f $COMPOSE_FILE exec -T app php artisan migrate --force
    echo -e "${GREEN}✅ Migrations completed!${NC}"
}

# 6. Rebuild images
rebuild_images() {
    echo -e "${YELLOW}🔨 Rebuilding images...${NC}"
    docker compose -f $COMPOSE_FILE build --no-cache
    docker compose -f $COMPOSE_FILE up -d
    echo -e "${GREEN}✅ Images rebuilt!${NC}"
}

# 7. View logs
view_logs() {
    echo -e "${YELLOW}📋 Viewing logs...${NC}"
    docker compose -f $COMPOSE_FILE logs -f --tail=100
}

# 8. Enter container
enter_container() {
    echo -e "${YELLOW}🐚 Entering app container...${NC}"
    docker compose -f $COMPOSE_FILE exec app sh
}

# 9. Database backup
database_backup() {
    echo -e "${YELLOW}💾 Creating database backup...${NC}"
    BACKUP_FILE="backup_$(date +%Y%m%d_%H%M%S).sql"
    docker compose -f $COMPOSE_FILE exec -T mysql mysqldump -u root -p${DB_PASSWORD} ${DB_DATABASE} > $BACKUP_FILE
    echo -e "${GREEN}✅ Backup created: $BACKUP_FILE${NC}"
}

# 10. Full deployment
full_deployment() {
    echo -e "${YELLOW}🚀 Running full deployment...${NC}"
    ./deploy.sh
}

# Main loop
while true; do
    show_menu
    read -p "Choose an option: " choice
    
    case $choice in
        1) update_env ;;
        2) update_code ;;
        3) clear_caches ;;
        4) restart_services ;;
        5) run_migrations ;;
        6) rebuild_images ;;
        7) view_logs ;;
        8) enter_container ;;
        9) database_backup ;;
        10) full_deployment ;;
        0) 
            echo -e "${GREEN}👋 Goodbye!${NC}"
            exit 0
            ;;
        *)
            echo -e "${RED}Invalid option!${NC}"
            ;;
    esac
    
    echo ""
    read -p "Press Enter to continue..."
done