# syntax=docker/dockerfile:1.7

FROM nginx:1.27-alpine

COPY default.conf /etc/nginx/conf.d/default.conf

HEALTHCHECK --interval=10s --timeout=3s --retries=5 CMD wget -qO- http://localhost/ || exit 1
