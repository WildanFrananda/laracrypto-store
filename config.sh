#!/usr/bin/env bash
set -e

# Sesuaikan:
REPO_URL="https://github.com/<your-user-or-org>/<your-repo>"
RUNNER_DIR="$HOME/actions-runner"

mkdir -p "$RUNNER_DIR"
cd "$RUNNER_DIR"

# ambil link & token dari GitHub UI; contohnya GitHub beri command curl download with token
# contoh (ganti versi rilis jika perlu)
RVER="2.308.0"
curl -L -o actions-runner-linux-x64.tar.gz "https://github.com/actions/runner/releases/download/v${RVER}/actions-runner-linux-x64-${RVER}.tar.gz"
tar xzf ./actions-runner-linux-x64.tar.gz

# Sekarang buka GitHub -> Settings -> Actions -> Runners -> New self-hosted runner
# lalu akan ada command ./config.sh --url ... --token ...
# Contoh (ganti <TOKEN> sesuai yang GitHub berikan):
# ./config.sh --url "${REPO_URL}" --token <TOKEN>

echo "READY. Now: go to GitHub > Settings > Actions > Runners > New self-hosted runner."
echo "Run the './config.sh --url \"${REPO_URL}\" --token <TOKEN>' command shown by GitHub."
echo "After config, run: sudo ./svc.sh install && sudo ./svc.sh start  (to run as service)"
