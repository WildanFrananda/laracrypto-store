# Cloudflare Tunnel Setup Guide for TALL Stack (Local Staging)

This document explains how to publish a TALL Stack application (Tailwind, Alpine, Laravel, Livewire) running in local Docker to the internet using Cloudflare Tunnel. This solution replaces Ngrok, providing automatic HTTPS, CDN features, and more stable performance.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Cloudflare Dashboard Setup](#cloudflare-dashboard-setup)
3. [Docker Configuration](#docker-configuration)
4. [Laravel Configuration (IMPORTANT)](#laravel-configuration-important)
5. [Multi-Project Strategy (One Tunnel, Multiple Apps)](#multi-project-strategy)
6. [Troubleshooting](#troubleshooting)

---

## 1. Prerequisites

- Cloudflare account (Free Plan)
- Domain with DNS pointed to Cloudflare (Cloudflare Nameservers)
- Docker & Docker Compose installed on laptop/server

---

## 2. Cloudflare Dashboard Setup

1. Log in to **Cloudflare Dashboard**
   - https://dash.cloudflare.com
   - https://one.dash.cloudflare.com
2. Open **Zero Trust** menu (Left Sidebar)
3. Navigate to **Networks > Tunnels**
4. Click **Create a tunnel**
5. Select **Cloudflared > Next**
6. Name your tunnel (example: `laptop-staging-wildan`) > **Save Tunnel**
7. **Copy Token**: On the installation screen, select the Docker icon. Copy the long token that appears after the `--token` flag
   - Don't run the command, just copy the token
8. Click **Next** to proceed to the Public Hostname tab
9. **Add Hostname**:
   - Subdomain: `app` (or as desired)
   - Domain: `wildanfrananda.my.id`
   - Service Type: `HTTP`
   - URL: `nginx:80` (Match `nginx` with your webserver service name in docker-compose.yml)
10. Click **Save Tunnel**

---

## 3. Docker Configuration

### A. Save the Token

Open the `.env` file in your project root and add the copied token:

```env
TUNNEL_TOKEN=eyJhIjoiM... (paste complete token here)
```

### B. Update docker-compose.yml

Add the tunnel service to your Docker Compose file.

**Note**: We use the `--protocol http2` flag to avoid QUIC protocol (UDP) blocking by some ISPs in Indonesia.

```yaml
services:
  # ... your app & database services ...

  nginx:
    image: nginx:alpine
    networks:
      - tall-network
    # ... other nginx configurations ...

  # Add this service
  tunnel:
    image: cloudflare/cloudflared:latest
    restart: unless-stopped
    command: tunnel run --protocol http2
    environment:
      - TUNNEL_TOKEN=${TUNNEL_TOKEN}
    networks:
      - tall-network # MUST be on the same network as nginx

networks:
  tall-network:
    driver: bridge
```

### C. (Optional) Fix Buffer Size Warning

If you see a warning in logs about "failed to sufficiently increase receive buffer size", run this command on your host terminal (Laptop):

```bash
sudo sysctl -w net.core.rmem_max=2500000
```

---

## 4. Laravel Configuration (IMPORTANT)

This step is mandatory for Livewire to function properly and to prevent Mixed Content errors (HTTP vs HTTPS) with assets (CSS/JS).

### A. Update .env

Ensure the URL uses `https://` matching your tunnel subdomain:

```env
APP_URL=https://app.wildanfrananda.my.id
ASSET_URL=https://app.wildanfrananda.my.id
```

### B. Force HTTPS (AppServiceProvider.php)

Edit `app/Providers/AppServiceProvider.php` to force HTTPS scheme when accessed via tunnel:

```php
use Illuminate\Support\Facades\URL;

public function boot(): void
{
    // Force HTTPS if APP_URL contains https (for staging/production)
    if (str_contains(config('app.url'), 'https://')) {
        URL::forceScheme('https');
    }
}
```

### C. Build Assets & Clear Cache

Since this environment is treated as production:

**Build Assets**: Don't use `npm run dev`. Use build instead:

```bash
npm run build
```

**Clear Cache**: Access the app/php container and clear cache:

```bash
docker compose exec app php artisan optimize:clear
docker compose exec app php artisan view:clear
```

---

## 5. Multi-Project Strategy

You can use one tunnel for multiple projects without creating new tunnels.

### Step 1: Check Tunnel Network

Find the network name of your main Docker project:

```bash
docker network ls
# Example output: main_project_tall-network
```

### Step 2: Configure Second Project

In the second project's `docker-compose.yml`, don't create a tunnel service. Just connect nginx to the main project's network:

```yaml
services:
  nginx-project-new:
    image: nginx:alpine
    networks:
      - internal-net
      - old-tunnel-network # Connect to this

networks:
  internal-net:
    driver: bridge
  old-tunnel-network:
    external: true
    name: main_project_tall-network # Network name from Step 1
```

### Step 3: Cloudflare Dashboard

1. Open your existing tunnel > **Configure** > **Public Hostname**
2. **Add a public hostname**
3. Subdomain: `shop` (example)
4. Service URL: `http://nginx-project-new:80`
5. **Save**

---

## 6. Troubleshooting

### Issue: Missing CSS/JS or Console Error "Mixed Content"

**Cause**: Browser blocks HTTP assets on HTTPS pages

**Solution**: Check the Laravel Configuration section. Ensure AppServiceProvider is modified and cache is cleared.

---

### Issue: Tunnel Error "Failed to dial to edge with quic"

**Cause**: ISP blocks UDP port 7844 connections

**Solution**: Ensure the tunnel command in `docker-compose.yml` includes the `--protocol http2` flag.

---

### Issue: Livewire Connection Error / 404

**Cause**: `APP_URL` in `.env` differs from the domain in the browser

**Solution**: Match `APP_URL` with the Cloudflare domain being accessed.

---

### Issue: Blade/CSS Code Changes Not Appearing

**Cause**: `npm run build` generates static files (no hot reload) and views are cached

**Solution**: Run `npm run build` again and `php artisan view:clear` after significant changes to assets/views in staging mode.