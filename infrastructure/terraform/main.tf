
module "route53_primary" {
  source    = "./modules/aws_route53_zone"
  zone_name = "example.tld"
}

module "gcp_primary" {
  source    = "./modules/google_dns_zone"
  project   = "my‑gcp‑project"
  zone_name = "gcp‑example"
  domain    = "example2.tld."
}

module "akamai_sec" {
  source      = "./modules/akamai_secondary_zone"
  zone        = "example.tld"
  master_ips  = ["203.0.113.10"]
}

module "ultra_sec" {
  source      = "./modules/ultradns_secondary_zone"
  zone        = "example2.tld"
  primary_ip  = "198.51.100.22"
}
