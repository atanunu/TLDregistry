
resource "akamai_dns_zone" "secondary" {
  contract = data.akamai_contract.dns.contract_id
  group    = data.akamai_group.dns.group_id

  zone      = var.zone
  type      = "SECONDARY"
  masters   = var.master_ips

  comment   = "Secondary zone created by Terraform"
}
