#!/bin/bash
#
# Runs on the WordPress Master instance (US-East-1).
# Continuously backs up /var/www/html to S3 every 5 minutes,
# deleting files in S3 that no longer exist locally so the
# bucket always mirrors the Master's current state.
#
# Install by running this script once on the Master instance,
# or by pasting the crontab line directly.

echo "*/5 * * * * /usr/bin/aws s3 sync --delete /var/www/html s3://<your-bucket-name>" | sudo crontab -
