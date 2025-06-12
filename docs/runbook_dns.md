# DNS Platform – On‑Call Run‑Book (excerpt)

## 1. Quick Reference

| Action | Command / Endpoint | Expected Response |
|--------|-------------------|-------------------|
| Force‑publish zone after change | `php artisan dns:sync <zone>` | Job dispatched, Horizon shows `PublishZoneJob` success |
| Check parity across providers | `php artisan dns:check <zone>` | `OK` or diff report |
| Create secondary zone | `php artisan dns:create-secondary <provider> <zone> <master IPs>` | Console prints success; audit log shows 201 |
| Rotate provider token | Update `.env` + `php artisan config:cache` | No downtime – drivers pick up new token next request |

## 2. Fail‑over Procedure (primary provider outage)

1. **Detect** outage via Grafana alert `dns_provider_errors > 5%`.
2. Log into app server, run:

   ```bash
   php artisan dns:set-topology powerdns_master --tld=<affected tld>
   ```

3. Confirm with:

   ```bash
   php artisan dns:check <affected tld>
   dig +trace <tld> NS
   ```

4. Update incident channel, monitor for resolver traffic normalisation.

## 3. Adding a New TLD

```bash
# Step 1 – create in registry DB
php artisan tld:create example

# Step 2 – create primary zone
php artisan dns:sync example

# Step 3 – provision secondaries
php artisan dns:create-secondary akamai_sec example 203.0.113.10
php artisan dns:create-secondary cloudflare example 203.0.113.10
```

## 4. Credential Rotation

| Provider | File / Secret | TTL | Rotation cmd |
|----------|---------------|-----|--------------|
| Cloudflare | `CLOUDFLARE_API_TOKEN` | 90d | Dashboard → API Tokens → edit |
| ClouDNS | `CLOUDNS_AUTH_PASSWORD` | 30d | Portal → Security → Generate new API password |
| AWS Route 53 | `AWS_ACCESS_KEY / SECRET` | 90d | IAM rotate keys script |

After updating secrets: `php artisan config:cache`.

## 5. Disaster Recovery

* DB replicated cross‑region (RPO ≤ 1h).
* Daily `zone_export` cron saves BIND files to S3.
* To rebuild from scratch:

  1. Restore DB snapshot.
  2. Run `php artisan dns:reconcile --all`.
  3. Validate via `dig` and Grafana dashboard.

## 6. Useful Grafana Panels

* **dns_publish_latency** – median time between zone edit and last provider ACK.
* **dns_provider_errors** – 5‑minute error rate per provider.
* **dnssec_ds_mismatch** – zones where DS in registry ≠ DS on provider.

## 7. Contact Info

| Provider | Support channel | Notes |
|----------|-----------------|-------|
| Cloudflare | dash.cloudflare.com > Support | Select *DNS* product >
| Akamai | `support@akamai.com` or Luna portal | Provide zone name & contract ID
| AWS Route 53 | AWS Support Console | Use *Service: Route 53* |
| Google Cloud DNS | Google Cloud Support | Attach project ID |

*(End of excerpt)*
