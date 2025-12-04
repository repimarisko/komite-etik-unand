# syntax=docker/dockerfile:1.7

FROM nginx:1.27-alpine

COPY default.conf /etc/nginx/conf.d/default.conf

# Use IPv4 loopback and hit a lightweight Nginx-only endpoint
HEALTHCHECK --interval=10s --timeout=5s --retries=5 CMD wget --spider -q --tries=1 --timeout=4 http://127.0.0.1/healthz || exit 1
