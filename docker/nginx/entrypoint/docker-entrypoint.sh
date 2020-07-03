#!/bin/sh

set -e

# Load .env
set -a
. /app/docker/.env
set +a

# Copy files to envsub
rm -rf /tmp/default.conf && cp /etc/nginx/custom/host.conf /tmp/default.conf

for NAME in $(awk "END { for (name in ENVIRON) { print name; }}" < /dev/null)
do
    case "$NAME" in
  *"DOCKER_NGINX_"*)
    VAL="$(awk "END { printf ENVIRON[\"$NAME\"]; }" < /dev/null)"

      # Create temp file to envsubst
      cp /tmp/default.conf /tmp/default.conf.tmp

      # Execute  envsubst
      envsubst "'\$${NAME}'" <  /tmp/default.conf.tmp > /tmp/default.conf

      # Create temp file to envsubst
      rm -rf /tmp/default.conf.tmp
    ;;
esac

done
exit 0
