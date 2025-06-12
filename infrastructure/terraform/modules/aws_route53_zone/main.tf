
resource "aws_route53_zone" "primary" {
  name          = var.zone_name
  comment       = var.comment
  force_destroy = true

  # Enable DNSSEC
  dnssec {
    signing_status = "SIGNING"
  }
}
