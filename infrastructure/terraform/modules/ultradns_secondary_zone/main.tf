
resource "ultradns_zone" "secondary" {
  name          = var.zone
  type          = "Secondary"
  primary_ips   = [var.primary_ip]
  notify        = [var.primary_ip]
  account_name  = data.ultradns_accounts.default.accounts[0].account_name
}
