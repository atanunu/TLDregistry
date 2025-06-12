
resource "google_dns_managed_zone" "primary" {
  name     = var.zone_name
  dns_name = var.domain
  project  = var.project

  dnssec_config {
    state = "on"
  }
}
