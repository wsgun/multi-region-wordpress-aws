#!/bin/bash
#
# Embedded as EC2 Launch Template user data for every AutoScaling
# Group (both US-East-1 and US-West-2). Runs on first boot and
# installs a cron job that pulls the latest WordPress content
# down from S3 every 5 minutes, so newly launched instances stay
# in sync with whatever the Master has published -- without ever
# needing to bootstrap WordPress from scratch.

echo "*/5 * * * * /usr/bin/aws s3 sync s3://<your-bucket-name> /var/www/html" | sudo crontab -
