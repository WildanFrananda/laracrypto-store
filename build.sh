#!/bin/bash

set -e

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}🔨 Building Docker images...${NC}"

# Function to build with retry
build_image() {
    local dockerfile=$1
    local max_retries=3
    local retry_count=0
    
    while [ $retry_count -lt $max_retries ]; do
        echo -e "${YELLOW}Attempt $((retry_count + 1)) of $max_retries...${NC}"
        
        if docker compose -f docker-compose.prod.yml build --no-cache --build-arg BUILDKIT_INLINE_CACHE=1; then
            echo -e "${GREEN}✅ Build successful!${NC}"
            return 0
        else
            retry_count=$((retry_count + 1))
            if [ $retry_count -lt $max_retries ]; then
                echo -e "${YELLOW}⚠️  Build failed, retrying in 10 seconds...${NC}"
                sleep 10
            fi
        fi
    done
    
    echo -e "${RED}❌ Build failed after $max_retries attempts${NC}"
    return 1
}

# Try Alpine-based build first
echo -e "${YELLOW}Trying Alpine-based build...${NC}"
if build_image "Dockerfile"; then
    exit 0
fi

# If Alpine fails, try Debian-based
echo -e "${YELLOW}Alpine build failed, trying Debian-based build...${NC}"
if [ -f "Dockerfile.simple" ]; then
    mv Dockerfile Dockerfile.alpine.backup
    mv Dockerfile.simple Dockerfile
    
    if build_image "Dockerfile"; then
        echo -e "${GREEN}✅ Debian-based build successful!${NC}"
        exit 0
    fi
    
    # Restore original
    mv Dockerfile Dockerfile.simple
    mv Dockerfile.alpine.backup Dockerfile
fi

echo -e "${RED}❌ All build attempts failed${NC}"
exit 1