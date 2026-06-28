<?php
/**
 * Region-aware database host selection for wp-config.php.
 *
 * The same custom AMI is deployed in both US-East-1 and US-West-2,
 * so the database endpoint can't be hardcoded. Instead, each instance
 * queries its own EC2 instance metadata at runtime to find out which
 * Availability Zone (and therefore region) it's running in, and
 * connects to the "local" database -- the RDS primary in us-east-1,
 * or the cross-region Read Replica in us-west-2.
 *
 * Paste this block into wp-config.php, above the DB_HOST define
 * that ships with the default WordPress config file (and remove
 * or comment out that default DB_HOST line).
 */

$REGION = shell_exec("curl -s http://169.254.169.254/latest/meta-data/placement/availability-zone | sed s'/.$//'");

if ($REGION == 'us-east-1') {
    define('DB_HOST', '<east-rds-endpoint>.us-east-1.rds.amazonaws.com');
} elseif ($REGION == 'us-west-2') {
    define('DB_HOST', '<west-replica-endpoint>.us-west-2.rds.amazonaws.com');
}
